<!DOCTYPE html>
<html>
    <head>
        <title>Down for Maintenance</title>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>  
        <div class="container">
            <div id="content">
                <div class="title">Livesshattack.net Status <span class="status-indicator active "></span></div>
                <p class="status-update-square">{{ date('M d Y', strtotime(date('Y-m-d'))) }} - Down for maintenance</p>
            </div>
        </div>
    </body>
</html>