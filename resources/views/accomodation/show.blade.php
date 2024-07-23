@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => "#"]],
])
@section('title', 'تفاصيل مسكن')
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
                            تفاصيل المسكن
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="#" class="repeater" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row d-flex ">
                            <div class="col-md-4 mb-2">
                                <label for="name" class="form-label">الاسم</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $accommodation->name }}" required autocomplete="name" autofocus
                                    placeholder="الاسم">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-4 mb-2">
                                <label for="type" class="form-label">النوع</label>
                                <select id="type" type="text"
                                    class="form-control @error('type') is-invalid @enderror" name="type"
                                    autocomplete="type" autofocus>
                                    @foreach ($accomodations_type as $key => $type)
                                        <option @selected($accommodation->type == $key) value="{{ $key }}">{{ $type }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="location" class="form-label">الموقع</label>
                                <input id="location" type="text"
                                    class="form-control @error('location') is-invalid @enderror" name="location"
                                    value="{{ $accommodation->location }}" autocomplete="location" autofocus
                                    placeholder="الموقع">

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
                                        <option @selected($accommodation->city_id == $city->id) value="{{ $city->id }}">
                                            {{ $city->city_name }}</option>
                                    @endforeach
                                </select>

                                @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="capacity" class="form-label">السعة</label>
                                <input id="capacity" type="text"
                                    class="form-control @error('capacity') is-invalid @enderror" name="capacity"
                                    value="{{ $accommodation->capacity }}" autocomplete="capacity" autofocus
                                    placeholder="السعة">

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
                                    value="{{ $accommodation->price }}" autocomplete="price" autofocus placeholder="السعر">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="short_description" class="form-label">الوصف القصير</label>
                                <input id="short_description" type="text"
                                    class="form-control @error('short_description') is-invalid @enderror"
                                    name="short_description" value="{{ $accommodation->short_description }}"
                                    autocomplete="short_description" autofocus placeholder="الوصف القصير">

                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" autocomplete="description" autofocus>{{ $accommodation->description }}</textarea>

                                @error('description')
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

                            <div class="my-3">
                                <p>الصور القديمة</p>
                                <div class="row my-3">

                                    @forelse ($accommodation->attachments as $attachment)
                                        <div class="col-md-3">
                                            <a class="my-3"
                                                href="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                target="_blank" rel="noopener noreferrer"><img
                                                    src="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                    alt="" height="150"></a>
                                        </div>

                                    @empty
                                        لا يوجد مرفقات قديمة
                                    @endforelse
                                </div>

                            </div>

                    </form>
                    <div class="col-md-5 d-block">


                        <a type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-center">حذف</a>
                        @include('components.delete_modal', [
                            'delete_route' => route('accomodation.destroy', $accommodation->id),
                            'warning_message' => 'هل انت متأكد من رغبتك بحذف المسكن ' . $accommodation->name,
                        ])
                        <a href="{{ route('accomodation.index') }}" class="btn btn-primary">الرجوع
                            للصفحة الرئيسية </a>
                    </div>
                    <br><br><br>
                    <br>
                </div>
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
        tinymce.init({
            selector: '#description',
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
