@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Report for {{ $accommodation->name }}</h1>
        <h2>Total Revenue: ${{ $totalRevenue }}</h2>
        <h3>Reservations:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->name }}</td>
                        <td>{{ $reservation->phone_number }}</td>
                        <td>{{ $reservation->start_date }}</td>
                        <td>{{ $reservation->end_date }}</td>
                        <td>{{ $reservation->total_price }}</td>
                        <td>{{ $reservation->status }}</td>
                        <td>{{ $reservation->pay_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
