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
