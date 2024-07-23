@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'سياسة الخصوصية ', 'link' => route('policy.index')]],
])
@section('title', 'إضافة سياسة')
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
                            إضافة سياسة جديدة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('policy.store') }}" class="repeater" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row d-flex ">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">عنوان السياسة</label>
                                <input id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                                    autocomplete="description" placeholder="الوصف">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-5 d-block">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-md"
                                    id="myButton">حفظ</button>
                                <a href="{{ route('policy.index') }}"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    سياسة الخصوصية </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
    <script src="{{ URL('assets/js/jquery.repeater.min.js') }}"></script>
@endsection
