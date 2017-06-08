<head>
    <meta charset="UTF-8">
    <title> Proyecto Coyuntura </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{URL::asset('js/Chart.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/Chart.bundle.min.js')}}"></script>
     <script type="text/javascript" src="{{URL::asset('js/jquery-3.2.1.min.js')}}"></script>
       <!-- Datatables -->
    <link href="{{URL::asset('css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">
    <script src="{{URL::asset('js/datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <!--select2-->
    <style type="text/css">   
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance:textfield;
        }
        div.contiene_tabla, div.contiene_tabla2 {

        header
{
    font-family: 'Lobster', cursive;
    text-align: center;
    font-size: 25px;    
}

#info
{
    font-size: 18px;
    color: #555;
    text-align: center;
    margin-bottom: 25px;
}

a{
    color: #074E8C;
}

.scrollbar
{
    margin-left: 30px;
    float: left;
    height: 300px;
    width: 65px;
    background: #F5F5F5;
    overflow-y: scroll;
    margin-bottom: 25px;
}

.force-overflow
{
    min-height: 450px;
}

#wrapper
{
    text-align: center;
    width: 500px;
    margin: auto;
}

/*
 *  STYLE 1
 */

#style-1::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
    background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

#style-1::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

/*
 *  STYLE 2
 */

#style-2::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
    background-color: #F5F5F5;
}

#style-2::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

#style-2::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #D62929;
}

/*
 *  STYLE 3
 */

#style-3::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#style-3::-webkit-scrollbar
{
    width: 6px;
    background-color: #F5F5F5;
}

#style-3::-webkit-scrollbar-thumb
{
    background-color: #000000;
}

/*
 *  STYLE 4
 */

#style-4::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#style-4::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-4::-webkit-scrollbar-thumb
{
    background-color: #000000;
    border: 2px solid #555555;
}


/*
 *  STYLE 5
 */

#style-5::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#style-5::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-5::-webkit-scrollbar-thumb
{
    background-color: #0ae;
    
    background-image: -webkit-gradient(linear, 0 0, 0 100%,
                       color-stop(.5, rgba(255, 255, 255, .2)),
                       color-stop(.5, transparent), to(transparent));
}


/*
 *  STYLE 6
 */

#style-6::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#style-6::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-6::-webkit-scrollbar-thumb
{
    background-color: #F90; 
    background-image: -webkit-linear-gradient(45deg,
                                              rgba(255, 255, 255, .2) 25%,
                                              transparent 25%,
                                              transparent 50%,
                                              rgba(255, 255, 255, .2) 50%,
                                              rgba(255, 255, 255, .2) 75%,
                                              transparent 75%,
                                              transparent)
}


/*
 *  STYLE 7
 */

#style-7::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    border-radius: 10px;
}

#style-7::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-7::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-image: -webkit-gradient(linear,
                                       left bottom,
                                       left top,
                                       color-stop(0.44, rgb(122,153,217)),
                                       color-stop(0.72, rgb(73,125,189)),
                                       color-stop(0.86, rgb(28,58,148)));
}

/*
 *  STYLE 8
 */

#style-8::-webkit-scrollbar-track
{
    border: 1px solid black;
    background-color: #F5F5F5;
}

#style-8::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-8::-webkit-scrollbar-thumb
{
    background-color: #000000;  
}


/*
 *  STYLE 9
 */

#style-9::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

#style-9::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-9::-webkit-scrollbar-thumb
{
    background-color: #F90; 
    background-image: -webkit-linear-gradient(90deg,
                                              rgba(255, 255, 255, .2) 25%,
                                              transparent 25%,
                                              transparent 50%,
                                              rgba(255, 255, 255, .2) 50%,
                                              rgba(255, 255, 255, .2) 75%,
                                              transparent 75%,
                                              transparent)
}


/*
 *  STYLE 10
 */

#style-10::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    border-radius: 10px;
}

#style-10::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-10::-webkit-scrollbar-thumb
{
    background-color: #AAA;
    border-radius: 10px;
    background-image: -webkit-linear-gradient(90deg,
                                              rgba(0, 0, 0, .2) 25%,
                                              transparent 25%,
                                              transparent 50%,
                                              rgba(0, 0, 0, .2) 50%,
                                              rgba(0, 0, 0, .2) 75%,
                                              transparent 75%,
                                              transparent)
}


/*
 *  STYLE 11
 */

#style-11::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
    border-radius: 10px;
}

#style-11::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-11::-webkit-scrollbar-thumb
{
    background-color: #3366FF;
    border-radius: 10px;
    background-image: -webkit-linear-gradient(0deg,
                                              rgba(255, 255, 255, 0.5) 25%,
                                              transparent 25%,
                                              transparent 50%,
                                              rgba(255, 255, 255, 0.5) 50%,
                                              rgba(255, 255, 255, 0.5) 75%,
                                              transparent 75%,
                                              transparent)
}

/*
 *  STYLE 12
 */

#style-12::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.9);
    border-radius: 10px;
    background-color: #444444;
}

#style-12::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

#style-12::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #D62929;
    background-image: -webkit-linear-gradient(90deg,
                                              transparent,
                                              rgba(0, 0, 0, 0.4) 50%,
                                              transparent,
                                              transparent)
}

/*
 *  STYLE 13
 */

#style-13::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.9);
    border-radius: 10px;
    background-color: #CCCCCC;
}

#style-13::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

#style-13::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #D62929;
    background-image: -webkit-linear-gradient(90deg,
                                              transparent,
                                              rgba(0, 0, 0, 0.4) 50%,
                                              transparent,
                                              transparent)
}

/*
 *  STYLE 14
 */

#style-14::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.6);
    background-color: #CCCCCC;
}

#style-14::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-14::-webkit-scrollbar-thumb
{
    background-color: #FFF;
    background-image: -webkit-linear-gradient(90deg,
                                              rgba(0, 0, 0, 1) 0%,
                                              rgba(0, 0, 0, 1) 25%,
                                              transparent 100%,
                                              rgba(0, 0, 0, 1) 75%,
                                              transparent)
}

/*
 *  STYLE 15
 */

#style-15::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
    background-color: #F5F5F5;
    border-radius: 10px;
}

#style-15::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-15::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #FFF;
    background-image: -webkit-gradient(linear,
                                       40% 0%,
                                       75% 84%,
                                       from(#4D9C41),
                                       to(#19911D),
                                       color-stop(.6,#54DE5D))
}

/*
 *  STYLE 16
 */

#style-16::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
    background-color: #F5F5F5;
    border-radius: 10px;
}

#style-16::-webkit-scrollbar
{
    width: 10px;
    background-color: #F5F5F5;
}

#style-16::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    background-color: #FFF;
    background-image: -webkit-linear-gradient(top,
                                              #e4f5fc 0%,
                                              #bfe8f9 50%,
                                              #9fd8ef 51%,
                                              #2ab0ed 100%);
}


    </style>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>
</head>
