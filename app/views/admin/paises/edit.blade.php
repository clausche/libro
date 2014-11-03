@section('title', trans('admin.editing_ciudad'))

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-6"> 
			<div class="page-header">
			  	<h1>{{ trans('admin.editing_a_ciudad') }} <a href="{{ url('admin/paises')}}" class="btn btn-lg btn-default pull-right">{{ trans('admin.cancel') }}</a></h1>
			</div>
            @if($errors->all())
                <div class="bs-callout bs-callout-danger">
                    <h4>{{ trans('admin.please_fix_errors') }}</h4>
                    {{ HTML::ul($errors->all())}}
                </div>
            @endif
@foreach ($pais as $pais)
    {{-- expr --}}
@endforeach
			{{ Form::model($pais,array('class'=>'form-horizontal'))}}
        	<div class="form-group">
        	    <label for="name" class="col-lg-2 control-label">{{ trans('admin.name') }}</label>
        	    <div class="col-lg-10">
        	    	{{ Form::text('name',$pais->name,array('class'=>'form-control'))}}
        	    </div>
        	</div>
            <div class="form-group">
                <label for="headofstate" class="col-lg-2 control-label">Jefe de Estado</label>
                <div class="col-lg-10">
                    {{ Form::text('headofstate',$pais->headofstate,array('class'=>'form-control'))}}
                </div>
            </div>
        	<div class="form-group">
        		<div class="col-lg-10 col-lg-offset-2">
        		{{ Form::submit(trans('admin.save_ciudad'), array('class'=>'btn btn-primary btn-block')); }}
        		</div>
        	</div>
        	{{ Form::close()}}
	    </div>
	</div>
</div>
@stop