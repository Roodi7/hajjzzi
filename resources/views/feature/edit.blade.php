@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الميزات والملحقات ', 'link' => route('feature.index')]],
])
@section('title', 'تعديل ميزة')
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
                            تعديل الميزة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('feature.update', $feature->id) }}" class="repeater" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row d-flex ">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">اسم الميزة</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $feature->name }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="rating" class="form-label">التصنيف</label>
                                <input id="rating" type="text"
                                    class="form-control @error('rating') is-invalid @enderror" name="rating"
                                    value="{{ $feature->rating }}" autocomplete="rating" autofocus>

                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" autocomplete="description" autofocus>{{ $feature->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="notes" class="form-label">الملاحظات</label>
                                <textarea id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" name="notes"
                                    value="{{ old('notes') }}" autocomplete="notes" autofocus>{{ $feature->notes }}</textarea>

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

                            <div class="my-3">
                                <p>الصور القديمة</p>
                                <div class="row my-3">

                                    @forelse ($feature->attachments as $attachment)
                                        <div class="col-md-3">
                                            <a class="my-3" href="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                target="_blank" rel="noopener noreferrer"><img
                                                    src="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                    alt="" height="150"></a>
                                        </div>

                                    @empty
                                        لا يوجد مرفقات قديمة
                                    @endforelse
                                </div>

                            </div>


                            <div class="col-md-5 d-block">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-md"
                                    id="myButton">حفظ</button>
                                <a href="{{ route('feature.index') }}"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    الميزات والملحقات </a>
                            </div>
                            <br><br><br>
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
