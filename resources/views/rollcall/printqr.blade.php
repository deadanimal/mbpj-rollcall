<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR CODE</title>
    <style>
        .container {
            font-family: arial;
            font-size: 24px;
            margin: auto;
        }

        img {
            /* Center horizontally*/
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="data:image/png;base64,{!! $qrcode !!}" style="width:100%;">
    </div>
</body>

</html>
