@section('title', trans('tricks.trick'))

@section('styles')
	<link rel="stylesheet" href="{{ URL::asset('css/highlight/laratricks.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('js/selectize/css/selectize.bootstrap3.css') }}">
	<style type="text/css">
    #editor-content {
      position: relative;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      height: 300px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
      border: 1px solid #cccccc;
    }
    </style>
@stop

@section('scripts')
	<script type="text/javascript" src="{{url('js/selectize/js/standalone/selectize.min.js')}}"></script>
	<script src="{{ asset('js/ace.js') }} "></script>
	<script type="text/javascript" src="{{ asset('js/trick-new-edit.min.js') }}"></script>
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-lg-push-2 col-md-8 col-md-push-2 col-sm-12 col-xs-12">
				<div class="content-box">
					<h1 class="page-title">
						{{ trans('tricks.creating_new_trick') }}
					</h1>
					@if(Session::get('errors'))
					    <div class="alert alert-danger alert-dismissable">
					        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					         <h5>{{ trans('tricks.errors_while_creating') }}</h5>
					         @foreach($errors->all('<li>:message</li>') as $message)
					            {{$message}}
					         @endforeach
					    </div>
					@endif
					{{ Form::open(array('class'=>'form-vertical','id'=>'save-trick-form','role'=>'form'))}}
					
						<div class="form-group">
					    	<label for="name">Nombre Personal</label>
					    	{{Form::text('name', null, array('class'=>'form-control','placeholder'=>'Ingresa aquí el nombre del funcionario diplomático' ));}}
					    </div>
					    <div class="form-group">
					    	<label for="titulo">Titulo</label>
					    	{{Form::text('titulo', null, array('class'=>'form-control','placeholder'=>'Indique el Titulo o Cargo del funcionario' ));}}
					    </div>
					    
					    <div class="form-group">
					    	<label for="cedula">Cédula de Identidad</label>
					    	{{Form::text('cedula', null, array('class'=>'form-control','placeholder'=>'Indique la Cédula' ));}}
					    </div>
					    <div class="form-group">
					    	<label for="email">Email</label>
					    	{{Form::text('email', null, array('class'=>'form-control','placeholder'=>'Correo electrónico' ));}}
					    </div>
											    
					    <div class="form-group">
					        <div class="text-right">
					          <button type="submit"  id="save-section" class="btn btn-primary ladda-button" data-style="expand-right">
					            {{ trans('tricks.save_trick') }}
					          </button>
					        </div>
					    </div>
					{{Form::close()}}
				</div>
			</div>
		</div>
	</div>
@stop
