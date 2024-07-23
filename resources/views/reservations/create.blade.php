@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="ti-close"></i></strong>{{ $error }} .
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        </div>
    @endif
    <div class="container">
        <h1>Create Reservation</h1>
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="accommodation_id">Accommodation</label>
                <select name="accommodation_id" class="form-control" required>
                    @foreach ($accommodations as $accommodation)
                        <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sub_accommodation_id">Room or Chalet Section</label>
                <select name="room_id" class="form-control">
                    <option value="">Select Room</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                    @endforeach
                </select>
                <select name="chalet_section_id" class="form-control mt-2">
                    <option value="">Select Chalet Section</option>
                    @foreach ($chaletSections as $chaletSection)
                        <option value="{{ $chaletSection->id }}">{{ $chaletSection->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Reservation</button>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#accommodation').change(function() {
                var accommodationId = $(this).val();
                var roomSelect = $('#room');
                roomSelect.html('');

                if (accommodationId) {
                    $.ajax({
                        url: "{{ route('getRooms', ':accommodationId') }}".replace(
                            ':accommodationId', accommodationId),
                        method: 'GET',
                        success: function(data) {
                            data.forEach(function(room) {
                                roomSelect.append('<option value="' + room.id + '">' +
                                    room.room_number + '</option>');
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching rooms:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
