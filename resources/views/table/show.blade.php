@extends('adminlte::layouts.app')
@section('main-content')

<h2><b>Tablas Predefinidas: </b>
@for($i=0; $i<count($nombre_variable);$i++)
    {{$nombre_variable[$i]->Nombre}}({{$nombre_variable[$i]->Tipo}})
    </h1><hr>
    {{$nombre_variable[$i]->Descripcion}}
    		
    <br><br>
    <div id="table_wrapper">
    @include('table.table')
    </div>
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
                      <select multiple data-actions-box="true" data-live-search="true" data-width="auto"  class="selectpicker show-tick dropup"  name="yearsForm[]" title="" required> 
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
                      <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup" name="ambitosForm[]" title="" required> 
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
                     <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup" name="categoriasForm[]" title="" required> 
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
                      <select data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup"  name="tipoGrafico" > 
                   
                        <option value="bar">Barras</option>
                        <option value="line">Lineas</option>
                        <option value="radar">Radar</option>
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
		
	</div>
	<div class="box-body">
		   <canvas id="myChart" height="40vh" width="80vw"></canvas>
		 </div>

	<!-- /.box-body -->
</div>


<script  type="text/javascript">
   
    $(document).ready(function($categoriasForm,$yearsForm,$ambitosForm,$tipoGrafico,$valuesForm,$filtrado) {

    var ctx = document.getElementById("myChart");
    
                        var myChart = new Chart(ctx, {
                            <?php if($filtrado=="Meses"){ ?>

                            type: '{{$tipoGrafico}}',
                            data: {
                                labels: ["Enero ","Febrero ","Marzo ","Abril ","Mayo ","Junio ","Julio ","Agosto ","Septiembre ","Octubre ","Noviembre ","Diciembre "],
                                datasets: [
                                @for($l=0; $l<count($ambitosForm);$l++)
                                    @for($i=0 ; $i<count($categoriasForm);$i++)
                                         @for($j=0; $j<count($yearsForm);$j++)
                                                <?php $red =rand(0,255) ;$green =rand(0,255) ;$blue =rand(0,255); ?>
                                            {
                                                label: '{{$categoriasForm[$i]}} {{$yearsForm[$j]}} ({{$ambitosForm[$l]}})',

                                                
                                                data: [
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                 ],
                                                
                                                 borderColor: [
                                                    @for($aux=0 ; $aux<12 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 1)",
                                                    @endfor

                                                ],
                                                backgroundColor: [
                                                    @for($aux=0 ; $aux<12 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 0.2)",
                                                    @endfor

                                                ],
                                            },
                                        @endfor
                                    @endfor
                                @endfor]
                           

                      
                            },
                             <?php }elseif($filtrado=='Trimestres'){ ?>
                                type: '{{$tipoGrafico}}',
                                data: {
                                labels: ["I TRI","II TRI","III TRI","IV TRI"],
                                datasets: [
                                @for($l=0; $l<count($ambitosForm);$l++)
                                    @for($i=0 ; $i<count($categoriasForm);$i++)
                                         @for($j=0; $j<count($yearsForm);$j++)
                                                <?php $red =rand(0,255) ;$green =rand(0,255) ;$blue =rand(0,255); ?>
                                            {
                                                label: '{{$categoriasForm[$i]}} {{$yearsForm[$j]}} ({{$ambitosForm[$l]}})',

                                                
                                                data: [
                                                <?php $suma=0; $total=3;?>
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor)))
                                                    <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor+$suma; ?>
                                                @else
                                                    <?php  $total=$total-1; ?>
                                                @endif

                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif

                                                @if($total==0)
                                                    ,
                                                @else
                                                    {{round(($suma/$total)*100)/100}},
                                                @endif

                                                 <?php $suma=0; $total=3;?>
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor)))
                                                    <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor+$suma; ?>
                                                @else
                                                    <?php  $total=$total-1; ?>
                                                @endif

                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif

                                                @if($total==0)
                                                    ,
                                                @else
                                                    {{round(($suma/$total)*100)/100}},
                                                @endif
                                                 <?php $suma=0; $total=3;?>
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor)))
                                                    <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor+$suma; ?>
                                                @else
                                                    <?php  $total=$total-1; ?>
                                                @endif

                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif

                                                @if($total==0)
                                                    ,
                                                @else
                                                    {{round(($suma/$total)*100)/100}},
                                                @endif
                                                 <?php $suma=0; $total=3;?>
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor)))
                                                    <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor+$suma; ?>
                                                @else
                                                    <?php  $total=$total-1; ?>
                                                @endif

                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor)))
                                                    <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor+$suma; ?>
                                                @else
                                                    <?php $total=$total-1; ?>
                                                @endif

                                                @if($total==0)
                                                    ,
                                                @else
                                                    {{round(($suma/$total)*100)/100}},
                                                @endif
                                                 ],
                                                
                                                 borderColor: [
                                                    @for($aux=0 ; $aux<4 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 1)",
                                                    @endfor

                                                ],
                                                backgroundColor: [
                                                    @for($aux=0 ; $aux<4 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 0.2)",
                                                    @endfor

                                                ],
                                            },
                                        @endfor
                                    @endfor
                                @endfor]
                            },
                            <?php }else{ ?>
                                type: '{{$tipoGrafico}}',
                                data: {

                                labels: [
                                @foreach($yearsForm as $year)
                                 "{{$year}}",
                                @endforeach 
                                ],
                                datasets: [
                                @for($l=0; $l<count($ambitosForm);$l++)
                                    @for($i=0 ; $i<count($categoriasForm);$i++)
                                                <?php $red =rand(0,255) ;$green =rand(0,255) ;$blue =rand(0,255); ?>
                                            {
                                                label: '{{$categoriasForm[$i]}} ({{$ambitosForm[$l]}})',

                                                
                                                data: [

                                                @for($j=0; $j<count($yearsForm);$j++)
                                                    <?php $suma=0; $total=12;?>
                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor)))
                                                        <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor+$suma; ?>
                                                    @else
                                                        <?php  $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif
                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor)))
                                                        <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor+$suma; ?>
                                                    @else
                                                        <?php  $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor)))
                                                        <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor+$suma; ?>
                                                    @else
                                                        <?php  $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif
                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor)))
                                                        <?php  $suma=$valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor+$suma; ?>
                                                    @else
                                                        <?php  $total=$total-1; ?>
                                                    @endif

                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif
                                                    @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor)))
                                                        <?php $suma=$valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor+$suma; ?>
                                                    @else
                                                        <?php $total=$total-1; ?>
                                                    @endif

                                                    @if($total==0)
                                                        ,
                                                    @else
                                                        {{round(($suma/$total)*100)/100}} ,
                                                    @endif
                                                @endfor
                                                 ],
                                                
                                                 borderColor: [
                                                    @for($j=0; $j<count($yearsForm);$j++)
                                                        "rgba({{$red}},{{$green}},{{$blue}}, 1)",
                                                    @endfor
                                                ],
                                                backgroundColor: [
                                                     @for($j=0; $j<count($yearsForm);$j++)
                                                        "rgba({{$red}},{{$green}},{{$blue}}, 0.2)",
                                                    @endfor
                                                ],
                                            },
                                    @endfor
                                @endfor]
                            },

                            <?php }?>
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
