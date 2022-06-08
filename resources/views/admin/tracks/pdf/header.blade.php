<table id="headerStyle" width="100%" style=" font-size: 14px;">
    <tr style="margin: 2em">
        @if(request('type') == 0)
            <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:50%">قسم: متابعة شركات التوصيل</td>
        @elseif(request('type') == 1)
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:50%">قسم: متابعة دفعات التوصيل</td>
        @endif
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:25%">
        <img src="{{url('/')}}/front/images/logo/123.png" alt="" width="40" />

        </td>
        <td style="border-bottom: 2px solid #3c763d;color: #3c763d; width:35%"> فريق انجاز للكتب التعليمية</td>
    </tr>
</table>
