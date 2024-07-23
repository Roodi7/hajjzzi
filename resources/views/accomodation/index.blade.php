@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => '#']],
])
@section('title', 'إدارة المساكن')
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
                            إدارة المساكن
                            <small>يمكنك ادارة الفنادق,الشاليهات,الصالات...</small>
                        </span>
                        <div class="col-md-3 text-end" style="float:left">

                            @if (Auth::user()->permissions->accomodation_create)
                                <a href="{{ route('accomodations.create', $type) }}"
                                    class="btn btn-success waves-effect waves-light me-1">
                                    إضافة<i class="bx bx-plus-circle font-size-20 align-middle me-2 ms-1"></i>

                                </a>
                            @endif
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <div class="row" style="margin-top:14px;">
                        <div class="col-md-3"></div>

                    </div>

                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">النوع</th>
                                    <th class="text-center">المدينة</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accomodations as $accomodation)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $accomodation->id }}</th>
                                        <td class="text-center align-middle">{{ $accomodation->name }}</td>
                                        <td class="text-center align-middle">{{ $accomodations_type[$accomodation->type] }}
                                        </td>
                                        <td class="text-center align-middle">{{ $accomodation->city_name }}</td>


                                        <td class="d-flex justify-content-center gap-1">
                                            @if ($type == 'chalet')
                                                <a href="{{ route('chalet_section.create', $accomodation->id) }}"
                                                    class="btn btn-success waves-effect waves-light "
                                                    title="اضافة جناح للشاليه">
                                                    اضافة جناح للشاليه <i class='bx bx-plus-circle'></i></a>
                                            @else
                                                @if ($type == 'hotel')
                                                    <a href="{{ route('accommodation.add_room', $accomodation->id) }}"
                                                        class="btn btn-success waves-effect waves-light "
                                                        title="اضافة غرفة">
                                                        اضافة غرفة <i class='bx bx-plus-circle'></i></a>
                                                @endif
                                            @endif
                                            <a href="{{ route('accommodation.add_feature', $accomodation->id) }}"
                                                class="btn btn-success waves-effect waves-light " title="اضافة ميزة">
                                                اضافة ميزة/ملحق <i class='bx bx-plus-circle'></i></a>
                                            <a href="{{ route('accommodation.add_term', $accomodation->id) }}"
                                                class="btn btn-success waves-effect waves-light " title="اضافة شرط">
                                                اضافة شرط <i class='bx bx-plus-circle'></i></a>
                                            <a href="{{ route('accomodation.edit', $accomodation->id) }}"
                                                class="btn btn-primary waves-effect waves-light " title="تعديل"><i
                                                    class="bx bxs-edit d-block font-size-16"></i></a>

                                            <a href="{{ route('accomodation.show', $accomodation->id) }}"
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
