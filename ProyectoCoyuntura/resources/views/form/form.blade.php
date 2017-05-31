
  <div class="form-group">
      <label for="categoria" class="col-md-4 control-label">Selecciona las categorías a mostrar</label>
      <div class="col-md-2">
          <select multiple data-actions-box="true" data-width="auto" class="selectpicker show-tick"  name="categoria[]" >
            @for($i=0, $j=0 ;$i<count($categorias);$i++)
            @if(!(empty($supercategorias[$j])))
              @if($categorias[$i]->idSuperCategoria == $supercategorias[$j]->idSuperCategoria)
                 <optgroup label="{{$supercategorias[$j]->Name}}" >
                 <?php  $j++; ?>
              @endif
            @endif
            <option>{{$categorias[$i]->Nombre}}</option>
            @endfor
          </select>
      </div>
  </div>
  <div class="form-group">
      <label for="years" data-width="auto" class="col-md-4 control-label">Selecciona los años</label>
      <div class="col-md-2">
          <select class="selectpicker"  multiple data-actions-box="true" name="years[]">
            @foreach($years as $year)
            <option>{{$year->Year}}</option>
            @endforeach
          </select>
          
      </div>
  </div>
  
 <div class="form-group">
      <label for="ambitos" data-width="auto" class="col-md-4 control-label">Selecciona los ámbitos geográficos</label>
      <div class="col-md-2">
          <select class="selectpicker"   multiple data-actions-box="true" name="ambitos[]">
            @foreach($ambitos as $ambito)
            <option>{{$ambito->Nombre}}</option>
            @endforeach
          </select>
          
      </div>
  </div>
  
  <div class="form-group">
      <label for="filtrado" data-width="auto"  class="col-md-4 control-label">Selecciona cómo deseas filtrar los datos</label>
      <div class="col-md-2">
          <select class="selectpicker" name="filtrado">
            <option>Meses</option>
            <option disabled>Años</option>
            <option>Trimestres</option>
          </select>
      </div>
  </div>
  
  <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
         <input type="submit" value="Enviar datos!" class="btn btn-primary"  > 
      </div>
  </div>