<table>
<th>@foreach($nombreVariable as $nom)
{{$nom->Nombre}}
@endforeach
</th>
      <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="12">{{ $year->Year}}</th>
        @endforeach
      </tr>

      <tr>
        @foreach($years as $year)
        <th scope="col">Ene</th>
        <th scope="col">Feb</th>
        <th scope="col">Mar</th>
        <th scope="col">Abr</th>
        <th scope="col">May</th>
        <th scope="col">Jun</th>
        <th scope="col">Jul</th>
        <th scope="col">Ago</th>
        <th scope="col">Sep</th>
        <th scope="col">Oct</th>
        <th scope="col">Nov</th>
        <th scope="col">Dic</th>
        @endforeach
      </tr>
 
      @for ($l = 0; $l < count($ambitos); $l++)
        <tr>
           <th scope="row">{{$ambitos[$l]->Nombre }}</th>
        </tr>
      <tr>
        @if((count($supercategorias))>1)
          @for ($i = 0, $aux = 0; $i < count($categoria); $i++)
            @if(!(empty($supercategorias[$aux])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux]->idSuperCategoria)
                <tr>
                <th scope="rowgroup" >{{$supercategorias[$aux]->Name }}</th>
                    <?php
                    if ($idsCategoria[(count($idsCategoria)-1)][0]->idSuperCategoria != $supercategorias[$aux]->idSuperCategoria) {
                         $aux++;
                    }else{
                        $aux=0;
                    }
                      ?>
                      <th colspan="{{12*count($years)}}" ></th>
                </tr>
                @endif
            @endif
            <tr>
          <th scope="row">{{$categoria[$i]->Nombre}}</th> 
  	        @for ($j = 0; $j < count($years); $j++)
  	          @for ($k = 0; $k < 12; $k++)   
  	            @if(empty($values[$l][($i * count($years))+$j][$k][0]->valor))
  	            	  <td >-</td>
  	            @else
  	            	<td >{{$values[$l][($i * count($years))+$j][$k][0]->valor}}</td>
  	            @endif
  	          @endfor
  	        @endfor   
            </tr> 
        	@endfor
        @else
          <tr>
            <th scope="row">{{$supercategorias[0]->Name }}</th>
                <th colspan="{{12*count($years)}}"></th>
          </tr>
          @for ($i = 0, $aux = 0; $i < count($categoria); $i++)
          <tr>
          <th scope="row">{{$categoria[$i]->Nombre}}</th> 
              @for ($j = 0; $j < count($years); $j++)
                @for ($k = 0; $k < 12; $k++)   
                  @if(empty($values[$l][($i * count($years))+$j][$k][0]->valor))
                      <td >-</td>
                  @else
                    <td >{{$values[$l][($i * count($years))+$j][$k][0]->valor}}</td>
                  @endif
                @endfor
              @endfor   
              </tr>
          @endfor  
        @endif
        <tr></tr>
      @endfor
</table>

              