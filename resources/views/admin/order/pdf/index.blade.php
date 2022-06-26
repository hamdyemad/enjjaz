
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
        <td style="width:100%;">
            <table  class="first-table" style="text-align:center; border-spacing: 5px; border-collapse: separate; font-size: 12px;">
                @if(in_array('0',request('table')) )
                    <tr>


                        <td style="background-color:#e1ddd1; font-weight: bold;width: 11%; height: 16px; line-height: 16px; border: 1px solid #000">اسم المكتبة</td>
                        <td style="background-color:#f1eee7; font-weight: bold;width: 30% background-color: var(--blue); border: 1px solid #8f8771"> {{$item->customer->name}}</td>

                        <td style="background-color:#e1ddd1; font-weight: bold;width: 7%; height: 20px; line-height: 20px; border: 1px solid #000;">العنوان</td>
                        <td style="background-color:#f1eee7; font-weight: bold;width:22%; border: 1px solid #8f8771"> {{$item->customer->address}}</td>

                        <td style="background-color:#e1ddd1; font-weight: bold;width: 7%; height: 20px; line-height: 20px; border: 1px solid #000;">المالك</td>
                        <td style="background-color:#f1eee7; font-weight: bold;width:23%; border: 1px solid #8f8771"> {{$item->customer->full_name}}</td>
                    </tr>

                    <tr>
                        <td style="background-color:#c1e0d0; font-weight:bold;width: 7%;height: 18px; line-height: 18px; border: 1px solid #8b9d67">الهاتف</td>
                        <td class="td_number" style="background-color: #dfece5; font-weight:bold;width: 20%; border: 1px solid #9fb6aa">{{$item->customer->phone}}</td>
                        <td style="background-color:#c1e0d0; font-weight:bold;width: 10%; border: 1px solid #8b9d67">رقم الطلب</td>
                        <td class="td_number" style="background-color: #dfece5; font-weight:bold;width: 10%;border: 1px solid #9fb6aa">{{$item->id}}</td>
                        <td style="background-color:#c1e0d0; font-weight:bold;width: 12%; border: 1px solid #8b9d67">عدد الكتب</td>
                        <td class="td_number" style="background-color: #dfece5; font-weight:bold;width: 10%;border: 1px solid #9fb6aa">{{ $item->productsCount() }}</td>
                        <td style="background-color:#c1e0d0; font-weight:bold;width: 18%; border: 1px solid #8b9d67">عدد الكتب المباعة</td>
                        <td class="td_number" style="background-color: #dfece5; font-weight:bold;width: 11%;border: 1px solid #9fb6aa">{{ $item->solds->pluck('count')->sum() }}</td>
                    </tr>
                @endif
                @if(in_array('1',request('table')) )

                    <tr>
                        <td style="background-color:#d5d2dd; font-weight: bold; width: 13%; border: 1px solid #9a8d98; height: 18px">المبلغ الاجمالي</td>
                        <td class="td_number" style="background-color:#eeebf6;border: 1px solid #9a96a5; font-weight: bold;width: 12%"> {{number_format($item->total_price(), 1)}}</td>

                        <td style="background-color:#d5d2dd; font-weight: bold;width: 10%; border: 1px solid #9a8d98">قيمة المباع</td>
                        <td class="td_number" style="background-color:#eeebf6; border: 1px solid #9a96a5; font-weight: bold;width: 12%"> {{number_format($item->total_price_solds(), 1)}}</td>

                        <td style="background-color:#d5d2dd; font-weight: bold;width: 13%; border: 1px solid #9a8d98">المبلغ المدفوع</td>
                        <td class="td_number" style="background-color:#eeebf6; border: 1px solid #9a96a5; font-weight: bold;width: 10%">{{number_format($item->total_payment(), 1)}}</td>

                        <td style="background-color:#d5d2dd; font-weight: bold;width: 17%; border: 1px solid #9a8d98">المتبقي من المباع</td>
                        @php
                        $remainingOfSolds = number_format($item->total_price_solds() -$item->total_price_recieve()-$item->total_payment(), 1);
                        @endphp
                        <td class="td_number" style="background-color:#eeebf6; border: 1px solid #9a96a5; font-weight: bold;width: 11%">
                            @if($remainingOfSolds > 0)
                                {{ $remainingOfSolds }}
                            @else
                                0
                            @endif
                        </td>
                    </tr>
                @endif

                    <tr>
                        <td style="background-color:#f5cec9; font-weight: bold;width: 18%; border: 1px solid #c19e9c">قيمة المرحل</td>
                        <td class="td_number" style="background-color:#eadcd9; border: 1px solid #887c7b; font-weight: bold;width: 8%"> {{ $allProductsRemaininPrice }}</td>
                        <td style="background-color:#f5cec9; font-weight:bold;width: 13%; border: 1px solid #c19e9c">تاريخ الطلب</td>
                        <td class="td_number" style="background-color: #eadcd9; font-weight:bold;width: 14%;border: 1px solid #887c7b">{{$item->created_at->format('Y-m-d')}}</td>
                        <td style="background-color:#f5cec9;width: 10%; height: 20px; line-height: 20px; font-weight: bold; border: 1px solid #c19e9c">الملاحظات</td>
                        <td style="width: 37%; background-color: #eadcd9;border:1px solid #887c7b"> {{$item->notes}}</td>
                    </tr>
            </table>
        </td>
    </tr>
    <br>

    <tr>
        <td style="width:40%;">
            @if(in_array('2',request('table')) )

                <table class="first-table" style="text-align:center; border-color:black; border-collapse: separate;">
                    <tr style="background-color:#c1e8d5;font-weight:bold">
                        <td style="width:100%; font-size: 12px">
                            المدفوعات
                        </td>

                    </tr>
                </table>

                        <table class="first-table" style="text-align:center; border-spacing: 5px; border-collapse: separate; font-size: 11px;">
                            <tr style="background-color:#e9e7c0;font-weight:bold;  font-size: 9.5px;">
                                <td width="15%">تسلسل</td>
                                <td width="27%">المبلغ المدفوع</td>
                                <td width="31%">التاريخ</td>
                                <td width="28%">المبلغ المتبقي</td>
                            </tr>
                            @php
                                $tt=0;
                            @endphp
                            @if($item->payments()->count() > 0)

                                @foreach($item->payments()->get() as $payment)
                                    <tr>
                                        <td width="15%">{{$loop->iteration}}</td>
                                        <td width="27%">{{$payment->price}}</td>
                                        <td width="31%">{{$payment->created_at->toDateString()}}</td>
                                        @php
                                            $remainingSold =  $item->total_price_solds() - $item->total_price_recieve() - ($tt+=$payment->price);
                                        @endphp

                                        <td width="28%">
                                            @if($remainingSold > 0)
                                                {{$remainingSold}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                            @else
                                <tr>
                                    <td width="15%">#</td>
                                    <td width="25%">0</td>
                                    <td width="35%">--</td>
                                    <td width="25%">0</td>
                                </tr>

                            @endif

                        </table>


            @endif
            <br>
            <br>
                @if(in_array('4',request('table')) )

                    <table border="1" style="text-align:center; border-color:black; font-size: 11px" >
                        <tr style="background-color:lightgray;font-weight:bold">
                            <td colspan="5" style="width:100%">
                                الكتب المباعة
                            </td>

                        </tr>
                        <tr style="background-color:lightgray;font-weight:bold">
                            <td style="width:6%">#</td>
                            <td style="width:40%">الكتاب</td>
                            <td style="width:18%">الكمية</td>
                            <td style="width:18%">السعر</td>
                            <td style="width:18%">الاجمالي</td>
                        </tr>
                        @if($item->solds()->count() > 0)
                            @foreach($item->solds()->get() as $recieve)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$recieve->product->name??' '}}</td>
                                    <td>{{$recieve->count}}</td>
                                    <td>{{$recieve->price}}</td>
                                    <td>{{$recieve->price_total}}</td>
                                </tr>

                            @endforeach
                        @else
                            <tr>
                                <td>#</td>
                                <td>--</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        @endif

                    </table>
                @endif


        </td>
        <td style="width:2%"></td>
        <td style="width:58%">
            @if(in_array('3',request('table')) )

                <table border="1" style="text-align:center; border-color:black;font-size: 13px;" >
                    <tr style="background-color:rgb(204, 238, 226);font-weight:bold">
                        <td colspan="5" style="width:99%; height: 30px;">
                            الكتب المطلوبة
                        </td>

                    </tr>
                    <tr style="background-color:lightgray;font-weight:bold">
                        <td style="background-color:lightgray;width:6%">#</td>
                        <td style="width:42%; background-color: #dde1bc;">الكتاب</td>
                        <td style="background-color:#e9dced;width:11%">الكمية</td>
                        <td style="background-color:#e9dced;width:12%">المتبقى</td>
                        <td style="background-color:#e4d2c6;width:10%">السعر</td>
                        <td style="background-color:#d2e7d4;width:18%">السعر الكلي</td>
                    </tr>

                    @foreach($item->products()->get() as $product)

                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$product->product->name??' '}}</td>
                            <td>{{$product->count}}</td>
                            <td>{{ $product->remaining_count() }}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->price_total}}</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td colspan="2">المجموع</td>
                        <td>{{ $item->products->pluck('count')->sum() }}</td>
                        <td>{{ $allProductsRemaininCount }}</td>
                        <td>{{ $item->products->pluck('price')->sum() }}</td>
                        <td>{{ $item->products->pluck('price_total')->sum() }}</td>
                    </tr>

                </table>
            @endif

        </td>
    </tr>
</table>

</body>

</html>
