
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
    <table  border="1" style="text-align:center; border-color:black;">
        <tr style="background-color:lightgray;font-weight:bold">
        <th width="5%">#</th>
        @if ($type != null)
            @if($type == '0')
                <th width="35%"> الموظف</th>
            @elseif($type == '1')
                <th width="25%"> المصمم</th>
            @endif
        @endif
        @if($items[0]->type == 0)
            <th width="35%">اسم المصروف</th>
        @elseif($items[0]->type == 1)
            <th width="45%">اسم المصمم</th>
        @endif
        @if($items[0]->type == 2 || $items[0]->type == 3)
            <th width="65%">اسم المصروف</th>
        @endif
        @if($items[0]->type == 2 || $items[0]->type == 3)
        <th width="15%">الميزانية</th>
        @else
        <th width="10%">الميزانية</th>
        @endif
        <th width="15%">التاريخ</th>


        </tr>
        @php
        $n=0;
        @endphp
        @foreach($items as $item)
        @php
         $n+=$item->price;
        @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                @if($items[0]->type == 0)
                    <td> {{$item->employee->name}}</td>
                @elseif($items[0]->type == 1)
                    <td> {{$item->employee->name}}</td>
                @endif
                <td>{{$item->title}}</td>
                <td>{{$item->price}}</td>
                <td>{{$item->date}}</td>


            </tr>
        @endforeach
        <tr>
            @if($items[0]->type == 2 || $items[0]->type == 3)
                <td colspan="2" style="background-color:lightgray;font-weight:bold">المجموع</td>
            @else
            <td colspan="3" style="background-color:lightgray;font-weight:bold">المجموع</td>
            @endif
            <td colspan="2">{{$n}} </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
