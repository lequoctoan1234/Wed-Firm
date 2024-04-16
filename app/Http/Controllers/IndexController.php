<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function search(){
        if (isset($_GET['search'])){
            $search = $_GET['search'];
            $category = Category::orderby('id','DESC')->where('status',1)->get();
            $genre = Genre::orderby('id','DESC')->get();
            $country = Country::orderby('id','DESC')->get();
            $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();

            $movie = Movie::where('title','LIKE','%'.$search.'%')->OrderBy('time_update','DESC')->paginate(40);

            $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
    
            return view('pages.search',compact('category','genre','country','search','category_home','movie','phimhot_sidebar'));
        }
        else{
            return redirect()->to('/');
        }
    }


    public function home(){
        $phimhot = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $genre_home = Genre::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $country_home = Country::with('movie')->orderby('id','DESC')->where('status',1)->get();
        return view('pages.home',compact('category','genre','country','category_home','country_home','genre_home','phimhot','phimhot_sidebar'));
    }
    public function category($slug){
        
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $category_home = Category::with('movie')->orderby('id','DESC')->where('status',1)->get();
        $movie = Movie::where('category_id',$cate_slug->id)->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.category',compact('category','genre','country','cate_slug','category_home','movie','phimhot_sidebar'));

    }
    public function genre($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $gen_slug = Genre::where('slug',$slug)->first();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        $movie_genre = Movie_Genre::where('genre_id',$gen_slug->id)->get();
        $genres = [];
        foreach($movie_genre as $key => $val){
            $genres[] = $val->movie_id;
        }
        $movie = Movie::whereIn('id',$genres)->OrderBy('time_update','DESC')->paginate(40);
        return view('pages.genre',compact('category','genre','country','gen_slug','movie','phimhot_sidebar','movie_genre'));

    }
    public function country($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $count_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$count_slug->id)->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.country',compact('category','genre','country','count_slug','movie','phimhot_sidebar'));

    }
    public function year($year){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $year = $year;
        $movie = Movie::where('year',$year)->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.year',compact('category','genre','country','year','movie','phimhot_sidebar'));

    }
    public function tag($tag){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $tag = $tag;
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.tag',compact('category','genre','country','movie','tag','phimhot_sidebar'));

    }
    public function actor($actor){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $actor = $actor;
        $movie = Movie::where('actor','LIKE','%'.$actor.'%')->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.actor',compact('category','genre','country','movie','actor','phimhot_sidebar'));

    }
    public function director($director){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $director = $director;
        $movie = Movie::where('director','LIKE','%'.$director.'%')->OrderBy('time_update','DESC')->paginate(40);
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->OrderBy('time_update','DESC')->take(5)->get();
        return view('pages.director',compact('category','genre','country','movie','director','phimhot_sidebar'));

    }
    public function watch($slug){
        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug',$slug)->where('status',1)->first();
        return view('pages.watch',compact('category','genre','country','movie'));
    }
    public function episode(){
        
        return view('pages.episode');

    }
    public function movie($slug){

        $category = Category::orderby('id','DESC')->where('status',1)->get();
        $genre = Genre::orderby('id','DESC')->get();
        $country = Country::orderby('id','DESC')->get();
        $movie = Movie::with('category', 'genre', 'country')->where('slug',$slug)->where('status',1)->first();
        $movies = Movie::with('category', 'genre', 'country','movie_genre')->where('genre_id',$movie->genre->id)->OrderBy('time_update','DESC')->OrderBy(DB::raw('RAND()'))->whereNotIn(
            'slug',[$slug]
        )->get();
        return view('pages.movie', compact('category','genre','country','movie','movies'));

    }

}
