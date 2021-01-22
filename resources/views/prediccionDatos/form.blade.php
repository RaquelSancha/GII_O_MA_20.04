
<div class="form-group">
  <label for="ambitos" class="col-md-4 control-label"> Selecciona el ámbito geográfico</label>
  <div class="row">
        <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select data-live-search="true" data-width="auto" class="selectpicker show-tick dropup"  name="ambito" title="" required > 
            @foreach($ambitos as $ambito)
              <option>{{$ambito->Nombre}}</option>
            @endforeach
          </select>
      </div>
  </div>
</div>
<div class="form-group">
  <label for="categoria" class="col-md-4 control-label">Selecciona la categoría</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
        <select  data-live-search="true" data-width="auto" class="selectpicker show-tick dropup"  name="categoria" title="" required > 
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
      <input type="submit" value="Aceptar" class="btn btn-primary" onclick=this.form.action="{{ url('prediccionDatos/predecir')}}/{{$id}}" > 
    </div>
  </div>
</div>
