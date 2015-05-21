@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
学校管理
@stop
@section('content')

                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>院校名称</th>
<th>院校排名</th>
<th>所在地区</th>
<th>985</th>
<th>211</th>
<th>院校隶属</th>
<th>院校举办</th>
<th>办学类型</th>
<th>院校科类</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->name }}</td>
<td>{{ $college->paiming }}</td>
<td>{{ $college->province->pname }}</td>
<td>{{ $college->is985 }}</td>
<td>{{ $college->is211 }}</td>
<td>{{ $college->lishu }}</td>
<td>{{ $college->juban }}</td>
<td>{{ $college->leixing }}</td>
<td>{{ $college->kelei }}</td>
<td>
<a href="{{ URL::route('backend.colleges.edit', $college->coid ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.colleges.destroy', $college->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.colleges.destroy', $college->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $colleges->links() }} 
                    <div class="col-lg-6">

                        <form role="form">
                            <div class="form-group">
                                <label>批量上传学校信息</label>
                                <input type="file">
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.row -->

@stop