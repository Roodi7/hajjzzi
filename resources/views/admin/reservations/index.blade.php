@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <h1>إدارة الحجوزات</h1>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">المستخدم</th>
                                    <th class="text-center">المكان</th>
                                    <th class="text-center">الغرفة</th>
                                    <th class="text-center">تاريخ البداية</th>
                                    <th class="text-center">تاريخ النهاية</th>
                                    <th class="text-center">الاجمالي</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">الدفع</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td>{{ $reservation->id }}</td>
                                        <td>{{ $reservation->user->name }}</td>
                                        <td>{{ $reservation->accommodation->name }}</td>
                                        <td>{{ $reservation->room ? $reservation->room->room_number : 'N/A' }}</td>
                                        <td>{{ $reservation->start_date }}</td>
                                        <td>{{ $reservation->end_date }}</td>
                                        <td>${{ number_format($reservation->total_price, 2) }}</td>
                                        <td>

                                            <span
                                                class="badge badge-pill badge-soft-{{ $reservation->status == 'accepted' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : 'warning') }} font-size-11">{{ $reservation->status }}</span>

                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-pill badge-soft-{{ $reservation->is_paid ? 'success' : 'danger' }} font-size-11">{{ $reservation->is_paid ? 'Paid' : 'Not Paid' }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('reservations.edit', $reservation) }}"
                                                class="btn btn-primary btn-sm">تعديل</a>
                                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل تريد بالتأكيد حذف الحجز؟')">حذف</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $reservations->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>
    @include('components.scripts')
@endsection
