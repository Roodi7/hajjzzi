@extends('layouts.app')

@section('content')
    <div class="row">

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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title d-flex justify-content-between mb-4">
                        <span class="col-md-9">
                            الحجوزات
                            <a href="{{ route('reservations.index') }}" class="btn btn-primary"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>
                            @if ($printData != null)
                                <a href="{{ route('reservations.print_search') }}" class="btn btn-success">طباعة نتيجة
                                    البحث</a>
                            @endif
                        </span>
                    </h4>
                    <div class="card border shadow-none card-body text-muted mb-0">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" name="reservation_id_search_check"
                                                type="checkbox" id="reservation_id_search_check">
                                            <label class="form-check-label" for="reservation_id_search_check">
                                                حسب رقم العملية/الحجز
                                            </label>
                                        </div>
                                        <input name="reservation_id_search" type="text" class="form-control "
                                            id="formrow-inputCity" placeholder="ادخل رقم العملية/الحجز الذي تريد البحث عنه">
                                    </div>
                                </div>

                                @if (Auth::user()->role == 'admin')
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <div class="mb-2">
                                                <input class="form-check-input" name="accommodation_check" type="checkbox"
                                                    id="accommodation_check">
                                                <label class="form-check-label" for="accommodation_check">
                                                    حسب المسكن
                                                </label>
                                            </div>
                                            <select name="accommodation_search" class="form-select"
                                                id="accommodation_search">
                                                @foreach ($accommodations as $accommodation)
                                                    <option value="{{ $accommodation->id }}">{{ $accommodation->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="mb-2">
                                            <input class="form-check-input" type="checkbox" name="status_check"
                                                id="status_check">
                                            <label class="form-check-label" for="status_check">
                                                حالة الحجز
                                            </label>
                                        </div>
                                        <select name="status_search" class="form-select" id="status_search">
                                            <option value="pending">pending</option>
                                            <option value="accepted">accepted</option>
                                            <option value="denied">denied</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="mb-2">
                                            <input class="form-check-input" type="checkbox" name="pay_status_check"
                                                id="pay_status_check">
                                            <label class="form-check-label" for="pay_status_check">
                                                حالة الدفع
                                            </label>
                                        </div>
                                        <select name="pay_status_search" class="form-select" id="pay_status_search">
                                            <option value="unpaid">غير مدفوع</option>
                                            <option value="paid">مدفوع</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="mb-2">
                                            <input class="form-check-input" type="checkbox" name="account_id_check"
                                                id="account_id_check">
                                            <label class="form-check-label" for="account_id_check">
                                                حسب حساب المستخدم
                                            </label>
                                        </div>
                                        <select name="account_id_search" class="form-select" id="account_id_search">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" name="reservation_name_search_check"
                                                type="checkbox" id="reservation_name_search_check">
                                            <label class="form-check-label" for="reservation_name_search_check">
                                                حسب اسم الحجز
                                            </label>
                                        </div>
                                        <input name="reservation_name_search" type="text" class="form-control "
                                            id="formrow-inputCity" placeholder="ادخل اسم الحجز الذي تريد البحث عنه">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" name="date_search_check" type="checkbox"
                                                id="date_search_check">
                                            <label class="form-check-label" for="date_search_check">
                                                البحث بين تاريخين </label>
                                        </div>
                                        <input name="from_date" class="form-control " id="formrow-inputCity"
                                            placeholder="تاريخ البدء" onfocus="(this.type='date')"
                                            onblur="(this.type='text')">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">
                                            <label class="form-check-label" for="to_date">
                                            </label>
                                        </div>
                                        <input name="to_date" class="form-control" placeholder="تاريخ النهاية"
                                            onfocus="(this.type='date')" onblur="(this.type='text')">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="search_reservations"
                                    class="btn btn-primary w-md ">بحث</button>
                            </div>
                        </form>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">المسكن</th>
                                <th class="text-center">غرفة/جناح</th>
                                <th class="text-center">المستخدم</th>
                                <th class="text-center">اسم الحجز</th>
                                <th class="text-center">رقم الحجز</th>
                                <th class="text-center">تاريخ البداية</th>
                                <th class="text-center">تاريخ النهاية</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">حالة الدفع</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td class="text-center align-middle">{{ $reservation->id }}</td>
                                    <td class="text-center align-middle">{{ $reservation->accommodation->name }}</td>
                                    <td class="text-center align-middle">
                                        @if ($reservation->room_id)
                                            Room: {{ $reservation->room->room_number }}
                                        @elseif ($reservation->chalet_section_id)
                                            Chalet Section: {{ $reservation->chaletSection->name }}
                                        @else
                                            Whole Accommodation
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">{{ $reservation->user->name }}</td>
                                    <td class="text-center align-middle">{{ $reservation->name }}</td>
                                    <td class="text-center align-middle">{{ $reservation->phone_number }}</td>
                                    <td class="text-center align-middle">{{ $reservation->start_date }}</td>
                                    <td class="text-center align-middle">{{ $reservation->end_date }}</td>
                                    <td class="text-center align-middle">

                                        <span
                                            class="badge badge-pill badge-soft-{{ $reservation->status == 'accepted' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : 'warning') }} font-size-11">{{ $reservation->status }}</span>

                                    </td>
                                    <td class="text-center align-middle">
                                        <span
                                            class="badge badge-pill badge-soft-{{ $reservation->pay_status == 'paid' ? 'success' : 'danger' }} font-size-11">{{ $reservation->pay_status == 'paid' ? 'Paid' : 'Not Paid' }}</span>
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($reservation->status != 'accepted')
                                            <form action="{{ route('reservations.accept', $reservation->id) }}"
                                                method="POST" style="display: inline !important">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-success">accept</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('reservations.edit', $reservation->id) }}"
                                            class="btn btn-warning"><i class="bx bx-pen d-block font-size-16"></i></a>
                                        <form action="{{ route('reservations.destroy', $reservation->id) }}"
                                            method="POST" style="display: inline !important">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i
                                                    class="bx bx-trash d-block font-size-16"></i></button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>
    @include('components.scripts')
@endsection
