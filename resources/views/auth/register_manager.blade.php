@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            تسجيل مدير لمسكن</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('accommodation_manager.post') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-12 mb-2">
                                    <label for="accommodation_id" class="form-label">تحديد مسكن</label>
                                    <select id="accommodation_id" class="form-control" name="accommodation_id" required>
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}">{{ $accommodation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
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
                                <div class="col-md-6 mb-2">
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

                                <div class="col-md-6 mb-2">
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


                                <div class="col-md-6 mb-2">
                                    <label for="password-confirm" class="form-label">تأكيد كلمة السر</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <br><br>
                            </div>

                            <div class="row">
                                <div class="mt-4 d-flex gap-4">
                                    <button class="btn btn-success waves-effect waves-light" type="submit">حفظ</button>
                                    <a href="{{ route('user.managers') }}"
                                        class="btn btn-primary waves-effect waves-light">الرجوع
                                        لإدارة المدراء</a>
                                </div>
                                <div class="mb-4"></div>
                        </form>

                        <br><br><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.scripts')
    
    <script src="{{ asset('assets/js/selectr.min.js') }}"></script>.

    <script>
        new Selectr(document.getElementById('accommodation_id'));
    </script>
@endsection
