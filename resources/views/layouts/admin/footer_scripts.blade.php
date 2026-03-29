<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
</script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- Nepali Date Picker-->
<script src="{{ asset('plugins/nepali.datepicker/nepali.datepicker.min.js') }}"></script>

@yield('js')

<script type="text/javascript">
    $('#deleteModal').on('show.bs.modal', function(event) {
        var delRoute = $(event.relatedTarget).data('route');
        $("#delForm").attr('action', delRoute);
    });
</script>

<script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script>

@if (Session::has('success'))
    <script type="text/javascript">
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif

@if (Session::has('error'))
    <script type="text/javascript">
        toastr.error("{{ Session::get('error') }}");
    </script>
@endif

@if (Session::has('warning'))
    <script type="text/javascript">
        toastr.warning("{{ Session::get('warning') }}");
    </script>
@endif

@if (Session::has('info'))
    <script type="text/javascript">
        toastr.info("{{ Session::get('info') }}");
    </script>
@endif
