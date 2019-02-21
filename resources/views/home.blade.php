@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('messages')
                      <?php 
                        if(count($posts)>0){
                        foreach ($posts as $post){
                                $name=$post->user['name'];
                           echo"<div class='card-body'>  
                           <h3><img style='width:20%' src='/storage/cover_images/$post->cover_image'><a href='/posts/$post->id'>$post->title</a></h3>
                             <small>Written on $post->created_at <b>BY</b> $name</small>
                         </div>";
                            }
                        }else{
                            echo"You don't have any post till NOW";
                        }
                                   //<!--{{$posts->links()}}--> <!--pagination from index()-->
                         ?>
                   <br><pre></pre>
            </div>
             <a href="/posts/create" class="btn btn-primary">Create a new post</a>
        </div>
    </div>  
</div>
@endsection
 <!-- 
 header('Refresh: 5; URL=http://app.com/posts');!!}-->
