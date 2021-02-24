<!doctype html>
<html>
<head>
    <style type="text/css" >
        h2{
            text-align: center;
            margin-top: 30px;
            font-family: Serif;
        }
        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }

    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body  class="hold-transition sidebar-mini">
    <div class="container" >
        <center><h3><b>Quarterly Event Payment Summery from {{$last_date}} to {{date('Y-m-d')}}</b></h3></center>
        <table width="100%" style="margin-top: 50px;border-collapse:collapse;border:1px solid #00F;" border="1">
            <tr>
                <th height="30" style="text-align: left;padding-left: 5px">#ID</th>
                <th style="text-align: left;padding-left: 5px">Event Name</th>
                <th style="text-align: center">Venue</th>
                <th style="text-align: center">Pending Payments</th>
                <th style="text-align: center">Income</th>
            </tr>
            <?php
                $pending = 0;
                $income = 0;
            ?>
            @foreach($events as $event)
                <tr>
                    <td height="30" style="text-align: left;padding-left: 5px">{{$event->id}}</td>
                    <td style="text-align: left;padding-left: 5px">{{$event->name}}</td>
                    <td style="text-align: center">{{$event->venue}}</td>
                    <?php
                        $confirmed_count = \App\ClientEvent::where('event_id','=',$event->id)->where('confirmation','=',true)->count();
                        $payed_count = \App\ClientEvent::where('event_id','=',$event->id)->where('payment','=',true)->count();
                        $income += $event->fee*$payed_count;
                        $pending += $event->fee*($confirmed_count-$payed_count);
                    ?>
                    <td style="text-align: right;padding-right: 5px">&#8364 {{number_format($event->fee*($confirmed_count-$payed_count),2)}}</td>
                    <td style="text-align: right;padding-right: 5px">&#8364 {{number_format($event->fee*$payed_count,2)}}</td>
                </tr>
            @endforeach
            <tr>
                <th height="30" style="text-align: left;padding-left: 5px" colspan="3">Total</th>
                <th style="text-align: right;padding-right: 5px">&#8364 {{number_format($pending,2)}}</th>
                <th style="text-align: right;padding-right: 5px">&#8364 {{number_format($income,2)}}</th>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Powered by Sussex Agency</p>
    </div>
</body>

</html>
