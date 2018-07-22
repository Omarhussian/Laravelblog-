<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use Session;     
    


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *  
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store in it all our blog posts to show on the page 
        $posts=post::all();


        // return a view pass in the above variable

        return view('posts.index')->withPosts($posts);  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request,array(
            'title'=>'required|max:255',
            'body'=>'required'
        ));

        // store the data
        $post = new post;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        Session::flash('success','the blog post saved!');


        // redirect into another page

        return redirect()->route('posts.show',$post->id);   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $post= post::find($id); 
        return view('posts.show')->with('post',$post);
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database and submit it as a var     
        $post = Post::find($id);

        // return the view and pass in the var

        return view('posts.edit')->withPost($post);

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
        //validate the data 
          $this->validate($request,array(
            'title'=>'required|max:255',
            'body'=>'required'
        ));
         // save the data to the database
            $post= Post::find($id);

            $post->title = $request->input('title');

            $post->body = $request->input('body');

            $post->save();
        //set flash message with success
        Session::flash('success','This post was successfully Updated Mabrok!');
        //redirect with flash data to view post.show
        return redirect()->route('posts.show',$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        Session::flash('success','The post was successfully deleted');
        return redirect()->route('posts.index');
    }
}
