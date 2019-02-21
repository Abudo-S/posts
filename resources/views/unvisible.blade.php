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
                <div class="card-header" ><b>Posts</b></div>

                
            @include('messages')
            <?php 
            $b=true;
               if(count($posts)!=0){
                foreach ($posts as $post){
                    $name=$post->user['name'];
             echo"<div class='card-body'>  
               <h3><img style='width:20%' src='/storage/cover_images/$post->cover_image'><a href='/posts/$post->id/'>$post->title</a></h3>
                 <small>Written on $post->created_at <b>BY</b> $name</small>
                  <br><i>Number Of Votes:<b> $post->n_votes</b></i>";
                if($post->user['id']!= Auth::user()->id&&strpos($post->who_voted,'-'.Auth::user()->id)===false){
                      echo "<a class='btn btn-primary' href='/posts/$post->id/vote' style='margin-left: 600px'>VOTE</a>";
                  }else if($post->user['id']== Auth::user()->id){
                      echo "<button class='btn btn-primary'  style='margin-left: 600px' disabled>VOTE</button>"; 
                  }else{
                      echo "<button class='btn btn-primary'  style='margin-left: 600px' disabled>VOTED</button>";
                  }
                  echo "</div>";
                     }
               }else{
                     echo"All posts are public";
               }
                       //<!--{{$posts->links()}}--> <!--pagination from index()-->
             ?>
               <br><pre></pre>
            </div>
           
        </div>
    </div>
</div>
     
    </body>     
</html>

@endsection

