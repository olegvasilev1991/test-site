<html>
<head>
    <title>test-site</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
<div id="app">
    <index :data="{{json_encode($data)}}" :total="{{json_encode($total)}}"></index>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
