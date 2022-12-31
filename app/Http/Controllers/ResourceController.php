<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Hello';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get filename with the extension
        $filenameWithExt = $request->file('file')->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('file')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload Image
        $path = Storage::disk('local')->put($fileNameToStore, 'Contents');
        // $path = $request->file('file')->storeAs(public_path('uploads/posts/'),$fileNameToStore);
        $objPosts = new Post();
        $loggedId = \Auth::user()->id;
        $data = [
            'user_id' => $loggedId,
            'content' => $request->content,
            'image' => $fileNameToStore,
        ];
        if($objPosts->create($data)){
            return redirect('Successfuly Posted',200);
        }else{
            return redirect('Failed to Store',400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $objPosts = new Post;
        $result = $objPosts->select('posts.id','c.comment','posts.content')
        ->leftJoin('comments as c','c.post_id','posts.id')
        ->where('posts.id',$request->id)->where('posts.user_id',\Auth::user()->id)->get();
        return $result;
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
    }
}
