@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الايقونات ', 'link' => route('social-icons.index')]],
])
@section('title', 'إضافة ايقونة')
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
                            إضافة ايقونة جديدة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="{{ route('social-icons.store') }}" class="repeater" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="row d-flex ">
                            <div class="col-md-6 mb-2">
                                <label for="name" class="form-label">عنوان الايقونة</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="url" class="form-label">رابط الايقونة</label>
                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror"
                                    name="url" value="{{ old('url') }}" required autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">

                                <label for="icon">الايقونة</label>
                                <select class="form-control" id="icon" name="icon" required>
                                    <option data-icon="bx bxl-facebook" value="">اختر ايقونة</option>
                                    <option data-icon="bx bxl-facebook" value="bx bxl-facebook">Facebook</option>
                                    <option data-icon="bx bxl-twitter" value="bx bxl-twitter">Twitter</option>
                                    <option data-icon="bx bxl-instagram" value="bx bxl-instagram">Instagram</option>
                                    <option data-icon="bx bxl-linkedin" value="bx bxl-linkedin">LinkedIn</option>
                                    <option data-icon="bx bxl-youtube" value="bx bxl-youtube">YouTube</option>
                                    <option data-icon="bx bxl-pinterest" value="bx bxl-pinterest">Pinterest</option>
                                    <option data-icon="bx bxl-snapchat" value="bx bxl-snapchat">Snapchat</option>
                                    <option data-icon="bx bxl-tiktok" value="bx bxl-tiktok">TikTok</option>
                                    <option data-icon="bx bxl-reddit" value="bx bxl-reddit">Reddit</option>
                                    <option data-icon="bx bxl-whatsapp" value="bx bxl-whatsapp">WhatsApp</option>
                                    <option data-icon="bx bxl-telegram" value="bx bxl-telegram">Telegram</option>
                                    <option data-icon="bx bxl-phone" value="bx bxl-phone">Phone</option>
                                    <option data-icon="bx bxl-envelope" value="bx bxl-envelope">Email</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="order" class="form-label">الترتيب</label>
                                <input id="order" type="text"
                                    class="form-control @error('order') is-invalid @enderror" name="order"
                                    value="{{ old('order') }}" required autocomplete="order" autofocus>

                                @error('order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="col-md-5 d-block">
                                <button type="submit" class="btn btn-success waves-effect waves-light w-md"
                                    id="myButton">حفظ</button>
                                <a href="{{ route('social-icons.index') }}"
                                    class="btn btn-primary waves-effect waves-light w-md">رجوع إلى
                                    الايقونات </a>
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
