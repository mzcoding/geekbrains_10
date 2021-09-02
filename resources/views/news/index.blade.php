@extends('layouts.main')
@section('title') Список новостей - @parent @stop
@section('slug') @parent @stop
@section('content')
    @forelse($newsList as $news)
    <!-- Post preview-->
    <div class="post-preview">
        <a href="{{ route('news.show', ['news' => $news->id]) }}">
            <h2 class="post-title"><u>{{ $news->title }}</u></h2>
        </a>
        @if($news->image)
            <img src="{{ Storage::disk('public')->url($news->image) }}" style="width:200px;">
        @endif
        <h3 class="post-subtitle">{{ $news->description }}</h3>
        <p class="post-meta">
            Опубликовал
            <a href="#!">{{ $news->author }}</a>
            on {{ $news->updated_at }}
        </p>
    </div>
    <!-- Divider-->
    <hr class="my-4" />
    <!-- Post preview-->
    @empty
        <h2>Новостей нет</h2>
    @endforelse
    <!-- Pager-->
    <div class="d-flex justify-content-end mb-4">
        <a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a>
    </div>
@endsection






