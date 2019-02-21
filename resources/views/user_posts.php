@extends('layouts.app')

@section('content')
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href='{{asset("/css/app.css")}}'>
        <title>{{config('app()->getName()','blog')}}</title>
    </head>
    <body>        
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><b>MY Posts</b></div>

                <div class="card-body">
            @include('messages')
            <?php 
                foreach ($posts as $post){
                    $name=$post->user['name'];
             echo"<div class='well'>  
               <h3><a href='/posts/$post->id'>$post->title</a></h3>
                 <small>Written on $post->created_at <b>BY</b> $name</small>
             </div>";
                }
                       //<!--{{$posts->links()}}--> <!--pagination from index()-->
             ?>
               </div>
            </div>
            <a href="/posts/create" class="btn btn-primary">Create a new post</a>
        </div>
    </div>
</div>
     
    </body>     
</html>

@endsection

