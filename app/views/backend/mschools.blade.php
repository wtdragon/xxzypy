@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
受管理学校
@stop

@section('content')
{{ Notification::showAll() }}
                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>学校名称</th>
<th>管理员姓名</th>
<th>管理员邮箱地址</th>
<th>联系方式</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($mschools as $mschool)
<tr>
<td>{{ $mschool->schoolname }}</td>
<td>{{ $mschool->teachers->teachername }}</td>
<td>{{ $mschool->teachers->emailaddress }}</td>
<td>{{ $mschool->teachers->phone }}</td>
<td>
<a href="{{ URL::route('backend.mschools.edit', $mschool->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.mschools.destroy', $mschool->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.mschools.destroy', $mschool->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $mschools->links() }} 
</div>
<div class='row'>
<h3>新增受管理学校</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::open(array('route' => 'backend.mschools.store','class'=>'border form-inline')) }}
<div class="form-group">
{{ Form::label('schoolname','学校名称', array('class' => 'control-label')) }}

{{ Form::text('schoolname') }}

{{ Form::label('teachername', '管理员', array('class' => 'control-label')) }}

{{ Form::text('teachername') }}

{{ Form::label('emailaddress', '管理员邮箱地址', array('class' => 'control-label')) }}

{{ Form::text('emailaddress') }}
{{ Form::label('phone', '管理员联系方式', array('class' => 'control-label')) }}

{{ Form::text('phone') }}

</div>

<div class="form-actions text-center">
{{ Form::submit('新增', array('class' => 'btn btn-success bottom btn-save btn-large')) }}
<a href="{{ URL::route('backend.mschools.index') }}" class="btn bottom btn-large">取消</a>
</div>

{{ Form::close() }}
</div>
                    <div class="col-lg-6">

                        <form role="form">
                            <div class="form-group">
                                <label>批量上传学校信息</label>
                                <input type="file">
                            </div>
                        </form>

                    </div>
 
                <!-- /.row -->

@stop