@extends('layouts.main')
@section('title') Новость с id = {{ $news->id }} - @parent @stop
@section('slug') @parent @stop
@section('content')
<h2>Новость с id = {{ $news->id }}</h2>
@endsection

@push('js')
    <script>
        alert("It's news with ID #{{$news->id}}");
    </script>
@endpush