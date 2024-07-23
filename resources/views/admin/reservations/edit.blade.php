@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Edit Reservation</h1>
                        <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="form-group col-md-4 my-1">
                                    <label for="accommodation">Accommodation</label>
                                    <select id="accommodation" name="accommodation_id" class="form-select">
                                        <option value="">Select Accommodation</option>
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}"
                                                data-price="{{ $accommodation->price }}"
                                                {{ $accommodation->id == $reservation->accommodation_id ? 'selected' : '' }}>
                                                {{ $accommodation->name }} ({{ $accommodation->type }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 my-1">
                                    <label for="room">Room (if applicable)</label>
                                    <select id="room" name="room_id" class="form-select">
                                        <option value="">Select Room</option>
                                        @foreach ($rooms as $room)
                                            <option value="{{ $room->id }}" data-price="{{ $room->price }}"
                                                {{ $room->id == $reservation->room_id ? 'selected' : '' }}>
                                                {{ $room->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4 my-1">
                                    <label>Status</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="pending"
                                            value="pending" {{ $reservation->status == 'pending' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pending">Pending</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="accepted"
                                            value="accepted" {{ $reservation->status == 'accepted' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="accepted">Accepted</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="rejected"
                                            value="rejected" {{ $reservation->status == 'rejected' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="rejected">Rejected</label>
                                    </div>
                                </div>



                                <div class="form-group col-md-4 my-1">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ $reservation->start_date }}" required>
                                </div>
                                <div class="form-group col-md-4 my-1">
                                    <label for="end_date">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ $reservation->end_date }}" required>
                                </div>
                                <div class="form-group col-md-4 my-1">
                                    <label for="is_paid">Payment Status</label>
                                    <select id="is_paid" name="is_paid" class="form-control">
                                        <option value="0" {{ !$reservation->is_paid ? 'selected' : '' }}>Not Paid
                                        </option>
                                        <option value="1" {{ $reservation->is_paid ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>



                                <div class="form-group col-md-4 my-1">
                                    <label for="total_price">Total Price</label>
                                    <input type="text" id="total_price" name="total_price" class="form-control"
                                        value="${{ number_format($total_price, 2) }}" readonly>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#accommodation').change(function() {
                var accommodationId = $(this).val();
                var roomSelect = $('#room');
                roomSelect.html('<option value="">Select Room</option>');

                if (accommodationId) {
                    $.ajax({
                        url: "{{ route('getRooms', ':accommodationId') }}".replace(
                            ':accommodationId', accommodationId),
                        method: 'GET',
                        success: function(data) {
                            data.forEach(function(room) {
                                roomSelect.append('<option value="' + room.id +
                                    '" data-price="' + room.price + '">' + room
                                    .name + '</option>');
                            });
                        },
                        error: function(error) {
                            console.error('Error fetching rooms:', error);
                        }
                    });
                }

                calculateTotalPrice();
            });

            $('#start_date, #end_date, #room').change(calculateTotalPrice);

            function calculateTotalPrice() {
                var startDate = new Date($('#start_date').val());
                var endDate = new Date($('#end_date').val());
                var days = (endDate - startDate) / (1000 * 60 * 60 * 24) + 1;
                var pricePerDay = $('#room').find(':selected').data('price') || $('#accommodation').find(
                    ':selected').data('price');
                var totalPrice = days * pricePerDay;

                $('#total_price').val('$' + totalPrice.toFixed(2));
            }

            // Initial calculation
            calculateTotalPrice();
        });
    </script>
@endsection
