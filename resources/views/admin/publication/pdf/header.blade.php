<table id="headerStyle" width="100%" style=" font-size: 14px;">
    <tr style="margin: 2em">
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:40%">قسم:
            @if(request('type') == 0)
                مطبوعاتنا عن الكتب
            @endif
            @if(request('type') == 1)
                المطبوعات الأخرى
            @endif
            @if(request('type') == 2)
                مطبوعات العملاء
            @endif
            @if(request('type') == 3)
                المطبوعات الكلية
            @endif
        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:30%">
        <img src="{{url('/')}}/front/images/logo/123.png" alt="" width="40" />

        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:35%"> فريق انجاز للكتب التعليمية</td>
    </tr>

</table>
