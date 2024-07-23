@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'السلايدر الرئيسي   ', 'link' => route('main-slider.index')]],
])
@section('title', 'إدارة السلايدر الرئيسي ')
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
                        <span class="col-md-9">
                            إدارة السلايدر الرئيسي

                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('main-slider.index') }}"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>
                            @if (Auth::user()->permissions->manage_mainpage)
                                <a href="{{ route('main-slider.create') }}"
                                    class="btn btn-success waves-effect waves-light me-1">
                                    إضافة سلايد جديد <i class="bx bx-plus-circle font-size-20 align-middle me-2 ms-1"></i>

                                </a>
                            @endif
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">


                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الوصف</th>
                                    <th class="text-center">الصورة</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($slides as $slide)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $slide->id }}</th>
                                        <td class="text-center align-middle">{{ $slide->title }}</td>
                                        <td class="text-center align-middle">{{ $slide->description }}</td>
                                        <td class="text-center align-middle"><img
                                                src="{{ asset('../storage/app/public/' . $slide->image) }}" height="100"
                                                alt=""></td>

                                        <td class="text-center align-middle">
                                            {{-- <a href="{{ route('main-slider.edit', $slide->id) }}"
                                                class="btn btn-primary waves-effect waves-light " title="تعديل"><i
                                                    class="bx bxs-edit d-block font-size-16"></i></a> --}}

                                            <form action="{{ route('main-slider.destroy', $slide->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger waves-effect waves-light "
                                                    title="حذف"><i class="bx bx-trash d-block font-size-16"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan="10" class="text-center text-danger align-middle">لا يوجد بيانات لعرضها
                                @endforelse

                                </td>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>



    @include('components.scripts')

    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>

@endsection
