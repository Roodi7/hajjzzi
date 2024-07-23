@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'قسم الاعلانات   ', 'link' => route('main-slider.index')]],
])
@section('title', 'إدارة قسم الاعلانات ')
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

                    <h3>قسم الاعلانات</h3>

                    <form method="POST" action="{{ route('discount_and_marketing.update', 1) }}"
                        enctype="multipart/form-data" class="row d-flex justify-content-center">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 mb-2">
                            <label for="title" class="form-label">العنوان</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ $discountAndMarketing->title }}" autocomplete="title" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-2">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" value="{{ old('description') }}" autocomplete="description" autofocus>{{ $discountAndMarketing->description }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="firstColumn" class="form-label">صور العمود الاول</label>
                                <input class="form-control" type="file" multiple id="firstColumn" name="firstColumn[]">
                                @forelse ($firstColumn as $item)
                                    <a href="{{ asset('storage/' .$item->attachment_path) }}" target="_blank"
                                        rel="noopener noreferrer">المرفق</a>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="secondColumn" class="form-label">صور العمود الثاني</label>
                                <input class="form-control" type="file" multiple id="secondColumn" name="secondColumn[]">
                                @forelse ($secondColumn as $item)
                                    <a href="{{ asset('storage/' .$item->attachment_path) }}" target="_blank"
                                        rel="noopener noreferrer">المرفق</a>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="thirdColumn" class="form-label">صور العمود الثالث</label>
                                <input class="form-control" type="file" multiple id="thirdColumn" name="thirdColumn[]">
                                @forelse ($thirdColumn as $item)
                                    <a href="{{ asset('storage/' .$item->attachment_path) }}" target="_blank"
                                        rel="noopener noreferrer">المرفق</a>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="fourthColumn" class="form-label">صور العمود الرابع</label>
                                <input class="form-control" type="file" multiple id="fourthColumn" name="fourthColumn[]">
                                @forelse ($fourthColumn as $item)
                                    <a href="{{ asset('storage/' .$item->attachment_path) }}" target="_blank"
                                        rel="noopener noreferrer">المرفق</a>
                                @empty
                                @endforelse
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-md-2 my-3 mb-5">تحديث</button>
                    </form>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>


    @include('components.scripts')

    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

@endsection
