@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1>تقرير حجوزات : {{ $accommodation->name }}</h1>
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
                                @foreach ($accommodation->reservations as $reservation)
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
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>
@endsection
