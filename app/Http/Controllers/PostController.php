<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         //  $this->middleware('auth',['except'=>['index','show']]);
     }
    
    public function index()
    {
        //
       //$posts= Post::all();
        $posts= Post::orderBy('title','desc')->get();
        // $posts= Post::orderBy('title','desc')->take(1)->get();
         //$posts= Post::orderBy('title','desc')->paginate(1); //NOTE: should add {{$posts->links()}} in our VIEW page to activate the pagination
        //return Post::where('title','Post two')->get();
        //$posts= DB::select('select * from Posts');//not preferred
        return view('index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
       $fileNtoStore= $this->get_FN($request);
        $post=new post();
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->user_id= auth()->user()->id;
        $post->n_votes=0;
        $post->who_voted='';
        $post->cover_image=$fileNtoStore;
        $post->save();
        return redirect('/posts')->with("success","Post is created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post=Post::find($id);
        return view('show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);
        if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error', "Authorization error");
        }
        return view('edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
         $fileNtoStore= $this->get_FN($request);
        $post=post::find($id);
         if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error', "Authorization error");
        }
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        if($fileNtoStore!="NoImg.jpg"){
            Storage::delete('public/cover_images/'.$post->cover_image);
            $post->cover_image=$fileNtoStore;
        }
        $post->save();
        return redirect('/posts')->with("success","Post is created");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=post::find($id);
         if(auth()->user()->id!=$post->user_id){
            return redirect('/posts')->with('error', "Authorization error");
        }
        if($post->cover_image!='NoImg.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with("success","Post is removed");
    }
    
    private function get_FN(Request $request){
         $fileNtoStore='NoImg.jpg';
        if($request->hasFile('cover_image')){
            $fileNwithExt=$request->file('cover_image')->getClientOriginalName();
            $fileN= pathinfo($fileNwithExt,PATHINFO_FILENAME);
            $ext=$request->file('cover_image')->getClientOriginalExtension();
            $fileNtoStore=$fileN.'-'.time().'.'.$ext;
            $path=$request->file('cover_image')->storeAs('public/cover_images/', $fileNtoStore);
        }
        
        return $fileNtoStore;
    }
    public function vote($id){
       $post=post::find($id);
       $post->n_votes=$post->n_votes+1;
       $str='-'.auth()->user()->id;
       $post->who_voted=$post->who_voted.$str;
       $post->save();
       return redirect("/posts")->with("success","Vote is added");
    }
    public function change_visibilty($id){
         $post=post::find($id);
         if($post->visible==1){
               $post->visible=0;
                 $post->save();
             return redirect("/posts")->with("success","The Post is private NOW");
         }
         else{
              $post->visible=1;
                $post->save();
             return redirect("/posts")->with("success","The Post is public NOW");
         }   
    }
    public function get_unvisible(){
         /* $credentials = [
                'id' => '0',
                'email' => 'admin@gmail.com'
            ];//auth()->attempt();*/

        if(auth()->user()->id==0){
            $posts=Post::where('visible','0')->get();
             return view('unvisible')->with('posts', $posts);
        }else{
             return redirect("/posts")->with("error","Can't authorize user");
        }
    }
}
