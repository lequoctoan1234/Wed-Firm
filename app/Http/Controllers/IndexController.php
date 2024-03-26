<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function home(){
        $phimhot = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->get();
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $genre_home = Genre::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $country_home = Country::with('movie')->orderby('id','DESC')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home','country_home','genre_home','phimhot'));
    }
    public function category($slug){
        
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $movie = Movie::where('category_id',$cate_slug->id)->OrderBy('time_update','DESC')->paginate(40);
        return view('pages.category',compact('category','genre','country','cate_slug','category_home','movie'));

    }
    public function genre($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $gen_slug = Genre::where('slug',$slug)->first();
        $movie = Movie::where('genre_id',$gen_slug->id)->OrderBy('time_update','DESC')->paginate(40);
        return view('pages.genre',compact('category','genre','country','gen_slug','movie'));

    }
    public function country($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $count_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$count_slug->id)->OrderBy('time_update','DESC')->paginate(40);
        return view('pages.country',compact('category','genre','country','count_slug','movie'));

    }
    public function watch(){
        
        return view('pages.watch');

    }
    public function episode(){
        
        return view('pages.episode');

    }
    public function movie($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug',$slug)->where('status',1)->first();
        $movies = Movie::with('category', 'genre', 'country')->where('genre_id',$movie->genre->id)->OrderBy('time_update','DESC')->OrderBy(DB::raw('RAND()'))->whereNotIn(
            'slug',[$slug]
        )->get();
        return view('pages.movie', compact('category','genre','country','movie','movies'));

    }

}
