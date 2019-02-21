<!doctype html>
@include('layouts.app')
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
            @include('messages')
        <h1>Create A post</h1>
        
            {!! Form::open(['action' => 'PostController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title','Title')}}
                {{Form::text('title','',['class'=>'form-control','placeholder'=>'title'])}}    
            </div>
            <div class="form-group">
                {{Form::label('body','Body')}}
                {{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body text'])}}
            </div>
            <div class="form-group">
                {{Form::label('Image:')}}
                {{Form::file('cover_image',['class'=>'btn btn-light'])}}
            </div>
                {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
            {!! Form::close() !!}
           
       </div>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
    </body>     
</html>
