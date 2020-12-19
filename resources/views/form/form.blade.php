
<div class="form-group">
  <label for="years" class="col-md-4 control-label"> Selecciona los años</label>
  <div class="row">
        <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="years[]" id="years" title="" required> 
            @foreach($years as $year)
        <option>{{$year->Year}}</option>
        @endforeach
          </select>
      </div>
  </div>
</div>
<div class="form-group">
  <label for="ambitos" class="col-md-4 control-label"> Selecciona los ámbitos geográficos</label>
  <div class="row">
        <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup"  name="ambitos[]" title="" required > 
            @foreach($ambitos as $ambito)
              <option>{{$ambito->Nombre}}</option>
            @endforeach
          </select>
      </div>
  </div>
</div>
<div class="form-group">
<label for="filtrado" class="col-md-4 control-label">Selecciona cómo deseas filtrar los datos</label>
  <div class="row">
    <div class="form-group form-group-options col-md-4 col-md-offset-5">
      <select class="selectpicker" name="filtrado" required>
        <option>Meses</option>
        <option>Años</option>
        <option>Trimestres</option>
      </select>
    </div>
  </div>
</div>
<div class="form-group">
  <label for="categoria" class="col-md-4 control-label">Selecciona las categorías a mostrar</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
        <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup"  name="categoria[]" title="" required > 
          @if((count($supercategorias))>1)
            @for($i=0, $j=0 ;$i<count($categorias);$i++) 
                @if($categorias[$i]->idSuperCategoria == $supercategorias[$j]->idSuperCategoria)
                 <optgroup label="{{$supercategorias[$j]->Name}}" >
                 <?php
                  if ($categorias[(count($categorias)-1)]->idSuperCategoria != $supercategorias[$j]->idSuperCategoria) {
                    $j++;
                  }else{
                    $j=0;
                  }
                    ?>
                @endif
                <option>{{$categorias[$i]->Nombre}}</option>
            @endfor
          @else
            <optgroup label="{{$supercategorias[0]->Name}}" >
            @for($i=0;$i<count($categorias);$i++) 
              <option>{{$categorias[$i]->Nombre}}</option>
            @endfor
          @endif
        </select>
      </div> 
    </div>
</div>
<div class="form-group">
<label for="filtrado" class="col-md-4 control-label"></label>
  <div class="row">
    <div class="form-group form-group-options col-md-4 col-md-offset-5">
      <input type="submit" value="Enviar datos" class="btn btn-primary" onclick=this.form.action="{{ url('tables')}}/{{$id}}" > 
    </div>
    <div class="form-group form-group-options col-md-4 col-md-offset-5">
    <input type="submit" value="Exportar a excel" class="btn btn-primary" onclick=this.form.action="{{ url('tables')}}/{{$id}}/{{'exportar'}}" > 
    </div>
  </div>
</div>
