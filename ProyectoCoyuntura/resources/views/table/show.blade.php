@extends('adminlte::layouts.app')
@section('main-content')

<h2><b>Tablas Predefinidas: </b>
@for($i=0; $i<count($nombre_variable);$i++)
    {{$nombre_variable[$i]->Nombre}}({{$nombre_variable[$i]->Tipo}})
    </h1><hr>
    {{$nombre_variable[$i]->Descripcion}}
    		
    <br><br>
    @include('table.table')
    <div align="left"><b>Fuente:</b> "{{$fuentes[$i]->Name}}"<div>
@endfor
<div align="right">
<a href="{{ url('tables')}}/{{$id}}/{{'edit'}}" class="btn btn-primary btn-lg active" role="button">Modificar Valores</a><br><br><br><br><br><br>
</div>




				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Datos del gráfico</h3>
                        <form id="surveyForm" method="post" class="form-horizontal" action="{{ url('tables')}}/{{$id}}">
                         {{ csrf_field() }}
                            <div class="form-group">
                              <label for="yearsForm" class="col-md-4 control-label"> Selecciona los años</label>
                              <div class="row">
                                    <div class="form-group form-group-options col-md-4 col-md-offset-5">
                                      <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick"  name="yearsForm[]" > 
                                        @foreach($years as $year)
                                        <option>{{$year}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="ambitosForm" class="col-md-4 control-label"> Selecciona los ámbitos geográficos</label>
                              <div class="row">
                                    <div class="form-group form-group-options col-md-4 col-md-offset-5">
                                      <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick"  name="ambitosForm[]"> 
                                        @foreach($ambitos as $ambito)
                                          <option>{{$ambito}}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="ambitosForm" class="col-md-4 control-label"> Selecciona la categorías</label>
                              <div class="row">
                                    <div class="form-group form-group-options col-md-4 col-md-offset-5">
                                     <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick"  name="categoriasForm[]" > 
                                      @if((count($supercategorias))>1)
                                        @for($i=0, $j=0 ;$i<count($categoria);$i++) 
                                            @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$j][0]->idSuperCategoria)
                                             <optgroup label="{{$supercategorias[$j][0]->Name}}" >
                                             <?php
                                              if ($idsCategoria[(count($categoria)-1)][0]->idSuperCategoria != $supercategorias[$j][0]->idSuperCategoria) {
                                                $j++;
                                              }else{
                                                $j=0;
                                              }
                                                ?>
                                            @endif
                                            <option>{{$categoria[$i]}}</option>
                                        @endfor
                                      @else
                                        <optgroup label="{{$supercategorias[0][0]->Name}}" >
                                        @for($i=0;$i<count($categoria);$i++) 
                                          <option>{{$categoria[$i]}}</option>
                                        @endfor
                                      @endif
                                    </select>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="yearsForm" class="col-md-4 control-label"> Selecciona el tipo de gráfico </label>
                              <div class="row">
                                    <div class="form-group form-group-options col-md-4 col-md-offset-5">
                                      <select data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick"  name="tipoGrafico" > 
                                   
                                        <option>Barras</option>
                                        <option>Lineas</option>

                                      </select>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                            <label for="submit" class="col-md-4 control-label"></label>
                              <div class="row">
                                <div class="form-group form-group-options col-md-4 col-md-offset-5">
                                  <input type="submit" value="Enviar datos!" class="btn btn-primary"  > 
                                </div>
                              </div>
                            </div>
                             {{ csrf_field() }}
                              <div class="form-group">
                                @foreach($categoria as $aux)
                                    <input type="hidden" name="categoria[]" value="{{$aux}}" />                        
                                @endforeach

                                @foreach($years as $aux)
                                    <input type="hidden" name="years[]" value="{{$aux}}" />
                                @endforeach

                                @foreach($ambitos as $aux)
                                    <input type="hidden" name="ambitos[]" value="{{$aux}}" />
                                @endforeach

                                <input type="hidden" name="filtrado" value="{{$filtrado}}" />
                               
                            </div>
                        </form>
                        @if(isset($ambitosForm))
                            @foreach($ambitosForm as $aux)
                                {{$aux}}
                            @endforeach
                        @endif
                        @if(isset($categoriasForm))
                            @foreach($categoriasForm as $aux)
                                {{$aux}}
                            @endforeach
                        @endif
                        @if(isset($yearsForm))
                            @foreach($yearsForm as $aux)
                                {{$aux}}
                            @endforeach
                        @endif
                        @if(isset($tipoGrafico))
                                {{$tipoGrafico}}
   
                        @endif
                        @foreach($valuesForm as $v)
                          @foreach($v as $v2)
                             @foreach($v2 as $v3)
                                @foreach($v3 as $v1)
                                    {{$v1->Valor}}
                                @endforeach
                            @endforeach
                          @endforeach
                        @endforeach
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
         			   <canvas id="myChart" height="40vh" width="80vw"></canvas>
       				 </div>

					<!-- /.box-body -->
				</div>
		

<script  type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    $(document).ready(function($categoriasForm,$yearsForm,$ambitosForm,$tipoGrafico,$valuesForm) {

    var ctx = document.getElementById("myChart");
                   
                     
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ["Enero ","Febrero ","Marzo ","Abril ","Mayo ","Junio ","Julio ","Agosto ","Septiembre ","Octubre ","Noviembre ","Diciembre "],
                                datasets: [
                                @for($l=0; $l<count($ambitosForm);$l++)
                                    @for($i=0 ; $i<count($categoriasForm);$i++)
                                         @for($j=0; $j<count($yearsForm);$j++)
                                                <?php $red =rand(0,255) ;$green =rand(0,255) ;$blue =rand(0,255); ?>
                                            {
                                                label: '{{$categoriasForm[$i]}} {{$yearsForm[$j]}} ({{$ambitosForm[$l]}})',

                                                
                                                data: [2
                                                       ],
                                                

                                                backgroundColor: [
                                                    @for($aux=0 ; $aux<12;$aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 0.2)",
                                                    @endfor

                                                ],
                                            },
                                        @endfor
                                    @endfor
                                @endfor]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]
                                }
                            }
                        });
});


</script>
@endsection
