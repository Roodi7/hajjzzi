@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المستخدمين ', 'link' => route('all_users.index')]],
])
@section('title', 'كافة المستخدمين')
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
                            كافة المستخدمين
                            <br>
                        </span>
                        <div class="col-md-3 text-end" style="float:left">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('user.index') }}"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a>
                        </div>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <div class="card  shadow-none card-body text-muted mb-0">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <div class="form-check mb-2">

                                            <label class="form-check-label" for="user_name_check">
                                                البحث حسب اسم المستخدم
                                            </label>
                                        </div>
                                        <input name="user_name" type="text" class="form-control " id="formrow-inputCity"
                                            placeholder="اسم المستخدم">
                                    </div>
                                    <div>
                                        <button type="submit" name="search" class="btn btn-primary w-md ">بحث</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">الايميل</th>
                                    <th class="text-center">role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $user->id }}</th>
                                        <td class="text-center align-middle">{{ $user->name }}</td>
                                        <td class="text-center align-middle">{{ $user->email }}</td>
                                        <td class="text-center align-middle">{{ $user->role }}</td>

                                    
                                    </tr>
                                @empty
                                    <td colspan="10" class="text-center text-danger align-middle">لا يوجد بيانات لعرضها
                                @endforelse

                                </td>

                            </tbody>
                        </table>

                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            <div style="margin-top: 100px"></div>
        </div>
        <!--end col-->
    </div>



    @include('components.scripts')


@endsection
