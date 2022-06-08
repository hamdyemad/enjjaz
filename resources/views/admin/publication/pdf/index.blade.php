
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>فريق انجار للكتب التعليمية</title>
</head>

<body>
    <table  border="1" style="text-align:center; border-color:black; font-size: 12px">
        <tr style="background-color:lightgray;font-weight:bold; @if(request('type') == 2) font-size: 10px @endif">
        <th width="5%">#</th>
        @if(request('type') == 2 || request('type') == 0)
            <th @if(request('type') == 0) width="30%" @elseif(request('type') == 2) width="25%" @endif>اسم الكتاب</th>
        @endif
        @if(request('type') == 1)
            <th width="30%">اسم المطبوع</th>
        @endif
        @if(request('type') == 2)
            <th width="15%">اسم العميل</th>
        @endif
        <th width="5%">رقم الطبعة</th>
        <th @if(request('type') == 2) width="12%" @else width="15%" @endif>التاريخ</th>
        <th width="8%">الكمية</th>
        <th @if(request('type') == 2) width="10%" @else width="15%" @endif>السعر</th>
        <th @if(request('type') == 2) width="20%" @else width="22%" @endif>السعر الاجمالي</th>

        </tr>
        @php
        $n=0;
        @endphp
        @foreach($items as $item)
        @php
         $n+=$item->total_price;
        @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                @if(request('type') == 0 || request('type') == 2)
                    <td>{{$item->product ? $item->product->name :$item->product_id}}</td>
                @endif
                @if(request('type') == 1)
                    <td>{{$item->product_id}}</td>
                @endif
                @if(request('type') == 2)
                    <td>{{ $item->client_name }}</td>
                @endif
                <td>{{$item->copy_no}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->count}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->total_price}}</td>

            </tr>
        @endforeach
        <tr>
            <td @if(request('type') == 2) colspan="5" @else colspan="4" @endif style="background-color:lightgray;font-weight:bold">المجموع</td>
            <td>{{$items->pluck('count')->sum()}} </td>
            <td></td>
            <td>{{$n}} </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
