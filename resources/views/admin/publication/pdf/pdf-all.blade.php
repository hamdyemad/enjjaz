
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
            <th width="50%">أسم المطبوع</th>
            <th width="50%">الميزانية</th>
        </tr>
        @foreach($publicationExpenses as $exp)
        <tr>
            <td width="50%">{{ $exp['expenseOwner'] }}</td>
            <td width="50%">{{ $exp['expense'] }}</td>
        </tr>
        @endforeach
        <tr>
            <td  width="50%"style="background-color:lightgray;font-weight:bold">المجموع</td>
            <td width="50%">{{$counted}} </td>
        </tr>
        </tbody>
    </table>

    </body>

</html>
