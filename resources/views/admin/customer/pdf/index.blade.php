
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
            <th width="25%"> اسم المكتبة</th>
        <th width="25%">الاسم كامل</th>
        <th width="15%">الهاتف</th>
        <th width="30%">العنوان</th>


        </tr>
        @php
        $n=0;
        @endphp
        @foreach($items as $item)
        @php
        @endphp
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->full_name}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->address}}</td>


            </tr>
        @endforeach
        </tbody>
    </table>

    </body>

</html>
