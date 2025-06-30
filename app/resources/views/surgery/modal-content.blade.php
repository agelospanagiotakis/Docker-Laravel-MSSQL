<!DOCTYPE html>
<html>
<head>
    <title>Preview</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="p-4 bg-white">
    <div class="space-y-2">
        @include('surgery.show', ['surgery' => $surgery])
    </div>
</body>
</html>