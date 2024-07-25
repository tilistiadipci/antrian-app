<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Setup</title>
</head>
<body>
    <form action="{{ route('setup') }}" method="post">
        {{ csrf_field() }}
        UUID : {{ $uuid ?? '' }} <br>
        <label for="license_key">Masukkan License Key</label>
        <input type="text" name="license_key">
        <button type="submit">Submit</button>
    </form>
</body>
</html>