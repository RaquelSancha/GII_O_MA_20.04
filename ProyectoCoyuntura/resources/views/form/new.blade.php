@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">	Rellena el formulario</h3>
	</div>
	<div class="box-body">		
	
	<form id="surveyForm" method="post" class="form-horizontal" action="{{ url('/tables/new')}}">
	  {{ csrf_field() }}
		<div class="form-group">
			<label for="nombre_variable" class="col-md-4 control-label"> Introduce un nombre para la tabla</label>
			<div class="row">
		        <div class="form-group form-group-options col-md-4 col-md-offset-5">
		    			<input type="text" name="nombre_variable" class="form-control">
		    	</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label"> Introduce los Ámbitos Geograficos</label>
			<div class="row">
		        <div class="form-group form-group-options col-md-4 col-md-offset-5">
		    		<div class="input-group input-group-option  col-xs-10">
		    			<input type="text" name="ambitos[]" class="form-control" placeholder="Pincha para añadir ">
		    			<span class="input-group-addon input-group-addon-remove">
		    				<span class="glyphicon glyphicon-remove"></span>
		    			</span>
		    		</div>
		    	</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-4 control-label"> Introduce las categorías</label>
			<div class="row">
		        <div class="form-group form-group-options col-md-4 col-md-offset-5">
		    		<div class="input-group input-group-option  col-xs-10">
		    			<input type="text" name="categorias[]" class="form-control" placeholder="Pincha para añadir ">
		    			<span class="input-group-addon input-group-addon-remove">
		    				<span class="glyphicon glyphicon-remove"></span>
		    			</span>
		    		</div>
		    	</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label"> Introduce los años</label>
			<div class="row">
		        <div class="form-group form-group-options col-md-4 col-md-offset-5">
		    		<div class="input-group input-group-option  col-xs-4">
		    			<input type="number" name="years[]" class="form-control" placeholder="Pincha para añadir ">
		    			<span class="input-group-addon input-group-addon-remove">
		    				<span class="glyphicon glyphicon-remove"></span>
		    			</span>
		    		</div>
		    	</div>
			</div>
		</div>

		<div class="form-group">
	        <div class="col-md-8 col-md-offset-4">
	            <input type="submit" value="Enviar datos!" class="btn btn-primary"  > 
	        </div>
  		</div>
	</form>

	</div>
</div>

<script>
var room = 1;
function education_fields() {
 
    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
	divtest.setAttribute("class", "form-group removeclass"+room);
	var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="School name"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Major" name="Major[]" value="" placeholder="Major"></div></div><div class="col-sm-3 nopadding"><div class="form-group"> <input type="text" class="form-control" id="Degree" name="Degree[]" value="" placeholder="Degree"></div></div><div class="col-sm-3 nopadding"><div class="form-group"><div class="input-group"> <select class="form-control" id="educationDate" name="educationDate[]"><option value="">Date</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option> </select><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields('+ room +');"> <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> </button></div></div></div></div><div class="clear"></div>';
    
    objTo.appendChild(divtest)
}
   function remove_education_fields(rid) {
	   $('.removeclass'+rid).remove();
   }

$(function(){
    
	$(document).on('focus', 'div.form-group-options div.input-group-option:last-child input', function(){
        
		var sInputGroupHtml = $(this).parent().html();
		var sInputGroupClasses = $(this).parent().attr('class');
		$(this).parent().parent().append('<div class="'+sInputGroupClasses+'">'+sInputGroupHtml+'</div>');
        
	});
	
	$(document).on('click', 'div.form-group-options .input-group-addon-remove', function(){
        
		$(this).parent().remove();
        
	});
    
});

</script>

@endsection
