<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.2.0
  </div>
</footer>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="dist/js/document.js"></script>
<script src="dist/js/acpm.js"></script>

<script>
  $(document).ready(function() {
    $('.display').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "order": [
        [1, "asc"]
      ]
    });

  });
</script>

<script>
  $(document).ready(function() {
    $('#table_id').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
      },
      "order": [
        [1, "asc"]
      ]
    });
  });
</script>
<script>
  /*=============================================
     Suma todos los valores de la tabla
     =============================================*/
  function sumarTotalPrecios() {

    var precioItem = $(".valor_total");

    var arraySumaPrecio = [];

    for (var i = 0; i < precioItem.length; i++) {

      arraySumaPrecio.push(Number($(precioItem[i]).val()));


    }

    function sumaArrayPrecios(total, numero) {

      return total + numero;

    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

    $("#totalOrden").val(sumaTotalPrecio);
    $("#totalOrden").attr("total", sumaTotalPrecio);

  }

    /*=============================================
     MODIFICAR EL TOTAL PAGADO
     =============================================*/
     $(".formularioCompra").on("change", "input.valor_total", function () {
      sumarTotalPrecios()
      
    })
  $(function() {
    /*=============================================
     Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
     =============================================*/
    $("#adicional").on('click', function() {
      $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
      sumarTotalPrecios()

    });
    /*=============================================
    Evento que selecciona la fila y la elimina 
    =============================================*/
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
      sumarTotalPrecios()


    });
  });
</script>