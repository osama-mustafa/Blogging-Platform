<!DOCTYPE html>
<html>
<head>
    <title>You Have a New Message!</title>
</head>
<body>
    <h2>Message Details</h2>
        <ul>
            <li><h3>Title: {{ $data['title'] }}</h3></li>
            <li><h3>Name: {{ $data['name'] }}</h3></li>
            <li><h3>From: {{ $data['email'] }}</h3></li>
        </ul>
    <p>{{ $data['message'] }}</p>

   
    <p>Thank you!</p>
    <p>{{ $data['name'] }}</p>
</body>
</html>