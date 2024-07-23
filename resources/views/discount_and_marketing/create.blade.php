@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'السلايدر ', 'link' => route('main-slider.index')]],
])
@section('title', 'إضافة سلايد')
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
    <div class="container">
        <h1>Create Discount and Marketing Item</h1>
        <form action="{{ route('discount_and_marketing.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="first_column">First Column</label>
                <input type="text" class="form-control" id="first_column" name="first_column[]" required>
            </div>
            <div class="form-group">
                <label for="second_column">Second Column</label>
                <input type="text" class="form-control" id="second_column" name="second_column[]" required>
            </div>
            <div class="form-group">
                <label for="third_column">Third Column</label>
                <input type="text" class="form-control" id="third_column" name="third_column[]" required>
            </div>
            <div class="form-group">
                <label for="fourth_column">Fourth Column</label>
                <input type="text" class="form-control" id="fourth_column" name="fourth_column[]" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
