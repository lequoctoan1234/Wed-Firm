@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif   
                @if(!isset($genre))         
                {!! Form::open(['route' => 'genre.store','method' => 'POST']) !!}
                @else
                {!! Form::open(['route' => ['genre.update',$genre->id],'method' => 'PUT']) !!}
                @endif
                <div class="form-group">
                    {!! Form::label('title','Title', []) !!}
                    {!! Form::text('title',isset($genre) ? $genre->title : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'title']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('description','Description', []) !!}
                    {!! Form::textarea('description',isset($genre) ? $genre->description : '', ['class' => 'form-control','placeholder' =>'Nhập dữ liệu vào ....','id'=>'description']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('atice','Atice', []) !!}
                    {!! Form::select('status',['1'=>'Hiển Thị','0'=>'Không Hiển Thị'],isset($genre) ? $genre->status : '',['class' => 'form-control']) !!}
                </div>
                @if(!isset($genre)) 
                {!! Form::submit('Thêm Dữ Liệu',['class' => 'btn btn-success']) !!}
                @else
                {!! Form::submit('Cập Nhật',['class' => 'btn btn-success']) !!}
                <a href="{{route('genre.create')}}" class="btn btn-success" style="margin-left:5px">Tạo danh mục mới</a>
                
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
                        <th scope="col">Ative</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $key => $cate)
                        <tr>
                            <th scope="row">{{$key}}</th>
                            <td>{{$cate->title}}</td>
                            <td>{{$cate->description}}</td>
                            <td>
                                @if($cate->status)
                                    Hiển thị
                                @else
                                    Không hiển thị
                                @endif
                            </td>
                            <td style="display: flex;">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['genre.destroy',$cate->id],'onsubmit'=>'return confirm("Bạn chắc chắn muốn xóa danh mục này?")']) !!}
                                {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                                <a href="{{route('genre.edit', $cate->id)}}" class="btn btn-danger" style="margin-left:5px"> Sửa</a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>        
        </div>
    </div>
</div>
@endsection
