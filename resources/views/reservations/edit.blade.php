@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>تعديل الحجز</h1>
        <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">الحالة</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $reservation->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="denied" {{ $reservation->status == 'denied' ? 'selected' : '' }}>Denied</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pay_status">الدفع</label>
                <select name="pay_status" class="form-control" required>
                    <option value="unpaid" {{ $reservation->pay_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="paid" {{ $reservation->pay_status == 'paid' ? 'selected' : '' }}>Paid</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary my-2">تحديث</button>
        </form>
    </div>
<br><br><br>

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
