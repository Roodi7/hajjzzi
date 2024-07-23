@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المظهر ', 'link' => route('contactSectionInfo.index')]],
])
@section('title', 'معلومات الفوتر')
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
                            معلومات الفوتر
                            <br>
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">


                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contactSections as $info)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $info->id }}</th>
                                        <td class="text-center align-middle">{{ $info->title }}</td>

                                        <td class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('contactSectionInfo.edit', $info->id) }}"
                                                class="btn btn-primary waves-effect waves-light " title="تعديل"><i
                                                    class="bx bxs-edit d-block font-size-16"></i></a>
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
