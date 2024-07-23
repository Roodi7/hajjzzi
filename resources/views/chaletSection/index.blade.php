@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => route('accomodation.index')]],
])
@section('title', 'إضافة جناح')
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
                            إضافة جناح
                            <br>
                            <br>
                            {{ $accommodation->name }}
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".add-tax-modal">إضافة جناح جديد</a>

                            <div class="modal fade add-tax-modal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">إضافة جناح جديد</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form method="POST" action="{{ route('chalet_section.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input id="accommodation_id" type="text" class="form-control" hidden
                                                    name="accommodation_id" value="{{ $accommodation->id }}" required>
                                                <div class="row">
                                                    <div class="col-md-4 mb-2">
                                                        <label for="name" class="form-label">الاسم</label>
                                                        <input id="name" type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}" required
                                                            autocomplete="name" autofocus placeholder="الاسم">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-4 mb-2">
                                                        <label for="numberOfRooms" class="form-label">عدد الغرف</label>
                                                        <input id="numberOfRooms" type="number"
                                                            class="form-control @error('numberOfRooms') is-invalid @enderror"
                                                            name="numberOfRooms" value="{{ old('numberOfRooms') }}" required
                                                            autocomplete="numberOfRooms" placeholder="عدد الغرف">
                                                        @error('numberOfRooms')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-2">
                                                        <label for="pricePerNight" class="form-label">السعر لكل ليلة</label>
                                                        <input id="pricePerNight" type="number" step="0.01"
                                                            class="form-control @error('pricePerNight') is-invalid @enderror"
                                                            name="pricePerNight" value="{{ old('pricePerNight') }}" required
                                                            autocomplete="pricePerNight" placeholder="السعر لكل ليلة">
                                                        @error('pricePerNight')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-2">
                                                        <label for="numberOfStars" class="form-label">عدد النجوم</label>
                                                        <input id="numberOfStars" type="number"
                                                            class="form-control @error('numberOfStars') is-invalid @enderror"
                                                            name="numberOfStars" value="{{ old('numberOfStars') }}"
                                                            required autocomplete="numberOfStars" placeholder="عدد النجوم">
                                                        @error('numberOfStars')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>



                                                    <div class="col-md-4 mb-2">
                                                        <label for="latitude" class="form-label">خط العرض</label>
                                                        <input id="latitude" type="text"
                                                            class="form-control @error('latitude') is-invalid @enderror"
                                                            name="latitude" value="{{ old('latitude') }}" required
                                                            autocomplete="latitude" placeholder="خط العرض">
                                                        @error('latitude')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-4 mb-2">
                                                        <label for="longitude" class="form-label">خط الطول</label>
                                                        <input id="longitude" type="text"
                                                            class="form-control @error('longitude') is-invalid @enderror"
                                                            name="longitude" value="{{ old('longitude') }}" required
                                                            autocomplete="longitude" placeholder="خط الطول">
                                                        @error('longitude')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <label for="description" class="form-label">الوصف</label>
                                                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                                            required autocomplete="description" placeholder="الوصف">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-6 mb-2">
                                                        <label for="bookingConditions" class="form-label">شروط
                                                            الحجز</label>
                                                        <textarea id="bookingConditions" class="form-control @error('bookingConditions') is-invalid @enderror"
                                                            name="bookingConditions" required autocomplete="bookingConditions" placeholder="شروط الحجز">{{ old('bookingConditions') }}</textarea>
                                                        @error('bookingConditions')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <label for="cancellingConditions" class="form-label">شروط
                                                            الالغاء</label>
                                                        <textarea id="cancellingConditions" class="form-control @error('cancellingConditions') is-invalid @enderror"
                                                            name="cancellingConditions" required autocomplete="cancellingConditions" placeholder="شروط الالغاء">{{ old('cancellingConditions') }}</textarea>
                                                        @error('cancellingConditions')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <label for="video_url">رابط الفيديو:</label>
                                                        <input type="text" id="video_url" name="video_url"
                                                            class="form-control">

                                                        @error('video_url')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6 mb-2">
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
                                                </div>
                                                <button type="submit" class="btn btn-success mt-3">حفظ</button>
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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">عدد الغرف</th>
                                    <th class="text-center">السعر لليلة</th>
                                    <th class="text-center">عدد النجوم</th>
                                    <th class="text-center">وصف</th>
                                    <th class="text-center">خط الطول</th>
                                    <th class="text-center">خط العرض</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($chaletSections as $section)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $section->id }}</th>
                                        <td class="text-center align-middle">{{ $section->name }}</td>
                                        <td class="text-center align-middle">{{ $section->numberOfRooms }}</td>
                                        <td class="text-center align-middle">{{ $section->pricePerNight }}</td>
                                        <td class="text-center align-middle">{{ $section->numberOfStars }}</td>
                                        <td class="text-center align-middle">{{ $section->description }}</td>
                                        <td class="text-center align-middle">{{ $section->latitude }}</td>
                                        <td class="text-center align-middle">{{ $section->longitude }}</td>
                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('chaletsection.add_feature', $section->id) }}" target="_blank"
                                                rel="noopener noreferrer" class="btn btn-info">الميزات</a>

                                            <form action="{{ route('section.delete', $section->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger waves-effect waves-light" title="حذف"
                                                    type="submit">
                                                    <i class="bx bx-trash d-block font-size-16"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger align-middle">لا يوجد بيانات
                                            لعرضها</td>
                                    </tr>
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
