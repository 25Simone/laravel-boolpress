<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Nuovo messaggio inviato dal form contatti</h3>

    <ul>
        <li><strong>User name: </strong>{{ $newContactInfo->name }}</li>
        <li><strong>User email: </strong>{{ $newContactInfo->email }}</li>
        <li><strong>Message: </strong>{{ $newContactInfo->message }}</li>
        @if($newContactInfo->attachment)
            <li><strong>Attachment: </strong><a href="{{ asset('storage/' . $newContactInfo->attachment) }}">Attachment</a></li>
        @endif
    </ul>
</body>
</html>