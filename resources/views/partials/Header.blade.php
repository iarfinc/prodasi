<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Project Data Sains</title>
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4824/4824797.png" type="image/x-icon">

            
    <link rel="stylesheet" href="{{ asset('/') }}assets/extensions/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/compiled/css/iconly.css">

    <link rel="stylesheet" href="{{ asset('/') }}assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}assets/compiled/css/table-datatable-jquery.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('content-css')
</head>

<body>
    <script src="{{ asset('/') }}assets/static/js/initTheme.js"></script>