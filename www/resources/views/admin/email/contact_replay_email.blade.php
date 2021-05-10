<!DOCTYPE html>
<html lang="en">
<head>
    <title>v-consult</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f5;
            position: relative;
        }

        .content {
            padding: 10px 15px;
        }

        .content span {
            margin: 0 0 15px;
            width: 100%;
            display: block;
        }


        .question_block {
            margin: 0 0 15px;
            display: block;
            background: #fff;
            padding: 10px 10px 0;
            line-height: 8px;
        }

        .question_block span {
            line-height: 18px;
            margin: 0 0 10px;
        }

    </style>
</head>
<body>
<div style="margin: 10%;">
    <section class="content">
        <h2>Dear  {{$contact_data->name}}</h2>
        <div class="question_block">
            {{$contact_data->replay}}
        </div>

    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
