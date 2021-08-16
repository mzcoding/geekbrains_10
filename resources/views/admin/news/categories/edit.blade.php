@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Редактировать категорию</h1>
        <a href="{{ route('admin.categories.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-list fa-sm text-white-50"></i> К списку категорий</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        @include('inc.message')
        <div class="col-12">
            <form method="post" action="{{ route('admin.categories.update', ['category' => $category]) }}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $category->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description">{!! $category->description !!}</textarea>
                </div>

                <button class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>
@endsection