@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المدن ', 'link' => route('city.index')]],
])
@section('title', 'إضافة مدينة')
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
                            إضافة مدينة جديدة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('city.store') }}" class="repeater" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row d-flex ">
                            <div class="col-md-6 mb-2">
                                <label for="city_name" class="form-label">اسم المدينة</label>
                                <input id="city_name" type="text"
                                    class="form-control @error('city_name') is-invalid @enderror" name="city_name"
                                    value="{{ old('city_name') }}" required autocomplete="city_name" autofocus>

                                @error('city_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="details" class="form-label">التفاصيل</label>
                                <input id="details" type="text"
                                    class="form-control @error('details') is-invalid @enderror" name="details"
                                    value="{{ old('details') }}" autocomplete="details" autofocus>

                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
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
                                <label for="notes" class="form-label">الملاحظات</label>
                                <textarea id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes"
                                    value="{{ old('notes') }}" autocomplete="notes" autofocus></textarea>

                                @error('notes')
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
                                <a href="{{ route('city.index') }}"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    المدن </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <script>
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
