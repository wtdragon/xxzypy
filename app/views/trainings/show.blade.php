@extends('master')
@section('header')
@stop
@section('content')
 <div id="onepage">
<div class="title">
<h3>{{ $article->title }}</h3>
</div>
<div class="info">
由 {{ $author }} 发布于 {{ $article->created_at }} 最后更新 {{ $article->updated_at }}
</div>
<div class="body">
{{ $article->body }}
</div>
</div>
@stop
@section('bootor')
@stop