@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Report for Room: {{ $room->name }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Payment Status</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room->reservations as $reservation)
                <tr>
                    <td>{{ $reservation->id }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->start_date }}</td>
                    <td>{{ $reservation->end_date }}</td>
                    <td>{{ ucfirst($reservation->status) }}</td>
                    <td>{{ $reservation->is_paid ? 'Paid' : 'Not Paid' }}</td>
                    <td>${{ number_format($reservation->total_price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><strong>Total:</strong></td>
                <td>${{ number_format($totalPrice, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
