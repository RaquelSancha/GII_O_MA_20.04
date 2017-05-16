
<form class="form-horizontal" role="form" method="POST" action="{{ url('tables')}}/{{$id}}">
  {{ csrf_field() }}
  <div class="form-group">
      <label for="categoria" class="col-md-4 control-label">Selecciona las categorías a mostrar</label>

      <div class="col-md-2">
          <select multiple class="selectpicker show-tick" name="categoria[]">
            @foreach($categorias as $categoria)
            <option>{{$categoria->Nombre}}</option>
            @endforeach
          </select>
      </div>
  </div>

  <div class="form-group">
      <label for="years" class="col-md-4 control-label">Selecciona los años</label>
      <div class="col-md-2">
          <select class="selectpicker" multiple name="years[]">
            @foreach($years as $year)
            <option>{{$year->Year}}</option>
            @endforeach
          </select>
          
      </div>
  </div>
  
  <div class="form-group">
      <label for="filtrado" class="col-md-4 control-label">Selecciona cómo deseas filtrar los datos</label>
      <div class="col-md-2">
          <select class="selectpicker" name="filtrado">
            <option>Meses</option>
            <option>Años</option>
            <option>Trimestres</option>
          </select>
      </div>
  </div>
  

  <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
         <input type="submit" value="Enviar datos!" class="btn btn-primary"  > 
      </div>
  </div>
</form>



<!-- <div class="form-group">
    <label for="name">{{ trans('adminlte_lang::message.nameForm') }}</label>
    <input type="name" class="form-control" id="name"  name="name" value="">
</div> 

<div class="form-group">
  <label for="sel1">Selecciona las categorías a mostrar (mantén presionado ctrl o shift):</label>

  <select class="selectpicker show-tick"  id="selCategoria" data-style="btn-success">

    @foreach($categorias as $categoria)
    <option>{{$categoria->Nombre}}</option>
    @endforeach
  </select>
</div>

<div class="form-group ">
  <label for="sel2">Selecciona los años:</label>
  <select class="selectpicker"  id="selYears">
    @foreach($years as $year)
    <option>{{$year->Year}}</option>
    @endforeach
  </select>
</div>


<div>
<select class="selectpicker" multiple data-style="btn-success">
  <option>Mustard</option>
  <option>Ketchup</option>
  <option>Relish</option>
</select>
<select class="selectpicker" multiple>
  <optgroup label="Condiments" data-max-options="2">
    <option>Mustard</option>
    <option>Ketchup</option>
    <option>Relish</option>
  </optgroup>
  <optgroup label="Breads" data-max-options="2">
    <option>Plain</option>
    <option>Steamed</option>
    <option>Toasted</option>
  </optgroup>
</select>

</div>

<select class="selectpicker" multiple data-selected-text-format="count">
  <option>Mustard</option>
  <option>Ketchup</option>
  <option>Relish</option>
</select>
-->
