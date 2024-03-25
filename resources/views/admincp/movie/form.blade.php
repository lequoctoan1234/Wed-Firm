@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('quản lý phim') }}</div>
                <a href="{{route('movie.index')}}" class="btn btn-primary">Liệt kê phim</a>
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
                    {!! Form::label('eng','Name English', []) !!}
                    {!! Form::text('eng',isset($movie) ? $movie->eng : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'eng']) !!}
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
                    {!! Form::label('quality','Quality', []) !!}
                    {!! Form::select('quality',['SD'=>'SD','HD'=>'HD','FullHD'=>'FullHD','Cam'=>'Cam','HDCam'=>'HDCam','4K'=>'4K'],isset($movie) ? $movie->quality : '',['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('sub','SUB', []) !!}
                    {!! Form::select('sub',['Vietsub'=>'Vietsub','Thuyết Minh'=>'Thuyết Minh','Engsub'=>'Engsub'],isset($movie) ? $movie->sub : '',['class' => 'form-control']) !!}
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
                <div class="form-group">
                    {!! Form::label('Hot','Hot', []) !!}
                    {!! Form::select('phim_hot',['1'=>'Có','0'=>'Không'],isset($movie) ? $movie->phim_hot : '',['class' => 'form-control']) !!}
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
                        <th scope="col">Phim Hot</th>
                        <th scope="col">Name English</th>
                        <th scope="col">Quality</th>
                        <th scope="col">Ative</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody class="order_position">
                        @foreach ($list as $key => $movi)
                        <tr id="{{$movi->id}}">
                            <th scope="row">{{$key}}</th>
                            <td>{{$movi->title}}</td>
                            <td>{{$movi->description}}</td>
                            <td>{{$movi->category->title}}</td>
                            <td>{{$movi->country->title}}</td>
                            <td>{{$movi->genre->title}}</td>
                            <td><img src="{{asset('uploads/movie/'.$movi->image)}}" width="50%"></td>
                            <td>
                                @if($movi->phim_hot == 0)
                                    Không
                                @else
                                    Có
                                @endif
                            </td>
                            <td>{{$movi->eng}}</td>
                            <td>{{$movi->quality}}</td>
                            <td>
                                @if($movi->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td>{{$movi->slug}}</td>
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
