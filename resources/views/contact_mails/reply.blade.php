@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الايميلات ', 'link' => route('contact-mails.index')]],
])
@section('title', 'الرد على ايميل')
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
                            الرد على الايميل
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">

                    @method('PUT')
                    <form action="{{ route('contact-mails.sendReply', $contactMail->id) }}" method="POST">
                        @csrf

                        <div class="form-group my-1">
                            <label for="name">الاسم:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $contactMail->name }}" disabled>
                        </div>

                        <div class="form-group my-1">
                            <label for="email">الايميل:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $contactMail->email }}" disabled>
                        </div>

                        <div class="form-group my-1">
                            <label for="subject">الموضوع:</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                value="{{ $contactMail->subject }}" disabled>
                        </div>

                        <div class="form-group my-1">
                            <label for="message">الرسالة:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" disabled>{{ $contactMail->message }}</textarea>
                        </div>

                        <div class="form-group my-1">
                            <label for="replay">الرد:</label>
                            <textarea class="form-control" id="replay" name="replay" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success my-2">Send replay</button>
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
