 <!-- jQuery 3 -->
 <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button);
 </script>
 <!-- Bootstrap 3.3.7 -->
 <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

 <script type="text/javascript">
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 </script>
