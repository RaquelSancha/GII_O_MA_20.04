@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">lista usuarios</div>

                    <div class="panel-body">
                        <!-- lista de usuarioss-->
        <table id="example" class="table table-striped responsive-utilities jambo_table">
          <thead>
            <tr class="headings">
             
              <th>Nombre</th>  
              <th>Email</th>  
            </tr>
          </thead>

          <tbody>

           @foreach($lista as $user)

           <tr class="even pointer">                           
            <td class=" ">{{$user->name}}</td>  
            <td class=" ">{{$user->email}}</td>  
          </tr>
          
          @endforeach
          
        </tbody>

      </table>

                    </div>
            </div>
    </div>
</div>
    </div>
@endsection
