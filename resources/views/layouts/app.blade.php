<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL('storage/' . $SettingsModel->favicon) }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ URL('assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/css/bootstrap-icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/boxicons/css/boxicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL('assets/libs/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ URL('assets/css/selectr.min.css') }}">
    <link href="{{ URL('assets/css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <script src="{{ URL('assets/js/jquery.js') }}"></script>
    <script src="{{ Request::root() }}/js/custom.js"></script>
    <script src="{{ Request::root() }}/js/number-to-word-2.js"></script>
    <script src="{{ URL('assets/js/form-repeater.int.js') }}"></script>
    <script src="{{ URL('assets/js/jquery.repeater.min.js') }}"></script>
    <script src="{{ URL('assets/js/selectr.min.js') }}"></script>



    <style>
        .nav-item {
            padding-top: 5px !important;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    <style>
        .nav-item {
            padding-top: 5px !important;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .responsive-two-columns {
            display: flex;
            flex-wrap: wrap;
        }

        /* columns */
        .responsive-two-columns>* {
            width: 100%;
            padding: 1rem;
        }

        /* tablet breakpoint */
        @media (min-width:768px) {
            .responsive-two-columns>* {
                width: 50%;
            }
        }

        .section_right {
            background-color: #00283b;
            width: 40%;


        }

        .section_left {
            background-color: #fcc51e;
            width: 60%;


        }


        .casher_table {
            border-collapse: collapse;
            width: 100%;
        }

        .casher_table th,
        td {
            text-align: center;
            padding: 8px;
        }

        .casher_table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn_casher_type {
            background: #00283b;
            color: #fcc51e;
            font-size: 15px;
            padding: 10px 15px;
            margin-right: 10px
        }

        .btn_casher_type:hover {
            background: #00283b;
            color: #fcc51e;
            font-size: 15px;
            padding: 10px 15px;
            margin-right: 10px
        }

        .btn_casher_type:focus {
            background: #01212f;
            color: #cd9e10;
            font-size: 15px;
            padding: 10px 15px;
            margin-right: 10px
        }

        .button_types {
            margin-top: 10px;
            margin-bottom: 10px
        }

        .casher_material_btn {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 8px 11px;
            font-size: 18px;
            border: 1px solid #fcc51e;
            background-color: #fcc51e;
            color: #00283b;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 5px
        }

        .casher_material_btn:hover {
            padding: 8px 11px;
            font-size: 18px;
            border: 1px solid #fcc51e;
            background-color: #fcc51e;
            color: #00283b;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 5px
        }

        .casher_material_btn:focus {
            padding: 8px 11px;
            font-size: 18px;
            border: 1px solid #fcc51e;
            background-color: #dcab1a;
            color: #00283b;
            margin-left: 10px;
            margin-right: 10px;
            border-radius: 5px
        }
    </style>
</head>

<body data-sidebar="dark" data-layout-mode="dark" id="page_body">
    <script>
        if (localStorage.getItem('mythemecolormode') == 'dark') {
            document.getElementById('page_body').setAttribute('data-layout-mode', 'dark');

        } else {
            document.getElementById('page_body').setAttribute('data-layout-mode', 'light');
        }
    </script>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box" style=" height: 90px !important;">
                        <a href="#" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ URL('assets/images/logo.svg') }}" alt="" height="22" />
                            </span>
                            <span class="logo-lg">
                                <img src="{{ URL('assets/images/logo-dark.png') }}" alt="" height="17" />
                            </span>
                        </a>
                        <a href="{{ url('/home') }}" class="logo logo-light">
                            <span class="logo-sm">
                                {{-- <img src="{{ URL('assets/images/logo-light.svg') }}" alt="" height="20" /> --}}
                            </span>
                            <span class="logo-lg" style="font-size:14px;color:white">
                                {{-- <img src="{{ URL('assets/images/logo-light.png') }}" alt="" height="30" /> --}}

                                {{ $SettingsModel->site_title }}</span>
                        </a>
                        <a href="{{ url('/home') }}" class="logo logo-light">

                            <div id="image-container" style="display: none;margin-top:20">
                                <img src="{{ URL('storage/' . $SettingsModel->logo) }}" width="40"
                                    alt="صورة سريعة">
                            </div>
                        </a>
                    </div>

                    {{-- 
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button> --}}
                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>


                </div>
                <div class="d-flex">
                    <div class="dropdown d-inline-block d-lg-none ms-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                            aria-labelledby="page-header-search-dropdown">
                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username" />
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="dropdown d-none d-lg-inline-block ms-1">
                        <div class="mt-4 text-primary" id="digital-clock" dir="ltr"></div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="mdi mdi-theme-light-dark font-size-24"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <!-- item-->
                            <label class="form-check-label" for="darkradio">

                                <div class="dropdown-item  language">
                                    <input class="form-check-input " type="radio" name="darklightswitch"
                                        id="darkradio" value="dark">
                                    نمط الألوان الداكن
                                </div>
                            </label>
                            <label class="form-check-label" for="lightradio">

                                <div class="dropdown-item  language">
                                    <input class="form-check-input " type="radio" name="darklightswitch"
                                        id="lightradio" value="light">
                                    نمط الألوان الفاتح
                                </div>
                            </label>
                        </div>
                    </div>
                    {{-- <div class="dropdown d-none d-lg-inline-block ms-1">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            data-bs-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div> --}}
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <img class="rounded-circle header-profile-user" src="{{ URL('assets/images/250.png') }}"
                                alt="Header Avatar" /> --}}
                            <span class="d-none d-xl-inline-block ms-1"
                                key="t-henry">{{ Auth::user()->name }}</span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item text-danger" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                <span key="t-logout">تسجيل الخروج</span>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </div>
                    </div>
                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="bx bx-cog"></i>
                        </button>
                    </div>
                </div>
            </div>
        </header>


        <div class="vertical-menu">
            <div data-simplebar class="h-100">
                <div id="sidebar-menu">

                    <ul class="metismenu list-unstyled" id="side-menu">
                        {{-- <li class="menu-title font-size-14" key="t-menu">القائمة الرئيسية</li> --}}
                        @if (Auth::user()->permissions->city_index)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-city"></i>
                                    <span key="t-dashboards">المدن</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('city.index') }}" key="t-basic-tables">المدن</a>
                                    </li>
                                    <li><a href="{{ route('city.create') }}" key="t-basic-tables">اضافة مدينة</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->permissions->accomodation_index || Auth::user()->managedAccommodations != null)
                            @if (Auth::user()->permissions->accomodation_index || Auth::user()->managedAccommodations->type == 'hotel')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxs-building"></i>
                                        <span key="t-dashboards">الفنادق</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li><a href="{{ route('accomodations.index', 'hotel') }}"
                                                key="t-basic-tables">الفنادق</a>
                                        </li>
                                        @if (Auth::user()->permissions->accomodation_create)

                                            <li><a href="{{ route('accomodations.create', 'hotel') }}"
                                                    key="t-basic-tables">اضافة
                                                    فندق</a>
                                            </li>
                                            @endif
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->permissions->accomodation_index || Auth::user()->managedAccommodations->type == 'chalet')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxs-building"></i>
                                        <span key="t-dashboards">الشاليهات</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li><a href="{{ route('accomodations.index', 'chalet') }}"
                                                key="t-basic-tables">الشاليهات</a>
                                        </li>
                                        @if (Auth::user()->permissions->accomodation_create)

                                        <li><a href="{{ route('accomodations.create', 'chalet') }}"
                                                key="t-basic-tables">اضافة
                                                شاليه</a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->permissions->accomodation_index || Auth::user()->managedAccommodations->type == 'appartment')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxs-building"></i>
                                        <span key="t-dashboards">الشقق</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li><a href="{{ route('accomodations.index', 'appartment') }}"
                                                key="t-basic-tables">الشقق</a>
                                        </li>
                                        @if (Auth::user()->permissions->accomodation_create)
                                        <li><a href="{{ route('accomodations.create', 'appartment') }}"
                                                key="t-basic-tables">اضافة شقة</a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if (Auth::user()->permissions->accomodation_index || Auth::user()->managedAccommodations->type == 'hall')
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <i class="bx bxs-building"></i>
                                        <span key="t-dashboards">الصالات</span>
                                    </a>
                                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                                        <li><a href="{{ route('accomodations.index', 'hall') }}"
                                                key="t-basic-tables">الصالات</a>
                                        </li>
                                        @if (Auth::user()->permissions->accomodation_create)

                                        <li><a href="{{ route('accomodations.create', 'hall') }}"
                                                key="t-basic-tables">اضافة
                                                صالة</a>
                                        </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user()->permissions->feature_index)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bxs-category"></i>
                                    <span key="t-dashboards">الميزات والملحقات</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('feature.index') }}" key="t-basic-tables">الميزات
                                            والملحقات</a>
                                    </li>
                                    <li><a href="{{ route('feature.create') }}" key="t-basic-tables">اضافة
                                            ميزة</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class='bx bx-list-ul'></i>
                                <span key="t-dashboards">الحجوزات</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="{{ route('reservations.index') }}" key="t-basic-tables">عرض
                                        الحجوزات</a>
                                </li>
                            </ul>
                        </li>


                        @if (Auth::user()->permissions->term_index)
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-spreadsheet'></i>
                                    <span key="t-dashboards">الشروط</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('term.index') }}" key="t-basic-tables">الشروط</a>
                                    </li>
                                    <li><a href="{{ route('term.create') }}" key="t-basic-tables">اضافة شرط</a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        @if (Auth::user()->role=="admin")
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class='bx bxs-star'></i>
                                <span key="t-dashboards">المراجعات (التقييمات)</span>
                            </a>
                            <ul class="sub-menu mm-collapse" aria-expanded="false">
                                <li><a href="{{ route('reviews.index') }}" key="t-basic-tables">المراجعات</a>
                                </li>
                           
                            </ul>
                        </li>
                        @endif
                        @if (Auth::user()->permissions->manage_mainpage)
                            <li class="menu-title" key="t-menu">الصفحة الرئيسية</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-category'></i>
                                    <span key="t-dashboards">السلايدر</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('main-slider.index') }}" key="t-basic-tables">عرض
                                            السلايدات</a>
                                    </li>
                                    <li><a href="{{ route('main-slider.create') }}" key="t-basic-tables">اضافة
                                            سلايد</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-category"></i>
                                    <span key="t-dashboards">الخدمات الرئيسية</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('main-services.index') }}" key="t-basic-tables">عرض
                                            الخدمات</a>
                                    </li>
                                    <li><a href="{{ route('main-services.create') }}" key="t-basic-tables">اضافة
                                            خدمة</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-category"></i>
                                    <span key="t-dashboards">الاسئلة المتكررة</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('repeated-questions.index') }}" key="t-basic-tables">عرض
                                            الاسئلة</a>
                                    </li>
                                    <li><a href="{{ route('repeated-questions.create') }}" key="t-basic-tables">اضافة
                                            سؤال</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-shield-quarter'></i> <span key="t-dashboards">
                                        سياسة الخصوصية</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('policy.index') }}" key="t-basic-tables">عرض </a>
                                    </li>
                                    <li><a href="{{ route('policy.create') }}" key="t-basic-tables">اضافة
                                            جديد</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-shield'></i> <span key="t-dashboards">
                                        شروط الخدمة</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('privacy-policy.index') }}" key="t-basic-tables">عرض
                                        </a>
                                    </li>
                                    <li><a href="{{ route('privacy-policy.create') }}" key="t-basic-tables">اضافة
                                            شرط</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bxs-ruler'></i>
                                    <span key="t-dashboards">قسم الفوتر</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('contactSectionInfo.index') }}" key="t-basic-tables">عرض
                                            المعلومات</a>
                                    </li>

                                </ul>
                            </li>



                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-shape-circle'></i>
                                    <span key="t-dashboards">وصف الاقسام</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('sections.edit') }}" key="t-basic-tables">تعديل
                                            الوصف</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-shape-circle'></i>
                                    <span key="t-dashboards">قسم الاعلانات</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('discount_and_marketing.index') }}"
                                            key="t-basic-tables">تعديل</a>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bxs-map-alt'></i>
                                    <span key="t-dashboards">ايقونات التواصل</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('social-icons.index') }}" key="t-basic-tables">عرض
                                            الايقونات</a>
                                    </li>
                                    <li><a href="{{ route('social-icons.create') }}" key="t-basic-tables">اضافة
                                            ايقونة</a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (Auth::user()->permissions->manage_users)
                            <li class="menu-title" key="t-menu">المستخدمين</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-envelope'></i><span key="t-dashboards">
                                        الايميلات الواردة</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('contact-mails.index') }}" key="t-basic-tables">عرض
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class='bx bx-user'></i><span key="t-dashboards">
                                        إدارة المستخدمين</span>
                                </a>
                                <ul class="sub-menu mm-collapse" aria-expanded="false">
                                    <li><a href="{{ route('user.index') }}" key="t-basic-tables">عرض </a>
                                    </li>
                                    <li><a href="{{ route('user.create') }}" key="t-basic-tables">انشاء مدراء
                                        </a>
                                    </li>

                                    <li><a href="{{ route('user.managers') }}" key="t-basic-tables">مدراء المساكن
                                        </a>
                                    </li>

                                    <li><a href="{{ route('all_users.index') }}" key="t-basic-tables">كافة المستخدمين
                                    </a>
                                </li>

                                </ul>
                            </li>
                        @endif

                    </ul>

                    </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <br><br><br>
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <div class="page-title-right">
                                        @isset($navlinks)

                                            <ol class="breadcrumb m-0">

                                                @foreach ($navlinks as $item)
                                                    <li class="breadcrumb-item">
                                                        <a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                                                    </li>
                                                @endforeach
                                                <li class="breadcrumb-item active">@yield('title')</li>
                                            </ol>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                © Hajjzi Co.
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">
                    <h5 class="m-0 me-2">الإعدادات</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>
                <hr class="mt-0" />
                <h6 class="text-center mb-0">اختر نسق الألوان المناسب لك</h6>
                <div class="p-4">
                    <input hidden class="form-check-input " type="radio" name="darklightswitch" id="darkradio"
                        value="dark">
                    <label class="form-check-label mb-2" for="darkradio">
                        نمط الألوان الداكن

                        <img src="{{ URL('assets/images/layouts/layout-4.jpg') }}" class="img-thumbnail"
                            alt="layout images" />
                    </label>
                    <input hidden class="form-check-input mb-2" type="radio" name="darklightswitch"
                        id="lightradio" value="light">
                    <label class="form-check-label" for="lightradio">
                        نمط الألوان الفاتح

                        <img src="{{ URL('assets/images/layouts/layout-3.jpg') }}" class="img-thumbnail"
                            alt="layout images" />
                    </label>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        <script src="{{ URL('assets/select/chosen.jquery.js') }}" type="text/javascript"></script>
        <script src="{{ URL('assets/select/docsupport/init.js') }}" type="text/javascript" charset="utf-8"></script>

        <script>
            var verticalMenuBtn = document.getElementById("vertical-menu-btn");
            var imageContainer = document.getElementById("image-container");
            verticalMenuBtn.addEventListener("click", function() {
                if (imageContainer.style.display === "none") {
                    imageContainer.style.display = "block";
                } else {
                    imageContainer.style.display = "none";
                }
            });




            $('input[type=radio][name=darklightswitch]').change(function() {
                if (this.value == 'dark') {
                    document.getElementById('page_body').setAttribute('data-layout-mode', 'dark');
                    localStorage.setItem('mythemecolormode', 'dark'); //set
                } else if (this.value == 'light') {
                    document.getElementById('page_body').setAttribute('data-layout-mode', 'light');
                    localStorage.setItem('mythemecolormode', 'light'); //set
                }
            });

            function Time() {
                var date = new Date();
                var hour = date.getHours();
                var minute = date.getMinutes();
                var second = date.getSeconds();
                var period = "";
                if (hour >= 12) {
                    period = "PM";
                } else {
                    period = "AM";
                }
                if (hour == 0) {
                    hour = 12;
                } else {
                    if (hour > 12) {
                        hour = hour - 12;
                    }
                }
                hour = update(hour);
                minute = update(minute);
                second = update(second);
                document.getElementById("digital-clock").innerText = hour + " : " + minute + " : " + second + " " + period;
                setTimeout(Time, 1000);
            }

            function update(t) {
                if (t < 10) {
                    return "0" + t;
                } else {
                    return t;
                }
            }
            Time();
        </script>
</body>

</html>
