@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'الأيميلات ', 'link' => route('contact-mails.index')]],
])
@section('title', 'إدارة الايميلات')
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
                            إدارة الايميلات
                            <br>
                            <small>ايميلات التواصل</small>
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('contact-mails.index') }}"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>

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
                                    <th class="text-center">الايميل</th>
                                    <th class="text-center">العنوان</th>
                                    <th class="text-center">الحالة</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contactMails as $mail)
                                    <tr>
                                        <td class="text-center align-middle">{{ $mail->id }}</td>
                                        <td class="text-center align-middle">{{ $mail->name }}</td>
                                        <td class="text-center align-middle">{{ $mail->email }}</td>
                                        <td class="text-center align-middle">{{ $mail->subject }}</td>
                                        <td class="text-center align-middle">
                                            <span
                                                class="badge badge-pill badge-soft-{{ $mail->replay != null ? 'success' : 'danger' }} font-size-11">{{ $mail->replay != null ? 'تم الرد' : 'لم يتم الرد بعد' }}</span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ route('contact-mails.reply', $mail->id) }}"
                                                class="btn btn-primary">رد</a>
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
