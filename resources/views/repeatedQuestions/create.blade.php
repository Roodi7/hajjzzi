@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الاسئلة ', 'link' => route('repeated-questions.index')]],
])
@section('title', 'إضافة سؤال')
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
                            إضافة سؤال جديد
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('repeated-questions.store') }}" class="repeater" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row d-flex ">
                            <div class="col-md-6 mb-2">
                                <label for="question" class="form-label">السؤال</label>
                                <input id="question" type="text"
                                    class="form-control @error('question') is-invalid @enderror" name="question"
                                    value="{{ old('question') }}" required autocomplete="question" autofocus>

                                @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="answer" class="form-label">الاجابة</label>
                                <input id="answer" type="text"
                                    class="form-control @error('answer') is-invalid @enderror" name="answer"
                                    value="{{ old('answer') }}" autocomplete="answer" autofocus>

                                @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-5 d-block">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-md"
                                    id="myButton">حفظ</button>
                                <a href="{{ route('repeated-questions.index') }}"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    الاسئلة المتكررة </a>
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
