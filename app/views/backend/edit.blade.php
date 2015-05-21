@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')

@stop
@section('content')

<div class="row">
@if($college)
{{ Form::model($college,array('method' => 'PUT','route' => array('backend.colleges.update', $college->coid), 'class'=>'form-inline edit-form')) }}		
<p>
{{ Form::label('name', '院校名称:') }}
{{ Form::text('name') }} 
{{ Form::label('paiming', '院校排名:') }}
{{ Form::text('paiming') }} 
{{ Form::label('is985', '985:') }}
{{ Form::text('is985') }}
{{ Form::label('is211', '211:') }}
{{ Form::text('is211') }} 
</p>
<p>
{{ Form::label('lishu', '院校隶属:') }}	
{{ Form::text('lishu') }} 
{{ Form::label('juban', '院校举办:') }}	
{{ Form::text('juban') }} 
{{ Form::label('leixing', '办学类型:') }}	
{{ Form::text('leixing') }} 
{{ Form::label('kelei', '院校科类:') }}	
{{ Form::text('kelei') }} 
</p>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.colleges.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}


@elseif($specialty)
 

{{ Form::model($specialty,array('method' => 'PUT','route' => array('backend.specialties.update', $specialty->id), 'class'=>'form-inline edit-form')) }}		
<p>
{{ Form::label('yxmc', '院校名称:') }}
{{ Form::text('yxmc') }} 
{{ Form::label('cengci', '层次:') }}
{{ Form::text('cengci') }} 
{{ Form::label('zymingcheng', '专业名称:') }}
{{ Form::text('zymingcheng') }}
{{ Form::label('kelei', '科类:') }}
{{ Form::text('kelei') }} 
</p>
<p>
{{ Form::label('pici', '批次:') }}	
{{ Form::text('pici') }} 
{{ Form::label('jihuaxingzhi', '计划性质:') }}	
{{ Form::text('jihuaxingzhi') }} 
</p>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.specialties.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}


@elseif($carticle) 
{
	 carticle 
}


@elseif($mschool) 
	<div class='col-md-7 text-center'>
 <h3>修改受管理学校</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($mschool, array('method' => 'put', 'route' => array('backend.mschools.update', $mschool->id))) }}
<div class="control-group">
{{ Form::label('schoolname', '修改学校名称') }}
{{ Form::text('schoolname') }}
{{ Form::label('teachername', '修改管理员名称') }}
{{ Form::text('teachername') }}
</div>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.mschools.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>

@else


		<div class='col-md-7 text-center'>
 <h3>修改受学生ktest数据</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($ktests, array('method' => 'put', 'route' => array('backend.ktests.update', $ktests->id))) }}
<div class="control-group">
{{ Form::label('学生姓名:') }}{{ $ktests->student->stuname }}
{{ Form::label('collegename', '修改学校') }}
{{ Form::text('collegename') }}
{{ Form::label('zymc', '修改专业') }}
{{ Form::text('zymc') }}
</div>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('backend.ktests.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>
@endif
</div>
                <!-- /.row -->

@stop