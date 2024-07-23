@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الشروط ', 'link' => route('term.index')]],
])
@section('title', 'إدارة الشروط')
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
                            إدارة الشروط
                            <br>
                            <small>الشروط الخاصة بالمساكن</small>
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('term.index') }}"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>
                                <a href="{{ route('term.create') }}"
                                    class="btn btn-success waves-effect waves-light me-1">
                                    إضافة شرط <i class="bx bx-plus-circle font-size-20 align-middle me-2 ms-1"></i>

                                </a>
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <div class="row" style="margin-top:14px;">
                        <div class="col-md-6">
                            <form action="{{ route('term.index') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search_Lvl" value="{{ $search_Lvl }}"
                                        class="form-control rounded" placeholder="بحث حسب الاسم" />

                                    <button type="submit" class="btn btn-primary">بحث</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>

                    </div>

                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الشرط</th>
                                    <th class="text-center">الوصف</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($terms as $term)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $term->id }}</th>
                                        <td class="text-center align-middle">{{ $term->name }}</td>
                                        <td class="text-center align-middle">{{ $term->description }}</td>

                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('term.edit', $term->id) }}"
                                                class="btn btn-primary waves-effect waves-light " title="تعديل"><i
                                                    class="bx bxs-edit d-block font-size-16"></i></a>

                                            <a href="{{ route('term.show', $term->id) }}"
                                                class="btn btn-danger waves-effect waves-light " title="حذف"><i
                                                    class="bx bx-info-circle d-block font-size-16"></i></a>
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
