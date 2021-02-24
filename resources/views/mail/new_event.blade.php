<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device width, initial scale=1.0">
    <meta http-equiv="Xxxxxxx-UA-Compatible" content="ie-edge">
    <title>Title</title>
</head>
<body>

    <h3>{{$subject}}</h3>

<p>You have new event invitation</p>
<table>
    <tr>
        <td width="100px">Event Name</td>
        <td>{{$event->name}}</td>
    </tr>
    <tr>
        <td>Venue</td>
        <td>{{$event->venue}}</td>
    </tr>
    <tr>
        <td>Date/Time</td>
        <td>{{$event->date}}/{{$event->time}}</td>
    </tr>
    <tr>
        <td>Fee</td>
        <td>&#8364;{{$event->fee}}.00</td>
    </tr>
</table>
     Sussex Agency (Pvt) Ltd London.
</body>
</html>
