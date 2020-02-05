<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * {
            line-height: 1.2;
            margin: 0;
        }
        html {
            color: #888;
            display: table;
            font-family: sans-serif;
            height: 100%;
            text-align: center;
            width: 100%;
        }
        body {
            display: table-cell;
            vertical-align: middle;
            margin: 2em auto;
        }
        h1 {
            color: #555;
            font-size: 2em;
            font-weight: 400;
        }
        p {
            margin: 0 auto;
            width: 100%;
        }
        @media only screen and (max-width: 280px) {
            body, p {
                width: 100%;
            }
            h1 {
                font-size: 1.5em;
                margin: 0 0 0.3em;
            }
        }
    </style>
</head>
<body>
    <h1>Oops! <?php echo $heading; ?></h1>
    <p><?php echo $message; ?>.</p>
</body>
</html>