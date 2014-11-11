@section('title', 'Personal')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12"> 
			<div class="page-header">
			  <h1>Todo el Personal <span class="pull-right"><a data-toggle="modal" href="#add_tag" class="btn btn-primary btn-lg">Nuevo Personal</a></span></h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6"> 
			<table class="table">
			   <thead>
			     <tr>
			       <th>Nombres</th>
			       <th class="col-lg-3 text-right">{{ trans('admin.actions') }}</th>
			     </tr>
			   </thead>
			   <tbody>
			  	@foreach($personales as $personal)
			    <tr rel="{{ $personal->id }}">
			        <td><a href="{{url('admin/personales/view/'.$personal->id)}}">{{ $personal->name }}</a></td>
			        <td>
			        	<div class="btn-group pull-right">
				        <a class="btn btn-primary btn-sm" href="{{url('admin/personales/view/'.$personal->id)}}">{{ trans('admin.edit') }}</a> 
				        <a class="delete_toggler btn btn-danger btn-sm" rel="{{$personal->id}}">Eliminar</a>
			        	</div>
			        </td>
			     </tr>
			    @endforeach
			    </tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal -->
 <div class="modal fade" id="add_tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">Nuevo Personal</h4>
       </div>
       <div class="modal-body">
       		@if($errors->all())
       		    <div class="bs-callout bs-callout-danger">
       		        <h4>{{ trans('admin.please_fix_errors') }}</h4>
       		        {{ HTML::ul($errors->all())}}
       		    </div>
       		@endif
			{{ Form::open(array('class'=>'form-horizontal'))}}
        	<div class="form-group">
        	    <label for="titulo" class="col-lg-8 control-label">Titulo</label>
        	    <div class="col-lg-10">
        	    	{{ Form::text('titulo',null,array('class'=>'form-control'))}}
        	    </div>
        	</div>
        	
        	<div class="form-group">
		    	<label for="name" class="col-lg-2 control-label" >Nombre completo</label>
		    	<div class="col-lg-10">
		    	{{Form::text('name', null, array('class'=>'form-control','placeholder'=>'Nombre ' ));}}
		    	</div>
		    </div>
		    <div class="form-group">
		    	<label for="cedula" class="col-lg-2 control-label" >Cédula</label>
		    	<div class="col-lg-10">
		    	{{Form::text('cedula', null, array('class'=>'form-control','placeholder'=>'Cédula' ));}}
		    	</div>
		    </div>
		    <div class="form-group">
		    	<label for="email" class="col-lg-2 control-label" >Email</label>
		    	<div class="col-lg-10">
		    	{{Form::text('email', null, array('class'=>'form-control','placeholder'=>'Email' ));}}
		    	</div>
		    </div>
        	<div class="form-group">
        		<div class="col-lg-10 col-lg-offset-2">
        		{{ Form::submit(trans('admin.create') ,array('class'=>'btn btn-lg btn-primary btn-block')); }}
        		</div>
        	</div>
        	{{ Form::close()}}
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->


<!-- Modal -->
 <div class="modal fade" id="delete_tag" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
         <h4 class="modal-title">{{ trans('admin.are_you_sure') }}</h4>
       </div>
       <div class="modal-body">
        	<p class="lead text-center">{{ trans('admin.tag_will_be_deleted') }}</p>
       </div>
       <div class="modal-footer">
        	<a data-dismiss="modal" href="#delete_tag" class="btn btn-default">{{ trans('admin.keep') }}</a>
        	<a href="" id="delete_link" class="btn btn-danger">{{ trans('admin.delete') }}</a>
       </div>
     </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		@if($errors->all())
		$('#add_tag').modal('show');
		@endif

		// Populate the field with the right data for the modal when clicked
		$('.delete_toggler').each(function(index,elem) {
		    $(elem).click(function(e){
		    	e.preventDefault();
		    	var href = "{{url('admin/tags/delete')}}/";
				$('#delete_link').attr('href',href + $(elem).attr('rel'));
				$('#delete_tag').modal('show');
		    });
		});
	});

</script>

@stop
