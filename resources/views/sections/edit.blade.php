@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'وصف الاقسام ', 'link' => route('sections.edit')]],
])
@section('title', 'تعديل الوصف')
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
                    <h4 class="card-title d-flex justify-content-between mb-4">
                        <span>
                            تعديل الوصف
                        </span>
                    </h4>
                    <form method="POST" action="{{ route('sections.update') }}" enctype="multipart/form-data" class="row d-flex justify-content-center">
                        @csrf
                        @method('PUT')
                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">

                            <div class="mb-3">
                                <label for="hotels_description" class="form-label">وصف الفنادق</label>
                                <textarea class="form-control" id="hotels_description" name="hotels_description">{{ $section->hotels_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="hotels_image" class="form-label">الصورة</label>
                                <input class="form-control" type="file" id="hotels_image" name="hotels_image">
                            </div>
                        </div>
                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="chalets_description" class="form-label">وصف الشاليهات</label>
                                <textarea class="form-control" id="chalets_description" name="chalets_description">{{ $section->chalets_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="chalets_image" class="form-label">الصورة</label>
                                <input class="form-control" type="file" id="chalets_image" name="chalets_image">
                            </div>
                        </div>

                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="halls_description" class="form-label">وصف القاعات</label>
                                <textarea class="form-control" id="halls_description" name="halls_description">{{ $section->halls_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="halls_image" class="form-label">الصورة</label>
                                <input class="form-control" type="file" id="halls_image" name="halls_image">
                            </div>
                        </div>

                        <div class="col-md-5 m-2 p-3 border border-2 border-secondary rounded">
                            <div class="mb-3">
                                <label for="appartments_description" class="form-label">وصف الشقق</label>
                                <textarea class="form-control" id="appartments_description" name="appartments_description">{{ $section->appartments_description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="appartments_image" class="form-label">الصورة</label>
                                <input class="form-control" type="file" id="appartments_image" name="appartments_image">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary col-md-2 my-3 mb-5">تحديث</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.scripts')
@endsection
