
@foreach($years as $year)
            {{ $year}}
@endforeach
@foreach($categoria as $cat)
            {{$cat}}
@endforeach


<table  class="table table-striped"  align="center" border="5">
    <thead >
    <tr>
      <th rowspan="2"></th>
      @foreach($years as $year)
      <th colspan="12" align="center" bgcolor= "#60B664" style="color:White;">{{ $year}}</th>
      @endforeach
    </tr>


    <tr  bgcolor= "#01A556" style="color:White;">
      @foreach($years as $year)
      <th scope="col">Enero</th>
      <th scope="col">Febrero</th>
      <th scope="col">Marzo</th>
      <th scope="col">Abril</th>
      <th scope="col">Mayo</th>
      <th scope="col">Junio</th>
      <th scope="col">Julio</th>
      <th scope="col">Agosto</th>
      <th scope="col">Septiembre</th>
      <th scope="col">Octubre</th>
      <th scope="col">Noviembre</th>
      <th scope="col">Diciembre</th>
      @endforeach
    </tr>

  </thead>
  <tbody>
  
    @foreach($categoria as $cat)
    <tr >
      <th scope="row">{{$cat}}</th>
          @foreach($years as $year)
            @for ($j = 0; $j < 12; $j++)
              <td>-</td>
            @endfor
          @endforeach
      @endforeach
    </tr>

  </tbody>

</table>
 