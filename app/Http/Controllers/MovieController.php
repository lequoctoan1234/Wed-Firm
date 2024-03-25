<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Category;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category','country','genre')-> orderby('id','DESC')->get();
        return view('admincp.movie.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','country','genre')-> orderby('id','DESC')->get();
        return view('admincp.movie.form',compact('category','genre','country','list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title= $data['title'];
        $movie->eng= $data['eng'];
        $movie->quality= $data['quality'];
        $movie->phim_hot= $data['phim_hot'];
        $movie->slug= $data['slug'];
        $movie->description= $data['description'];
        $movie->status= $data['status'];
        $movie->genre_id= $data['genre_id'];
        $movie->country_id= $data['country_id'];
        $movie->category_id= $data['category_id'];

        $get_image = $request->file('image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image= $new_image;

        }
        // $movie->image= $data['image'];
        $movie->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $country = Country::pluck('title','id');
        $list = Movie::with('category','country','genre')-> orderby('id','DESC')->get();
        $movie = Movie::find($id);
        return view('admincp.movie.form',compact('category','genre','country','list','movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title= $data['title'];
        $movie->eng= $data['eng'];
        $movie->quality= $data['quality'];
        $movie->phim_hot= $data['phim_hot'];
        $movie->slug= $data['slug'];
        $movie->description= $data['description'];
        $movie->status= $data['status'];
        $movie->genre_id= $data['genre_id'];
        $movie->country_id= $data['country_id'];
        $movie->category_id= $data['category_id'];
        $get_image = $request->file('image');

        if($get_image){
            if(!empty($movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image= $new_image;

        }
        $movie->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie= Movie::find($id);
        if(!empty($movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        $movie->delete();
        return redirect()->back();
    }
    public function resorting(Request $request){
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $movie = Movie::find($value);
            $movie->position = $key;
            $movie -> save();
    
        }
    
        }
}
