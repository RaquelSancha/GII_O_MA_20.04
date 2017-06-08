
<?php $asterisco=0;?>

<table  class="table"  id="example" align="center" border="5" class="display nowrap" cellspacing="0" width="100%">
<div class="scrollbar" id="style-1">
      <div class="force-overflow"></div>

  @if($filtrado == "Meses")
    <thead >
      <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="12" align="center" bgcolor= "#60B664" style="color:White;">{{ $year }}</th>
        @endforeach
      </tr>

      <tr  bgcolor= "#01A556" style="color:White;">
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
    </thead>
    <tbody>
      @for ($l = 0; $l < count($ambitos); $l++)
        <tr>
          <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambitos[$l] }}
              <td colspan="{{12*count($years)}}" bgcolor="#000000" style="color:White;" ></td>
          </th>
        </tr>
        <tr>
        @for ($i = 0, $aux = 0; $i < count($categoria); $i++)
          
          @if(!(empty($supercategorias[$aux]->idSuperCategoria)))
            @if(!(empty($supercategorias[$aux])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux]->idSuperCategoria )
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux]->Name }}
                  <?php  $aux++; ?>
                      <td colspan="{{12*count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr>
              @endif  
            @endif
          @else
            @if(!(empty($supercategorias[$aux][0])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux][0]->idSuperCategoria)
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux][0]->Name }}
                    <?php
                      $aux++;
                      while ($supercategorias[$aux][0]->idSuperCategoria == $supercategorias[$aux-1][0]->idSuperCategoria){$aux++;} 
                    ?>
                      <td colspan="{{12*count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr> 
              @endif
            @endif
          @endif
          
          <th scope="row">{{ $categoria[$i] }}</th> 
          @for ($j = 0; $j < count($years); $j++)
            @for ($k = 0; $k < 12; $k++)   
              @if(empty( $values[$l][($i*count($years))+$j][$k][0]->valor ))
              <td>-</td>
              @else
              <td>{{ $values[$l][($i*count($years))+$j][$k][0]->valor }}</td>
              @endif
            @endfor
          @endfor
        </tr>  
        @endfor
      @endfor
    </tbody>
  @elseif($filtrado == "Trimestres")
   <thead >
      <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="4" align="center" bgcolor= "#60B664" style="color:White;">{{ $year}}</th>
        @endforeach
      </tr>

      <tr  bgcolor= "#01A556" style="color:White;">
        @foreach($years as $year)
        <th scope="col">I TRI</th>
        <th scope="col">II TRI</th>
        <th scope="col">III TRI</th>
        <th scope="col">IV TRI</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
    @for ($l = 0; $l < count($ambitos); $l++)
      <tr>
          <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambitos[$l] }}
              <td colspan="{{12*count($years)}}" bgcolor="#000000" style="color:White;" ></td>
          </th>
        </tr>
        <tr>
      <tr>
      @for ($i = 0, $aux = 0; $i < count($categoria); $i++)
                  @if(!(empty($supercategorias[$aux]->idSuperCategoria)))
            @if(!(empty($supercategorias[$aux])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux]->idSuperCategoria )
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux]->Name }}
                  <?php  $aux++; ?>
                      <td colspan="{{4*count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr>
              @endif  
            @endif
          @else
            @if(!(empty($supercategorias[$aux][0])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux][0]->idSuperCategoria)
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux][0]->Name }}
                    <?php
                      $aux++;
                      while ($supercategorias[$aux][0]->idSuperCategoria == $supercategorias[$aux-1][0]->idSuperCategoria){$aux++;} 
                    ?>
                      <td colspan="{{4*count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr> 
              @endif
            @endif
          @endif
        <th scope="row">{{$categoria[$i]}}</th> 
        @for ($j = 0; $j < count($years); $j++)
          @for ($k = 0; $k < 12; $k=$k+3) 
            @if(empty($values[$l][($i * count($years))+$j][$k][0]->valor))
              @if(empty($values[$l][($i * count($years))+$j][$k+1][0]->valor))
                @if(empty($values[$l][($i * count($years))+$j][$k+2][0]->valor))
                  <td>-*</td><?php $asterisco=1?>
                @else
                  <td>{{round(($values[$l][($i * count($years))+$j][$k+2][0]->valor)*100)/100}}*</td><?php $asterisco=1?>
                @endif
              @else
                @if(empty($values[$l][($i * count($years))+$j][$k+2][0]->valor))
                  <td>{{round(($values[$l][($i * count($years))+$j][$k+1][0]->valor)*100)/100}}*</td><?php $asterisco=1?>
                @else
                  <td>{{round(((($values[$l][($i * count($years))+$j][$k+2][0]->valor)+
                  ($values[$l][($i * count($years))+$j][$k+1][0]->valor))/2)*100)/100}}*</td><?php $asterisco=1?>
                @endif
              @endif
            @else  
              @if(empty($values[$l][($i * count($years))+$j][$k+1][0]->valor))
                @if(empty($values[$l][($i * count($years))+$j][$k+2][0]->valor))
                  <td>{{round(($values[$l][($i * count($years))+$j][$k][0]->valor)*100)/100}}*</td><?php $asterisco=1?>
                @else
                   <td>{{round(((($values[$l][($i * count($years))+$j][$k+2][0]->valor)+
                  ($values[$l][($i * count($years))+$j][$k][0]->valor))/2)*100)/100}}*</td><?php $asterisco=1?>
                @endif
              @else
                @if(empty($values[$l][($i * count($years))+$j][$k+2][0]->valor))
                  <td>{{round(((($values[$l][($i * count($years))+$j][$k+1][0]->valor)+
                  ($values[$l][($i * count($years))+$j][$k][0]->valor))/2)*100)/100}}*</td><?php $asterisco=1?> 
                @else 
                  <td>{{ round(((($values[$l][($i * count($years))+$j][$k][0]->valor)+
                  ($values[$l][($i * count($years))+$j][$k+1][0]->valor)+
                  ($values[$l][($i * count($years))+$j][$k+2][0]->valor))/3)*100)/100 }}</td>
                @endif
              @endif
            @endif
          @endfor
        @endfor
      </tr>  
      @endfor
    @endfor
    </tbody>

  @else
     <thead >
       <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="1" align="center" bgcolor= "#60B664" style="color:White;">{{ $year}}</th>
        @endforeach
      </tr>
    </thead>
     <tbody>
      @for ($l = 0; $l < count($ambitos); $l++)
      <tr>
          <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambitos[$l] }}
              <td colspan="{{12*count($years)}}" bgcolor="#000000" style="color:White;" ></td>
          </th>
        </tr>
        <tr>
      <tr>

        @for ($i = 0, $aux=0; $i < count($categoria); $i++)
          @if(!(empty($supercategorias[$aux]->idSuperCategoria)))
            @if(!(empty($supercategorias[$aux])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux]->idSuperCategoria )
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux]->Name }}
                  <?php  $aux++; ?>
                      <td colspan="{{count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr>
              @endif  
            @endif
          @else
            @if(!(empty($supercategorias[$aux][0])))
              @if($idsCategoria[$i][0]->idSuperCategoria == $supercategorias[$aux][0]->idSuperCategoria)
                <tr>
                  <th scope="row" bgcolor="#FFFFFF" style="color:Black;" >{{$supercategorias[$aux][0]->Name }}
                    <?php
                      $aux++;
                      while ($supercategorias[$aux][0]->idSuperCategoria == $supercategorias[$aux-1][0]->idSuperCategoria){$aux++;} 
                    ?>
                      <td colspan="{{count($years)}}" bgcolor="#FFFFFF" style="color:Black;" ></td>
                  </th>
                </tr> 
              @endif
            @endif
          @endif
        <th scope="row">{{$categoria[$i]}}</th> 
          @for ($j = 0; $j < count($years); $j++)
             <?php  $num=12;$total=0; ?>
            @for ($k = 0; $k < 12; $k++) 
              @if(!(empty($values[$l][($i * count($years))+$j][$k][0]->valor)))
                <?php $total=$total+ ($values[$l][($i * count($years))+$j][$k][0]->valor); ?>
              @else
                <?php $num--; ?>
              @endif
            @endfor
              @if($num==12)
              <td>{{round(($total/$num)*100)/100}}</td>
              @endif               
              @if($num == 0)
                @if($total == 0)
                   <td>-*</td><?php $asterisco=1?> 
                @endif
              @endif
              @if($num<12)
                @if(!($total==0))
                <td>{{round(($total/$num)*100)/100}}*</td><?php $asterisco=1?>
                @endif
              @endif

          @endfor
          </tr> 
        @endfor 
      @endfor
    </tbody>
  @endif
    </div>
</table>
<div id="wrapper">
    <div class="scrollbar" id="style-default">
      <div class="force-overflow"></div>
    </div>

    

<?php if($asterisco==1){echo "* Existen campos por rellenar";}?>
 