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
        <h2><b>{{$event->name}} Report</b></h2>
        <table class="table-responsive-md table-div" style="margin-top: 40px">
            <tr>
                <td height="20" width="100">Event Name</td>
                <td>{{$event->name}}</td>
            </tr>
            <tr>
                <td height="20">Info</td>
                <td>{{$event->description}}</td>
            </tr>
            <tr>
                <td height="20">Venue</td>
                <td>{{$event->venue}}</td>
            </tr>
            <tr>
                <td height="20">Date/Time</td>
                <td>{{$event->date}}/{{$event->time}}</td>
            </tr>
            <tr>
                <td height="20">Fee</td>
                <td>&#8364 {{$event->fee}}.00</td>
            </tr>
        </table>
        <table width="100%" style="margin-top: 50px;border-collapse:collapse;border:1px solid #00F;" border="1">
            <tr>
                <th height="40" style="text-align: left;padding-left: 5px">Client ID</th>
                <th style="text-align: left;padding-left: 5px">Client Name</th>
                <th style="text-align: center">Confirmation</th>
                <th style="text-align: center">Payments</th>
            </tr>
            @foreach($clients as $client)
                <tr>
                    <td height="30" style="text-align: left;padding-left: 5px">{{$client->client_id}}</td>
                    <td style="text-align: left;padding-left: 5px">{{\App\Client::findOrFail($client->client_id)->first_name}} {{\App\Client::findOrFail($client->client_id)->last_name}}</td>
                    <td style="text-align: center">
                        @if($client->confirmation)
                            <span style="color: #00b44e"> Accepted</span>
                        @else
                            <span style="color: #c51f1a"> Pending</span>
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if($client->confirmation)
                            @if($client->payment)
                                <span style="color: #00b44e"> Payed</span>
                            @else
                                <span style="color: #c51f1a"> Pending</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="footer">
        <p>Powered by Sussex Agency</p>
    </div>
</body>

</html>
