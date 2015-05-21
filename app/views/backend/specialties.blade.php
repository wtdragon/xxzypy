@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
专业管理
@stop
@section('content')

<div class="row"><table class="table table-bordered">
<thead>
<tr>
<th>院校名称</th>
<th>层次</th>
<th>专业名称</th>
<th>文理科</th>
<th>批次</th>
<th>计划性质</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($specialties as $specialty)
<tr>
<td>{{ $specialty->yxmc }}</td>
<td>{{ $specialty->cengci }}</td>
<td>{{ $specialty->zymingcheng }}</td>
<td>{{ $specialty->kelei }}</td>
<td>{{ $specialty->pici }}</td>
<td>{{ $specialty->jihuaxingzhi }}</td>
<td>
<a href="{{ URL::route('backend.specialties.edit', $specialty->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.specialties.destroy', $specialty->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.specialties.destroy', $specialty->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $specialties->links() }} 
                    <div class="col-lg-6">

                        <form role="form">
                            <div class="form-group">
                                <label>批量上传专业信息</label>
                                <input type="file">
                            </div>
                        </form>

                    </div>
                    
                </div>
                <!-- /.row -->

@stop