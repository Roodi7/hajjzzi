@extends('layouts.app', [
    'navlinks' => [],
])
@section('title', 'رئيسية ')
@section('content')
    @include('components.alerts')
    @if (Auth::user()->role=='admin')
        
    <div class="row">
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">الفنادق</p>
                            <h4 class="mb-0">{{ $hotels_count }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bx-building font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">الشاليهات</p>
                            <h4 class="mb-0">{{ $chalets_count }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center ">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-building font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">الصالات</p>
                            <h4 class="mb-0">{{ $halls_count }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-building font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">الشقق</p>
                            <h4 class="mb-0">{{ $appartments_count }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-building font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">آخر الحجوزات</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    @endif

    @include('components.scripts')

@endsection
