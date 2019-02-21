<!doctype html>

<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href='{{asset("/css/app.css")}}'>
        <title>{{config('app()->getName()','blog')}}</title>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <h2>{{$arr['ball']}}</h2>
        <ul>
            <?php 
                foreach ($arr['tot'] as $tott)
               echo "<li>$tott</li>";
            ?>
        </ul>
    </body>     
</html>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "hello";
?>


