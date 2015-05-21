@extends('master')
@section('header')
@stop
@section('content')
 <div id="onepage">
<tr>
<td>{{ $college->name }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
</tr>
</div>
@stop
@section('bootor')
@stop