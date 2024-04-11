<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Country;
use App\Models\Category;
use App\Models\Genre;
use Carbon\Carbon;
use File;
use Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Movie::with('category','country','genre')->orderby('id','DESC')->get();

        $path = public_path()."/json_file/";
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        File::put($path.'movies.json',json_encode($list));
        return view('admincp.movie.index',compact('list'));
    }
    public function year(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_firm']);
        $movie->year = $data['year'];
        $movie->save();
    }
    public function season (Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_firm']);
        $movie->season = $data['season'];
        $movie->save();
    }
    public function topview(Request $request){
        $data = $request->all();
        $movie = Movie::find($data['id_firm']);
        $movie->topview = $data['topview'];
        $movie->save();
    }

    public function filter_topview(Request $request){
        $data = $request->all();
        $movie = Movie::where('topview', $data['value'])->OrderBy('time_update','DESC')->take(5)->get();
        $output = '';
        foreach($movie as $key => $mov){
        $output.=' <div class="item post-37176">
        <a href="'.url('firm/'.$mov->slug).'" '.$mov->title.'">
            <div class="item-link">
                <img src="'.url('uploads/movie/'.$mov->image).'" class="lazy post-thumb" alt="'.$mov->title.'" title="'.$mov->title.'" />
                <span class="is_trailer">'.$mov->quality.'</span>
            </div>
            <p class="title">'.$mov->title.'</p>
        </a>
        <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
        <div style="float: left;">
            <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                <span style="width: 0%"></span>
            </span>
        </div>
    </div>';
        }
    echo  $output;
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
        $movie->trailer= $data['trailer'];
        $movie->quality= $data['quality'];
        $movie->phim_hot= $data['phim_hot'];
        $movie->slug= $data['slug'];
        $movie->description= $data['description'];
        $movie->status= $data['status'];
        $movie->tags= $data['tags'];
        $movie->director= $data['director'];
        $movie->actor= $data['actor'];
        $movie->genre_id= $data['genre_id'];
        $movie->country_id= $data['country_id'];
        $movie->category_id= $data['category_id'];
        $movie->sub= $data['sub'];
        $movie->time_create= Carbon::now('Asia/Ho_Chi_Minh');
        $movie->time_update= Carbon::now('Asia/Ho_Chi_Minh');
        $movie->time= $data['time'];
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
        $movie->trailer= $data['trailer'];
        $movie->quality= $data['quality'];
        $movie->phim_hot= $data['phim_hot'];
        $movie->slug= $data['slug'];
        $movie->description= $data['description'];
        $movie->status= $data['status'];
        $movie->tags= $data['tags'];
        $movie->director= $data['director'];
        $movie->actor= $data['actor'];
        $movie->genre_id= $data['genre_id'];
        $movie->country_id= $data['country_id'];
        $movie->category_id= $data['category_id'];
        $movie->time= $data['time'];
        $movie->sub= $data['sub'];
        $get_image = $request->file('image');
        $movie->time_update= Carbon::now('Asia/Ho_Chi_Minh');
        if($get_image){
            if(file_exists('uploads/movie/',$movie->image)){
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
        if(file_exists('uploads/movie/',$movie->image)){
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
