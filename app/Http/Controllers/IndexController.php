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

        $category = Category::orderby('id','DESC')->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        return view('pages.home',compact('category','genre','country'));

    }
    public function category($slug){
        
        return view('pages.category');

    }
    public function genre($slug){
        
        return view('pages.genre');

    }
    public function country($slug){
        
        return view('pages.country');

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
