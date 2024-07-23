@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => route('accomodation.index')]],
])
@section('title', 'إضافة ميزة للجناح')
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
                            إضافة ميزة/ملحق للجناح
                            <br>
                            <br>
                            ({{ $chalet_section->accommodation->name }})
                            اسم الجناح : {{ $chalet_section->name }}
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".add-tax-modal">إضافة ملحق/ميزة جديدة</a>

                            <div class="modal fade add-tax-modal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">إضافة ملحق/ميزة جديد</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form action="{{ route('chaletsection.add_feature_post', $chalet_section->id) }}"
                                                class="row g-3 needs-validation" method="POST">
                                                @method('POST')
                                                @csrf
                                                <div class="col-md-12 my-1">
                                                    <label class="form-label" for="feature_id">الميزات والملحقات</label>
                                                    <select class="form-select" name="feature_id[]" id="feature_id"
                                                        type="text" required multiple>
                                                        <option value="">---</option>
                                                        @foreach ($features as $feature)
                                                            <option value="{{ $feature->id }}">{{ $feature->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="text" name="chalet_section_id" value="{{ $chalet_section->id }}" hidden>

                                                <button type="submit" class="btn btn-success">إضافة الملحق/ميزة</button>
                                            </form>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">


                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الميزة/الملحق</th>
                                    <th class="text-center">الوصف</th>
                                    <th class="text-center">حذف</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($chalet_sectionFeatures as $sectionFeature)
                                    <tr>
                                        {{-- @dd($sectionFeature) --}}
                                        <th class="text-center align-middle" scope="row">{{ $sectionFeature->id }}
                                        </th>
                                        <td class="text-center align-middle">{{ $sectionFeature->name }}</td>

                                        <td class="text-center align-middle">{{ $sectionFeature->description }}</td>


                                        <td class="d-flex justify-content-center gap-1">
                                           
                                            <form action="{{ route('chaletsection.delete_feature', $sectionFeature->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger waves-effect waves-light " title="حذف"
                                                    type="submit"><i class="bx bx-trash d-block font-size-16"></i></button>
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

    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>.

    <script>
        new Selectr(document.getElementById('feature_id'));
    </script>

@endsection
