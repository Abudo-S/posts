<!doctype html>
<style>

.tooltiptext {
    display:none;
    width: 200px;
    color:red;
    background-color: red;
    color: black;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}
.x{
    margin-left: 550px;
    display: inline;
    color:red;
}
.x:hover span{
    display:inline;
    opacity: .7;
}
</style>
@include('layouts/app')
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
                <a href="/posts" class="btn btn-default" >Go Back</a>
                @if($post->visible==0)
                <div class="card-header"> <b>{{$post->title}}</b>
                    <p class="x" title="This post isn't public anymore">NP
                      <span class="tooltiptext">This post isn't public anymore</span>
                    </p> 
                </div>
                @else
                 <div class="card-header"> <b>{{$post->title}} </b></div>
                @endif
                
                <div class="card-body">
            <div class="well">  
               <p>{!!$post->body!!}</p>
               <small>Written on {{$post->created_at}} <b>BY</b> {{$post->user['name']}}</small>
             </div>
                   
                        {!! Form::open(['action' => ['PostController@change_visibilty',$post->id],'method'=>'GET']) !!}
                         {{Form::hidden('_method','CHANGE')}}
                           @if(Auth::user()->id==0&&$post->visible==1)
                            {{Form::submit('Set as unvisible',['class'=>'btn btn-dark'])}}
                             @elseif(Auth::user()->id==0)
                              {{Form::submit('Set as visible',['class'=>'btn btn-dark'])}}
                            @endif
                     {!! Form::close() !!}
             @if(Auth::user()->id==$post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a>
                    <br><pre></pre>
               {!! Form::open(['action' => ['PostController@destroy',$post->id],'method'=>'POST']) !!}
                {{Form::hidden('_method','DELETE')}}
                   {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
            {!! Form::close() !!}
              @endif
              <i>Number Of Votes:<b> {{$post->n_votes}}</b></i>
         @if($post->user['id']!= Auth::user()->id&&strpos($post->who_voted,'-'.Auth::user()->id)===false)
                 <a class='btn btn-primary' href='/posts/$post->id/vote' style='float: right;'>VOTE</a>
             @elseif($post->user['id']== Auth::user()->id)
                 <button  class='btn btn-primary'  style='float: right;' disabled>VOTE</button>
               @else
                 <button  class='btn btn-primary'  style='float: right;' disabled>VOTED</button>
             @endif
                 </div>
        <br>
        <img style='width:100%' src='/storage/cover_images/{{$post->cover_image}}'>
        <br>
            </div>
        </div>
    </div>
</div>
    </body>     
</html>

