@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить новость</h1>
        <a href="{{ route('admin.news.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-list fa-sm text-white-50"></i> К списку новостей</a>
    </div>

    <!-- Content Row -->
    <div class="row" >
        <div class="col-12">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
       <form method="post" action="{{ route('admin.news.store') }}">
           @csrf
           <div class="form-group">
               <label for="title">Заголовок</label>
               <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
           </div>
           <div class="form-group">
               <label for="author">Автор</label>
               <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}">
           </div>
           <div class="form-group">
               <label for="description">Описание</label>
               <textarea class="form-control" name="description" id="description">{!! old('description') !!}</textarea>
           </div>

           <button class="btn btn-primary">Сохранить</button>
       </form>
    </div></div>
@endsection