<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="float-right">
            <div class="form-group">
                <select id="changelang" class="form-control">
                    <option value="{{route('index','en')}}" {{App::isLocale('en') ? 'selected':''}}>en</option>
                    <option value="{{route('index','fr')}}" {{App::isLocale('fr') ? 'selected':''}}>fr</option>
                </select>

            </div>
        </div>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{trans('words.welcome')}}
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">{{trans('words.Documentation')}}</a>
                    <a href="https://laracasts.com">{{trans('words.Laracasts')}}</a>
                    <a href="https://laravel-news.com">{{trans('words.News')}}</a>
                    <a href="https://github.com/laravel/laravel">{{trans('words.GitHub')}}</a>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $('#changelang').on('change',function () {
      location.href = $(this).val();
    })
</script>
</html>
