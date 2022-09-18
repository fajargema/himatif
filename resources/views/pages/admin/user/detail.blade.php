<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>ID Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('adm/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('adm/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('adm/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('adm/img/favicon/site.webmanifest') }}">

    <style type="text/css">
        body {
            margin-top: 20px;
            background: #f3f3f3;
        }

        .card.user-card {
            border-top: none;
            -webkit-box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
            box-shadow: 0 0 1px 2px rgba(0, 0, 0, 0.05), 0 -2px 1px -2px rgba(0, 0, 0, 0.04), 0 0 0 -1px rgba(0, 0, 0, 0.05);
            -webkit-transition: all 150ms linear;
            transition: all 150ms linear;
        }

        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-header {
            background-color: transparent;
            border-bottom: none;
            padding: 25px;
        }

        .card .card-header h5 {
            margin-bottom: 0;
            color: #222;
            font-size: 14px;
            font-weight: 600;
            display: inline-block;
            margin-right: 10px;
            line-height: 1.4;
        }

        .card .card-header+.card-block,
        .card .card-header+.card-block-big {
            padding-top: 0;
        }

        .user-card .card-block {
            text-align: center;
        }

        .card .card-block {
            padding: 25px;
        }

        .user-card .card-block .user-image {
            position: relative;
            margin: 0 auto;
            display: inline-block;
            padding: 5px;
            width: 200px;
            height: 200px;
        }

        .user-card .card-block .user-image img {
            z-index: 20;
            position: absolute;
            top: 5px;
            left: 5px;
            width: 190px;
            height: 190px;
        }

        .img-radius {
            border-radius: 50%;
        }

        .f-w-600 {
            font-weight: 600;
        }

        .m-b-10 {
            margin-bottom: 10px;
        }

        .m-t-25 {
            margin-top: 25px;
        }

        .m-t-15 {
            margin-top: 15px;
        }

        .card .card-block p {
            line-height: 1.4;
        }

        .text-muted {
            color: #919aa3 !important;
        }

        .user-card .card-block .activity-leval li.active {
            background-color: #2ed8b6;
        }

        .user-card .card-block .activity-leval li {
            display: inline-block;
            width: 15%;
            height: 4px;
            margin: 0 3px;
            background-color: #ccc;
        }

        .user-card .card-block .counter-block {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #0052a4, #167fe7);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-pink {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .m-t-10 {
            margin-top: 10px;
        }

        .p-20 {
            padding: 20px;
        }

        .user-card .card-block .user-social-link i {
            font-size: 30px;
        }

        .text-facebook {
            color: #3B5997;
        }

        .text-twitter {
            color: #42C0FB;
        }

        .text-dribbble {
            color: #EC4A89;
        }

        .user-card .card-block .user-image:before {
            bottom: 0;
            border-bottom-left-radius: 50px;
            border-bottom-right-radius: 50px;
        }

        .user-card .card-block .user-image:after,
        .user-card .card-block .user-image:before {
            content: "";
            width: 100%;
            height: 48%;
            border: 2px solid #4099ff;
            position: absolute;
            left: 0;
            z-index: 10;
        }

        .user-card .card-block .user-image:after {
            top: 0;
            border-top-left-radius: 50px;
            border-top-right-radius: 50px;
        }

        .user-card .card-block .user-image:after,
        .user-card .card-block .user-image:before {
            content: "";
            width: 100%;
            height: 48%;
            border: 2px solid #4099ff;
            position: absolute;
            left: 0;
            z-index: 10;
        }
    </style>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>

</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <h2 class="text-center">ID Card HIMATIF</h2>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="card user-card">
                    <div class="card-header">
                        <img align="left" src="{{ asset('adm/img/hima.png') }}" width="20%">
                        <img align="right" class="mt-3" src="{{ asset('adm/img/ucic.png') }}" width="28%">
                    </div>
                    <div class="card-block">
                        <div class="user-image">
                            <img src="{{ asset('adm/img/pro.jpg') }}" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600 m-t-25 m-b-10">Fajar Gema Ramadhan</h6>
                        <p class="text-muted">Teknik Informatika</p>
                        <ul class="list-unstyled activity-leval">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                        </ul>
                        <div class="bg-c-blue counter-block m-t-10 p-20">
                            <div class="text-center">
                                <h2>himatif.cic.ac.id</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card user-card">
                    <div class="card-header">
                        <img align="left" src="{{ asset('adm/img/hima.png') }}" width="20%">
                        <img align="right" class="mt-3" src="{{ asset('adm/img/ucic.png') }}" width="28%">
                    </div>
                    <div class="card-block">
                        <div class="user-image">
                            <a href="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->nim}}&choe=UTF-8"
                                download="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->nim}}&choe=UTF-8">
                                <img src="https://chart.googleapis.com/chart?cht=qr&chs=400x400&chl={{$data->nim}}&choe=UTF-8"
                                    alt="">
                            </a>
                        </div>

                        <h6 class="f-w-600 m-t-25 m-b-10">20200120037</h6>
                        <p class="text-muted">fajar.ramadhan.ti.20@cic.ac.id</p>
                        <ul class="list-unstyled activity-leval">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                        </ul>
                        <div class="bg-c-blue counter-block m-t-10 p-20">
                            <div class="text-center">
                                <h2>himatif.cic.ac.id</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</body>

</html>
