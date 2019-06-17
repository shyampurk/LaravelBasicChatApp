<!DOCTYPE html>
<html>
    <head>
        <!-- Responsive Meta Tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">	
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Materialize CSS and Google Icon Font -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <title>Official Chat App</title>
    </head>
    <body>
        <div id = "app">
            <App />
        </div>
        
        <script src = "js/app.js"></script>
    </body>
</html>