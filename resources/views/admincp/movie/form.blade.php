@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('quản lý phim') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif   
                @if(!isset($movie))         
                {!! Form::open(['route' => 'movie.store','method' => 'POST','enctype'=>'multipart/form-data']) !!}
                @else
                {!! Form::open(['route' => ['movie.update',$movie->id],'method' => 'PUT','enctype'=>'multipart/form-data']) !!}
                @endif
                <div class="form-group">
                    {!! Form::label('title','Title', []) !!}
                    {!! Form::text('title',isset($movie) ? $movie->title : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'slug','onkeyup'=>'ChangeToSlug()']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('slug','Slug', []) !!}
                    {!! Form::text('slug',isset($movie) ? $movie->slug : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'convert_slug']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Description', []) !!}
                    {!! Form::textarea('description',isset($movie) ? $movie->description : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Atice','Atice', []) !!}
                    {!! Form::select('status',['1'=>'Hiển Thị','0'=>'Không Hiển Thị'],isset($movie) ? $movie->status : '',['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Category','Category', []) !!}
                    {!! Form::select('category_id',$category,isset($movie) ? $movie->category_id : '',['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Country','Country', []) !!}
                    {!! Form::select('country_id',$country,isset($movie) ? $movie->country_id : '',['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Genre','Genre', []) !!}
                    {!! Form::select('genre_id',$genre,isset($movie) ? $movie->genre_id : '',['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('image','image', []) !!}
                    {!! Form::file('image',['class' => 'form-control-file']) !!}
                    @if(isset($movie))
                        <img src="{{asset('uploads/movie/'.$movie->image)}}">
                    @endif
                </div>
                @if(!isset($movie)) 
                {!! Form::submit('Thêm Dữ Liệu',['class' => 'btn btn-success']) !!}
                @else
                {!! Form::submit('Cập Nhật',['class' => 'btn btn-success']) !!}
                <a href="{{route('movie.create')}}" class="btn btn-success" style="margin-left:5px">Tạo danh mục mới</a>
                
                @endif
                    {!! Form::close() !!}
                </div>
            </div>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">category</th>
                        <th scope="col">country</th>
                        <th scope="col">genre</th>
                        <th scope="col">image</th>
                        <th scope="col">Ative</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $movi)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$movi->title}}</td>
                            <td>{{$movi->description}}</td>
                            <td>{{$movi->category->title}}</td>
                            <td>{{$movi->country->title}}</td>
                            <td>{{$movi->genre->title}}</td>
                            <td><img src="{{asset('uploads/movie/'.$movi->image)}}"></td>
                            <td>
                                @if($movi->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td style="display: flex;">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['movie.destroy',$movi->id],'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa danh mục này?")']) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('movie.edit', $movi->id)}}" class="btn btn-danger" style="margin-left:5px"> Sửa</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>        
        </div>
    </div>
</div>
@endsection
