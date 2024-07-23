@extends('layouts.app', [
    'navlinks' => [['title' => 'الرئيسية', 'link' => route('home')], ['title' => 'المراجعات ', 'link' => route('term.index')]],
])
@section('title', 'إدارة المراجعات')
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
                            إدارة المراجعات
                            <a href="{{ route('reviews.index') }}" class="btn btn-primary"><i
                                    class="bx bx-sync font-size-20 align-middle"></i></a> </span>

                    </h4>
                    <hr style="height:1px; background-color: rgb(216, 216, 225);">
                    <form>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" name="user_name" type="checkbox" id="user_name">
                                        <label class="form-check-label" for="user_name">
                                            حسب المستخدم
                                        </label>
                                    </div>
                                    <input name="user_name" type="text" class="form-control " id="formrow-inputCity"
                                        placeholder="ادخل اسم المستخدم اللذي تريد البحث عن مراجعاته">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <input class="form-check-input" name="accommodation_check" type="checkbox"
                                            id="accommodation_check">
                                        <label class="form-check-label" for="accommodation_check">
                                            حسب المسكن
                                        </label>
                                    </div>
                                    <select name="accommodation_search" class="form-select" id="accommodation_search">
                                        @foreach ($accommodations as $accommodation)
                                            <option value="{{ $accommodation->id }}">{{ $accommodation->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" name="date_search_check" type="checkbox"
                                            id="date_search_check">
                                        <label class="form-check-label" for="date_search_check">
                                            البحث بين تاريخين </label>
                                    </div>
                                    <input name="from_date" class="form-control " id="formrow-inputCity"
                                        placeholder="تاريخ البدء" onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <div class="form-check mb-2">
                                        <label class="form-check-label" for="to_date">
                                        </label>
                                    </div>
                                    <input name="to_date" class="form-control" placeholder="تاريخ النهاية"
                                        onfocus="(this.type='date')" onblur="(this.type='text')">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" name="search_reviews" class="btn btn-primary w-md ">بحث</button>
                        </div>
                    </form>

                    <div class="table-responsive  mt-4">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">المستخدم</th>
                                    <th class="text-center">التقييم</th>
                                    <th class="text-center">نوع التعليق</th>
                                    <th class="text-center">اسم السكن / رقم الغرفة / اسم القسم</th>
                                    <th class="text-center">التعليق</th>
                                    <th class="text-center">التاريخ</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reviews as $review)
                                    <tr>
                                        <th class="text-center align-middle" scope="row">{{ $review->id }}</th>
                                        <th class="text-center align-middle" scope="row">{{ $review->user->name }}</th>
                                        <td class="text-center align-middle">{{ $review->rating }}</td>
                                        <td class="text-center align-middle">
                                            @if ($review->entity_type == 'accommodation')
                                                مسكن
                                            @elseif ($review->entity_type == 'room')
                                                غرفة
                                            @elseif ($review->entity_type == 'chalet_section')
                                                قسم الشاليه
                                            @else
                                                غير معروف
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($review->entity_type == 'accommodation' && $review->entity)
                                                {{ $review->entity->name }}
                                            @elseif ($review->entity_type == 'room' && $review->entity)
                                                {{ $review->entity->room_number }}
                                                ({{ $review->entity->accommodation->name }})
                                            @elseif ($review->entity_type == 'chalet_section' && $review->entity)
                                                {{ $review->entity->name }} ({{ $review->entity->accommodation->name }})
                                            @else
                                                غير معروف
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $review->comment }}</td>
                                        <td class="text-center align-middle">{{ $review->created_at}}</td>
                                        <td class="d-flex justify-content-center gap-1">
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger waves-effect waves-light "
                                                    title="حذف" onclick="return confirm('هل تريد حذف المراجعة ؟')">
                                                    <i class="bx bx-trash d-block font-size-16"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger align-middle">لا يوجد بيانات
                                            لعرضها</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $reviews->links('pagination::bootstrap-5') }}

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
        new Selectr(document.getElementById('accommodation_search'));
    </script>
@endsection
