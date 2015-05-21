@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
<table class="table table-striped">
<thead>
<tr>
<th>#</th>
<th>Title</th>
<th>最后修改时间</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($articles as $article)
<tr>
<td>{{ $article->id }}</td>
<td><a href="{{ URL::route('colleges.articles.show', $article->id) }}">{{ $article->title }}</a></td>
<td>{{ $article->updated_at }}</td>
<td>
<a href="{{ URL::route('colleges.articles.edit', $article->id) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('colleges.articles.destroy', $article->id), 'method' => 'delete', 'data-confirm' => 'Are you sure?')) }}
<button type="submit" href="{{ URL::route('colleges.articles.destroy', $article->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
@stop
@section('bootor')
@stop