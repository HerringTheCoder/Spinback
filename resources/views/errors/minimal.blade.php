<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon-32.png') }}" />
    <style>
        html, body {
            height: 100%;
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            background: #f0f0f0;
        }
        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image {
            background: url( {{ asset('images/spinback-error.png') }} );
            background-size: cover;
            width: 230px;
            height: 225px;
        }
        .text {
            width: auto;
            margin-left: 50px;
            font-weight: bold;
            font-size: 2em;
        }
        .text .code {
            display: inline-block;
            padding: 0px 10px;
            background: black;
            color: white;
            margin: 10px;
            transform: skew(-12deg);
            font-size: 2em;
        }
        .text .message {
            display: inline-block;
            font-style: italic;
        }
        .text hr {
            border: 1px solid lightgray;
        }
        .text .info {
            font-size: 14px;
        }

        @media (max-width: 800px) {
            .image {
                width: 130px;
                height: 128px;
            }

            .text {
                font-size: 1.2em;
                margin-left: 30px;
            }
        }

        @media (max-width: 450px) {
            .container {
                flex-direction: column;
            }

            .text {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image"></div>
        <div class="text">
            <div class="code">@yield('code')</div>
            <div class="message">@yield('message')</div>
            <hr>
        </div>
    </div>
</body>
</html>