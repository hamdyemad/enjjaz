
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>فريق انجار للكتب التعليمية</title>
    <style>
        .first-table tr td{
            border: 0.7px solid black;
            width: 7%;
            height: 13px;
        }
        .td_number{
            font-size: 13px;
        }

        .td_number2{
            font-size: 16px;
        }
    </style>
</head>


<body style="  height:297mm;
    width:210mm; ">
<table>
    <tr>
        <td>
            @if(in_array('3',request('table')) )
                <table border="1" style="text-align:center; border-color:black;font-size: 13px;" >
                    <tr style="background-color:lightgray;font-weight:bold">
                        @if(request('type') == 0)
                            <td style="background-color:rgb(185, 185, 185);width:4%">#</td>
                            <td style="width:15%; background-color: rgb(241, 241, 241);">رقم العميل</td>
                            <td style="background-color:rgb(185, 185, 185);width:15%">العنوان</td>
                            <td style="background-color:rgb(241, 241, 241);width:7%">الكمية</td>
                            <td style="background-color:rgb(185, 185, 185);width:13%">التاريخ</td>
                            <td style="background-color:rgb(241, 241, 241);width:11%">المبلغ</td>
                            <td style="background-color:rgb(185, 185, 185);width:7%">الشحن</td>
                            <td style="background-color:rgb(241, 241, 241);width:12%">الشركة</td>
                            <td style="background-color:rgb(185, 185, 185);width:17%">الملاحظات</td>
                        @endif
                        @if(request('type') == 1)
                        <td style="background-color:rgb(185, 185, 185);width:10%">#</td>
                            <td style="width:10%; background-color: rgb(241, 241, 241);">المبلغ</td>
                            <td style="background-color:rgb(185, 185, 185);width:7%">الشحن</td>
                            <td style="background-color:rgb(185, 185, 185);width:17%">الشركة</td>
                            <td style="background-color:rgb(241, 241, 241);width:25%">عن الفترة</td>
                            <td style="background-color:rgb(185, 185, 185);width:10%">عدد الأيام</td>
                            <td style="background-color:rgb(241, 241, 241);width:22%">الملاحظات</td>
                        @endif
                    </tr>

                    @foreach($items as $item)

                        <tr>
                            @if(request('type') == 0)
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{$item->address}}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->shipping}}</td>
                                <td>{{$item->client}}</td>
                                <td>{{$item->notes}}</td>
                            @endif
                            @if(request('type') == 1)
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->shipping}}</td>
                                <td>{{$item->client}}</td>
                                <td>{{$item->about_period}}</td>
                                <td>{{ $item->days_count }}</td>
                                <td>{{$item->notes}}</td>
                            @endif
                        </tr>
                        @endforeach
                        @if(request('type') == 0)
                            <tr>
                                <td colspan="5" style="background-color:lightgray;font-weight:bold">المجموع</td>
                                <td>{{ $items->pluck('price')->sum() }}</td>
                                <td>{{ $items->pluck('shipping')->sum() }}</td>
                            </tr>
                        @endif
                        @if(request('type') == 1)
                            <tr>
                                <td colspan="1" style="background-color:lightgray;font-weight:bold">المجموع</td>
                                <td>{{ $items->pluck('price')->sum() }}</td>
                                <td>{{ $items->pluck('shipping')->sum() }}</td>
                            </tr>
                        @endif

                </table>
            @endif

        </td>
    </tr>
</table>

</body>

</html>
