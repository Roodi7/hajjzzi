<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ Request::root() }}/vendors/overlayscrollbars/OverlayScrollbars.min.css" rel="stylesheet">
    <!-- Bootstrap Css -->
    <link href="{{ URL('assets/css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ Request::root() }}/style.css">
    <style>
        .table th,
        .table td {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        @media print {
            @page {
                margin-top: 0;
                margin-bottom: 0;
            }

            body {
                padding-top: 0;
                padding-bottom: 72px;
            }

            * {
                font-family: doridregular !important;
            }

            th,
            td {
                text-align: center;
                border: 1px solid #515050 !important;
                padding: 7px;
            }

        }
    </style>
    <title>Document</title>
</head>

<body onload="window.print()">

    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <div class=" d-flex ">
                    <div class="col">
                        <p style="font-size: 16px;"><strong>Hajjzi Co</strong></p>
                        <p style="font-size: 14px;"><strong>099090909</strong></p>
                        <p style="font-size: 14px;"><strong>التاريخ: {{ now()->format('Y-m-d') }}</strong></p>
                    </div>


                </div>
                <h3 class="text-center"> Hajjzi Co</h3>

                </span>
            </div>

            <div class="table-responsive  mt-4">
                <table id="table1" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">المسكن</th>
                            <th class="text-center">غرفة/جناح</th>
                            <th class="text-center">المستخدم</th>
                            <th class="text-center">اسم الحجز</th>
                            <th class="text-center">رقم الحجز</th>
                            <th class="text-center">تاريخ البداية</th>
                            <th class="text-center">تاريخ النهاية</th>
                            <th class="text-center">الحالة</th>
                            <th class="text-center">حالة الدفع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                        <tr>
                            <td class="text-center align-middle">{{ $reservation->id }}</td>
                            <td class="text-center align-middle">{{ $reservation->accommodation->name }}</td>
                            <td class="text-center align-middle">
                                @if ($reservation->room_id)
                                    Room: {{ $reservation->room->room_number }}
                                @elseif ($reservation->chalet_section_id)
                                    Chalet Section: {{ $reservation->chaletSection->name }}
                                @else
                                    Whole Accommodation
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ $reservation->user->name }}</td>
                            <td class="text-center align-middle">{{ $reservation->name }}</td>
                            <td class="text-center align-middle">{{ $reservation->phone_number }}</td>
                            <td class="text-center align-middle">{{ $reservation->start_date }}</td>
                            <td class="text-center align-middle">{{ $reservation->end_date }}</td>
                            <td class="text-center align-middle">

                                <span
                                    class="badge badge-pill badge-soft-{{ $reservation->status == 'accepted' ? 'success' : ($reservation->status == 'rejected' ? 'danger' : 'warning') }} font-size-11">{{ $reservation->status }}</span>

                            </td>
                            <td class="text-center align-middle">
                                <span
                                    class="badge badge-pill badge-soft-{{ $reservation->pay_status == 'paid' ? 'success' : 'danger' }} font-size-11">{{ $reservation->pay_status == 'paid' ? 'Paid' : 'Not Paid' }}</span>
                            </td>
               
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
    </div>
</body>

</html>
