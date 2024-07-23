@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => '#']],
])
@section('title', 'إضافة مسكن')
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between mb-4">
                        <span>
                            إضافة {{ $accomodations_type[$type] }} جديدة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('accomodation.store') }}" class="repeater" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row d-flex ">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">الاسم</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="الاسم">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            {{-- <div class="col-md-4 mb-2"> --}}
                            {{-- <label for="type" class="form-label">النوع</label> --}}
                            <select hidden id="type" type="text"
                                class="form-control @error('type') is-invalid @enderror" name="type" autocomplete="type"
                                autofocus>
                                @foreach ($accomodations_type as $key => $types)
                                    <option @selected($key == $type) value="{{ $key }}">
                                        {{ $types }}
                                    </option>
                                @endforeach
                            </select>

                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            {{-- </div> --}}
                            <div class="col-md-4 mb-2">
                                <label for="location" class="form-label">الموقع</label>
                                <input id="location" type="text"
                                    class="form-control @error('location') is-invalid @enderror" name="location"
                                    value="{{ old('location') }}" autocomplete="location" autofocus placeholder="الموقع">

                                @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="city_id" class="form-label">المدينة</label>
                                <select id="city_id" type="text"
                                    class="form-control @error('city_id') is-invalid @enderror" name="city_id"
                                    autocomplete="city_id" autofocus placeholder="الاسم">
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->city_name }}</option>
                                    @endforeach
                                </select>

                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @if ($type != 'hotel')

                                <div class="col-md-4 mb-2">
                                    <label for="capacity" class="form-label">
                                        @if ($type == 'chalet' or $type == 'appartment')
                                            عدد الغرف
                                        @else
                                            السعة
                                        @endif
                                    </label>
                                    <input id="capacity" type="text"
                                        class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                                        value="{{ old('capacity') }}" autocomplete="capacity" autofocus
                                        placeholder="@if ($type == 'chalet' or $type == 'appartment') عدد الغرف
                                    @else السعة @endif">

                                    @error('capacity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="price" class="form-label">السعر</label>
                                    <input id="price" type="text"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ old('price') }}" autocomplete="price" autofocus placeholder="السعر">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-4 mb-2">
                                <label for="rating" class="form-label">التصنيف</label>
                                <input id="rating" type="text"
                                    class="form-control @error('rating') is-invalid @enderror" name="rating"
                                    value="{{ old('rating') }}" autocomplete="rating" autofocus placeholder="التصنيف">

                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="phone" class="form-label">رقم التواصل</label>
                                <input id="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror" name="phone"
                                    value="{{ old('phone') }}" autocomplete="phone" autofocus
                                    placeholder="رقم التواصل">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="longitude" class="form-label">خط الطول</label>
                                <input id="longitude" type="text"
                                    class="form-control @error('longitude') is-invalid @enderror" name="longitude"
                                    value="{{ old('longitude') }}" autocomplete="longitude" autofocus
                                    placeholder="خط الطول">

                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="latitude" class="form-label">خط العرض</label>
                                <input id="latitude" type="text"
                                    class="form-control @error('latitude') is-invalid @enderror" name="latitude"
                                    value="{{ old('latitude') }}" autocomplete="latitude" autofocus
                                    placeholder="خط العرض">

                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            {{-- <div class="col-md-4 mb-2">
                                <label for="manager_id" class="form-label">المدير</label>
                                <select id="manager_id" type="text"
                                    class="form-control @error('manager_id') is-invalid @enderror" name="manager_id"
                                    autocomplete="manager_id" autofocus placeholder="الاسم">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('manager_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}
                            @if ($type == 'hotel')
                                <div class="col-md-4 mb-2">
                                    <label for="short_description" class="form-label">الوصف القصير</label>
                                    <input id="short_description" type="text"
                                        class="form-control @error('short_description') is-invalid @enderror"
                                        name="short_description" value="{{ old('short_description') }}"
                                        autocomplete="short_description" autofocus placeholder="الوصف القصير">

                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" autocomplete="description" autofocus></textarea>

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
                                    name="bookingConditions" autocomplete="bookingConditions" placeholder="شروط الحجز">{{ old('bookingConditions') }}</textarea>
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
                                    name="cancellingConditions" autocomplete="cancellingConditions" placeholder="شروط الالغاء">{{ old('cancellingConditions') }}</textarea>
                                @error('cancellingConditions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="video_url">رابط الفيديو:</label>
                                <input type="text" id="video_url" name="video_url" class="form-control">

                                @error('video_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="images" class="form-label">الصور</label>
                                <input id="images" type="file" multiple
                                    class="form-control @error('images') is-invalid @enderror" name="images[]"
                                    value="{{ old('images') }}" autocomplete="images" autofocus>

                                @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-5 d-block">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-md"
                                    id="myButton">حفظ</button>
                                <a href="#"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    المساكن </a>
                            </div>
                        </div>
                        <br><br>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <script src="https://cdn.tiny.cloud/1/xqxx9hr3pifd4l5q1n2uv5xvfsns89zzryhqz37uo1zogu4u/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>


    <script>
        new Selectr(document.getElementById('city_id'));
        new Selectr(document.getElementById('manager_id'));
        tinymce.init({
            selector: '#description22',
            language: 'ar',
            menubar: 'file edit view insert format tools table help',
            toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",

        });
        const myButton = document.getElementById('myButton');
        myButton.addEventListener('click', () => {
            myButton.style.display = 'none';

            setTimeout(() => {
                myButton.style.display = 'inline-block';
            }, 2000);
        });
    </script>

    @include('components.scripts')
    <script src="{{ URL('assets/js/form-repeater.int.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

@endsection
