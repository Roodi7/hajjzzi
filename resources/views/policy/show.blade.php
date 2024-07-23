@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المدن ', 'link' => route('city.index')]],
])
@section('title', 'تعديل مدينة')
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex justify-content-between mb-4">
                        <span>
                            تعديل المدينة
                        </span>
                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form action="#" class="repeater" method="POST" enctype="multipart/form-data">

                        <div class="row d-flex ">
                            <div class="col-md-6 mb-2">
                                <label for="city_name" class="form-label">اسم المدينة</label>
                                <input id="city_name" type="text"
                                    class="form-control @error('city_name') is-invalid @enderror" readonly name="city_name"
                                    value="{{ $city->city_name }}" required autocomplete="city_name">

                                @error('city_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="col-md-6 mb-2">
                                <label for="details" class="form-label">التفاصيل</label>
                                <input id="details" type="text"
                                    class="form-control @error('details') is-invalid @enderror" readonly name="details"
                                    value="{{ $city->details }}" autocomplete="details" autofocus>

                                @error('details')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="description" class="form-label">الوصف</label>
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" readonly
                                    name="description" value="{{ old('description') }}" autocomplete="description" autofocus>{{ $city->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="notes" class="form-label">الملاحظات</label>
                                <textarea id="notes" type="text" class="form-control @error('notes') is-invalid @enderror" readonly
                                    name="notes" value="{{ old('notes') }}" autocomplete="notes" autofocus>{{ $city->notes }}</textarea>

                                @error('notes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="my-3">
                                <p>الصور</p>
                                <div class="row my-3">

                                    @forelse ($city->attachments as $attachment)
                                        <div class="col-md-3">
                                            <a class="my-3" href="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                target="_blank" rel="noopener noreferrer"><img
                                                    src="{{ asset('storage/' . $attachment->attachment_path) }}"
                                                    alt="" height="150"></a>
                                        </div>

                                    @empty
                                        لا يوجد مرفقات قديمة
                                    @endforelse
                                </div>

                            </div>

                    </form>
                    <div class="col-md-6 text-right">
                        <div class="">


                            <a type="button" class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target=".bs-example-modal-center">حذف</a>
                            @include('components.delete_modal', [
                                'delete_route' => route('city.destroy', $city->id),
                                'warning_message' => 'هل انت متأكد من رغبتك بحذف المدينة ' . $city->city_name,
                            ])
                            <a href="{{ route('city.index') }}" class="btn btn-primary">الرجوع
                                للصفحة الرئيسية </a>
                        </div>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    @include('components.scripts')


@endsection
