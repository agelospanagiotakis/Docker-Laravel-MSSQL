<!DOCTYPE html>
<html data-theme="cupcake">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<head>
    <title>Roles</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Optional, for styling -->
</head>
<body>
    <div class="container">
        <h1>Roles</h1>
        {{-- <pre>{{ print_r($roles, true) }}</pre> <!-- Debugging output --> --}}

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Role Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>
        {{-- <pre>{{ dd($role, true) }}</pre> <!-- Debugging output --> --}}
                            {{ $role->ID }}</td>
                        <td>{{ $role->RoleName }}</td>
                        <td>{{ $role->Description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
