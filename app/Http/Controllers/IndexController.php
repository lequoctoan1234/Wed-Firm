<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;


class IndexController extends Controller
{
    public function home(){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $genre_home = Genre::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $country_home = Country::with('movie')->orderby('id','DESC')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home','country_home','genre_home'));

    }
    public function category($slug){
        
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        return view('pages.category',compact('category','genre','country','cate_slug','category_home'));

    }
    public function genre($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $gen_slug = Genre::where('slug',$slug)->first();
        return view('pages.genre',compact('category','genre','country','gen_slug'));

    }
    public function country($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $count_slug = Country::where('slug',$slug)->first();
        return view('pages.country',compact('category','genre','country','count_slug'));

    }
    public function watch(){
        
        return view('pages.watch');

    }
    public function episode(){
        
        return view('pages.episode');

    }
    public function movie($slug){
        
        return view('pages.movie');

    }

}
