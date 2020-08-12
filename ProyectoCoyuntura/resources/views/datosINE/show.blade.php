@extends('adminlte::layouts.app')
@section('main-content')
<div class="table-responsive">
<table  class="table table-striped header-fixed"  id="tabla" align="center" border="5" class="display nowrap" cellspacing="0" width="50%">
   @if(!empty($años))
        <thead>
        <tr>
        <th scope="row"></th>
                @foreach($años as $año )
                <th colspan="{{count($periodos)}}" align="center" bgcolor= "#60B664" style="color:White;">{{ $año}}</th>
                @endforeach
        </tr>
            @if(array_key_exists('Periodo',$valores[0]['Datos'][0]))
            <tr  bgcolor= "#01A556" style="color:White;">
            <th></th>
                @foreach($años as $año)
                        @foreach($periodos as $periodo)
                            <td>{{ $periodo }}</td>
                        @endforeach
                @endforeach
            </tr>
        @endif
        </thead>
    @endif
    <tbody>
    @for($i=0 ; $i<count($valores) ; $i++ )
    <tr>
    <th bgcolor= "#01A556" style="color:White;">{{$valores[$i]['Nombre']}}</th>
      @for($j=0 ; $j<count($valores[$i]['Datos']) ; $j++ )
          <td  bgcolor="#FFFFFF" style="color:Black;" >{{ $valores[$i]['Datos'][$j]['Valor'] }}</td>
      @endfor
      </tr>
    @endfor
    </tbody>
    </table>
</div>
@endsection

 
