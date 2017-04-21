@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Tablón de anuncios</div>

                <div class="panel-body">
                    ¡Bienvenido!
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Prueba de la base de datos</div>
                    <div class="panel-body">

                        <?php
                        // Conectando, seleccionando la base de datos
                        $mysqli = new mysqli("localhost", "root", "", "bdcoyuntura");

                        /* comprobar la conexión */
                        if ($mysqli->connect_errno) {
                            printf("Falló la conexión: %s\n", $mysqli->connect_error);
                            exit();
                        }

                        /* Consultas de selección que devuelven un conjunto de resultados */
                        if ($resultado = $mysqli->query("SELECT * FROM variableambito where idvariable='1' and idambito = '1'")) {
                            printf("La selección devolvió %d filas.\n", $resultado->num_rows);
                            echo "<br />";
                            $resultado2 = $mysqli->query("SELECT descripcion FROM variable where idvariable='1'");
                            $resultado3 = $mysqli->query("SELECT nombre FROM ambito where idambito = '1'");
                            $varia = $resultado2->fetch_array();
                            $ambi = $resultado3->fetch_array();
                            echo $varia['descripcion'] . " en " . $ambi['nombre'];
                            echo "<br />"; 
                            while($row = $resultado->fetch_array())
                            {
                                echo $row['Mes'] . "/" . $row['Year'] . " |     " . $row['Valor'];
                                echo "<br />";
                            }

                            /* liberar el conjunto de resultados */
                            $resultado->close();
                        }
                        $mysqli->close();
                        ?>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Prueba con la insercion de imagenes.</div>

                <div class="panel-body">
                    <img src="http://media.lea-noticias.com/wp-content/uploads/2013/03/arcoiris-horizontal-raro.jpg" align="middle"> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
