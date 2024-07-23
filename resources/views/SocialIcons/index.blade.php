@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'ايقونات التواصل الاجتماعي   ', 'link' => route('social-icons.index')]],
])
@section('title', 'إدارة ايقونات التواصل الاجتماعي ')
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
                            إدارة ايقونات التواصل الاجتماعي

                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('social-icons.index') }}"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>
                            @if (Auth::user()->permissions->manage_mainpage)
                                <a href="{{ route('social-icons.create') }}"
                                    class="btn btn-success waves-effect waves-light me-1">
                                    إضافة ايقونة جديدة <i class="bx bx-plus-circle font-size-20 align-middle me-2 ms-1"></i>

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
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">الرابط</th>
                                    <th class="text-center">الايقونة</th>
                                    <th class="text-center">الترتيب</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($socialMediaIcons as $icon)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $icon->id }}</th>
                                        <td class="text-center align-middle">{{ $icon->name }}</td>
                                        <td class="text-center align-middle">{{ $icon->url }}</td>
                                        <td class="text-center align-middle"><i class="{{ $icon->icon }} font-size-24 bg-dark text-light p-1 rounded"></i></td>
                                        <td class="text-center align-middle">{{ $icon->order }}</td>

                                        <td class="text-center align-middle">
                                            <form action="{{ route('social-icons.destroy', $icon->id) }}" method="POST">
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
