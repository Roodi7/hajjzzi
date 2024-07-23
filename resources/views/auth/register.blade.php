@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            تسجيل مستخدم</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-3 mb-2">
                                    <label for="name" class="form-label">اسم المستخدم</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="email" class="form-label">الايميل</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email" required
                                        autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-3 mb-2">
                                    <label for="userpassword" class="form-label">كلمة السر</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-md-3 mb-2">
                                    <label for="password-confirm" class="form-label">تأكيد كلمة السر</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row">
                                <div class="row d-flex justify-content-center">
                                    <hr class="bg-light my-3" style="height: 3px;width:80%">
                                </div>
                                <div class="col-md-4 my-1">
                                    <input id="cities_check" name="manage_cities" class="form-check-input me-1" type="checkbox">
                                    <label  class="form-check-label" for="cities_check"> إدارة
                                        المدن</label>

                                </div>
                                <div class="col-md-4 my-1">
                                    <input id="manage_accomodations" name="manage_accomodations" class="form-check-input me-1" type="checkbox">
                                    <label  class="form-check-label" for="manage_accomodations">
                                        إدارة
                                        المساكن</label>

                                </div>
                                <div class="col-md-4 my-1">
                                    <input id="manage_featuers" name="manage_featuers"  class="form-check-input me-1" type="checkbox">
                                    <label class="form-check-label" for="manage_featuers"> إدارة
                                        الميزات</label>

                                </div>

                                <div class="col-md-4 my-1">
                                    <input id="manage_terms" name="manage_terms" class="form-check-input me-1" type="checkbox">
                                    <label class="form-check-label" for="manage_terms"> إدارة
                                        الشروط</label>

                                </div>
                                <div class="col-md-4 my-1">
                                    <input id="manage_mainpage" name="manage_mainpage" class="form-check-input me-1" type="checkbox">
                                    <label  class="form-check-label" for="manage_mainpage"> إدارة
                                        الصفحة الرئيسية</label>

                                </div>

                                <div class="col-md-4 my-1">
                                    <input id="manage_users" name="manage_users" class="form-check-input me-1" type="checkbox">
                                    <label class="form-check-label" for="manage_users"> إدارة
                                        المستخدمين</label>

                                </div>

                                <div class="mt-4 d-flex gap-4">
                                    <button class="btn btn-success waves-effect waves-light" type="submit">حفظ</button>
                                    <a href="{{route('user.index')}}" class="btn btn-primary waves-effect waves-light">الرجوع
                                        لإدارة المستخدمين</a>
                                </div>
                                <div class="mb-4"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.scripts')

@endsection
