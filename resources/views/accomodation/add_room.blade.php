@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => "#"]],
])
@section('title', 'إضافة غرفة')
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
    @include('components.alerts')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title d-flex justify-content-between mb-4">
                        <span class="col-md-9">
                            إضافة غرفة
                            <br>
                            <br>
                            {{ $accommodation->name }}
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".add-tax-modal">إضافة غرفة جديدة</a>

                            <div class="modal fade add-tax-modal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">إضافة غرفة جديد</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form action="{{ route('accommodation.add_room_post', $accommodation->id) }}"
                                                class="row g-3 needs-validation" method="POST"
                                                enctype="multipart/form-data">
                                                @method('POST')
                                                @csrf
                                                <div class="col-md-4 mb-2">
                                                    <label for="room_number" class="form-label">اسم الغرفة</label>
                                                    <input id="room_number" type="text"
                                                        class="form-control @error('room_number') is-invalid @enderror"
                                                        name="room_number" value="{{ old('room_number') }}"
                                                        autocomplete="room_number" autofocus placeholder="اسم الغرفة">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="bedsNumber" class="form-label">سعة الغرفة (سرير)</label>
                                                    <input id="bedsNumber" type="text"
                                                        class="form-control @error('bedsNumber') is-invalid @enderror"
                                                        name="bedsNumber" value="{{ old('bedsNumber') }}"
                                                        autocomplete="bedsNumber" autofocus placeholder="سعة الغرفة (سرير)">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="roomsNumber" class="form-label">عدد الغرف</label>
                                                    <input id="roomsNumber" type="text"
                                                        class="form-control @error('roomsNumber') is-invalid @enderror"
                                                        name="roomsNumber" value="{{ old('roomsNumber') }}"
                                                        autocomplete="roomsNumber" autofocus placeholder="عدد الغرف">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="floor" class="form-label">الطابق</label>
                                                    <input id="floor" type="text"
                                                        class="form-control @error('floor') is-invalid @enderror"
                                                        name="floor" value="{{ old('floor') }}" autocomplete="floor"
                                                        autofocus placeholder="الطابق">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="price" class="form-label">السعر</label>
                                                    <input id="price" type="text"
                                                        class="form-control @error('price') is-invalid @enderror"
                                                        name="price" value="{{ old('price') }}" autocomplete="price"
                                                        autofocus placeholder="السعر">
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="description" class="form-label">الوصف</label>
                                                    <input id="description" type="text"
                                                        class="form-control @error('description') is-invalid @enderror"
                                                        name="description" value="{{ old('description') }}"
                                                        autocomplete="description" autofocus placeholder="الوصف">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="category" class="form-label">التصنيف</label>
                                                    <input id="category" type="text"
                                                        class="form-control @error('category') is-invalid @enderror"
                                                        name="category" value="{{ old('category') }}"
                                                        autocomplete="category" autofocus placeholder="التصنيف">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label for="bookingConditions" class="form-label">شروط
                                                        الحجز</label>
                                                    <textarea id="bookingConditions" class="form-control @error('bookingConditions') is-invalid @enderror"
                                                        name="bookingConditions"  autocomplete="bookingConditions" placeholder="شروط الحجز">{{ old('bookingConditions') }}</textarea>
                                                    @error('bookingConditions')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-2">
                                                    <label for="cancellingConditions" class="form-label">شروط
                                                        الالغاء</label>
                                                    <textarea id="cancellingConditions" class="form-control @error('cancellingConditions') is-invalid @enderror"
                                                        name="cancellingConditions" autocomplete="cancellingConditions" placeholder="شروط الالغاء">{{ old('cancellingConditions') }}</textarea>
                                                    @error('cancellingConditions')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="video_url">رابط الفيديو:</label>
                                                    <input type="text" id="video_url" name="video_url"
                                                        class="form-control">

                                                    @error('video_url')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="images" class="form-label">الصور</label>
                                                    <input id="images" type="file" multiple
                                                        class="form-control @error('images') is-invalid @enderror"
                                                        name="images[]" value="{{ old('images') }}"
                                                        autocomplete="images" autofocus>

                                                    @error('images')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <input type="text" name="accommodation_id"
                                                    value="{{ $accommodation->id }}" hidden>

                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-success">إضافة الغرفة</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">


                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">رقم الغرفة</th>
                                    <th class="text-center">التصنيف</th>
                                    <th class="text-center">السعة (عدد الاسرة)</th>
                                    <th class="text-center">عدد الغرف</th>
                                    <th class="text-center">الطابق</th>
                                    <th class="text-center">السعر</th>
                                    <th class="text-center">الوصف</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accommodation_rooms as $room)
                                    <tr>
                                        {{-- @dd($room) --}}
                                        <th class="text-center align-middle" scope="row">{{ $room->id }}
                                        </th>
                                        <td class="text-center align-middle">{{ $room->room_number }}</td>
                                        <td class="text-center align-middle">{{ $room->category }}</td>
                                        <td class="text-center align-middle">{{ $room->bedsNumber }}</td>
                                        <td class="text-center align-middle">{{ $room->roomsNumber }}</td>
                                        <td class="text-center align-middle">{{ $room->floor }}</td>
                                        <td class="text-center align-middle">{{ $room->price }}</td>
                                        <td class="text-center align-middle">{{ $room->description }}</td>

                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('room.add_feature', $room->id) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-info">الميزات</a>

                                            <form action="{{ route('accommodation.delete_room', $room->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger waves-effect waves-light " title="حذف"
                                                    type="submit"><i
                                                        class="bx bx-trash d-block font-size-16"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="10" class="text-center text-danger align-middle">لا يوجد بيانات لعرضها
                                @endforelse

                                </td>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>



    @include('components.scripts')

    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>.

    <script>
        new Selectr(document.getElementById('term_id'));
    </script>

@endsection
