<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Exam</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">

        <!-- CSS only -->
        <link href="./css/bootstrap.css" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            /* width */
            ::-webkit-scrollbar {
                width: 5px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                /* box-shadow: inset 0 0 5px grey;  */
                border-radius: 10px;
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #ddd; 
                border-radius: 5px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: transparent; 
            }
        </style>
    </head>
    <body style="overflow-y: hidden;">
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="./js/app.js"></script>
    </body>
</html>
