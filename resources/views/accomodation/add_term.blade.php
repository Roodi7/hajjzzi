@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المساكن ', 'link' => "#"]],
])
@section('title', 'إضافة شرط للمسكن')
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
                            إضافة شرط للمسكن
                            <br>
                            <br>
                            {{ $accommodation->name }}
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".add-tax-modal">إضافة شرط جديدة</a>

                            <div class="modal fade add-tax-modal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">إضافة شرط جديد</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <form action="{{ route('accommodation.add_term_post', $accommodation->id) }}"
                                                class="row g-3 needs-validation" method="POST">
                                                @method('POST')
                                                @csrf
                                                <div class="col-md-12 my-1">
                                                    <label class="form-label" for="term_id">الشروط</label>
                                                    <select class="form-select" name="term_id[]" id="term_id"
                                                        type="text" required multiple>
                                                        <option value="">---</option>
                                                        @foreach ($terms as $term)
                                                            <option value="{{ $term->id }}">{{ $term->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <input type="text" name="accommodation_id"
                                                    value="{{ $accommodation->id }}" hidden>

                                                <button type="submit" class="btn btn-success">إضافة الشرط</button>
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
                                @forelse ($accommodationterms as $accterm)
                                    <tr>
                                        {{-- @dd($accterm) --}}
                                        <th class="text-center align-middle" scope="row">{{ $accterm->id }}
                                        </th>
                                        <td class="text-center align-middle">{{ $accterm->name }}</td>

                                        <td class="text-center align-middle">{{ $accterm->description }}</td>


                                        <td class="d-flex justify-content-center gap-1">
                                            <form action="{{ route('accommodation.delete_term', $accterm->id) }}"
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
        new Selectr(document.getElementById('term_id'));
    </script>

@endsection
