 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.content-wrapper -->
  <?php $year = date("Y"); ?>
  <footer class="main-footer">
    <strong>Copyright &copy; <?php echo $year; ?> <a href="https://zonafrancadepreira.com">Zona Franca Internacional de Pereira</a>.</strong>
  Todos los derechoss reservados.
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

<!-- CodeMirror -->
<script src="plugins/codemirror/codemirror.js"></script>
<script src="plugins/codemirror/mode/css/css.js"></script>
<script src="plugins/codemirror/mode/xml/xml.js"></script>
<script src="plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.js"></script>
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

<script src="dist/js/document.js"></script>
<script src="dist/js/acpm.js"></script>
<script src="dist/js/ordenes.js"></script>
<script src="dist/js/actividades.js"></script>
<script src="dist/js/evidencia_actividades.js"></script>
<script src="dist/js/ti.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script>
  $(function () {
    
    $("input[data-bootstrap-switch]").each(function(){
 
      $(this).bootstrapSwitch('state', $(this).prop('checked'));

    })

  })
  
</script>

<script>
  $(document).ready(function() {
    $("table.display").DataTable({

"language":{
  "sProcessing":     "Procesando...",
  "sLengthMenu":     "Mostrar _MENU_ registros",
  "sZeroRecords":    "No se encontraron resultados",
  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sSearch":         "Buscar:",
  "sInfoThousands":  ",",
  "sLoadingRecords": "Cargando...",
  "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
  },
  "oAria": {
    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
  },
  "buttons": {
    "copy": "Copiar",
    "colvis": "Visibilidad"
  }
},
responsive:"true",
dom:"Bfrtilp",


"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],



"order":[[0,'desc']],
autoWidth: true

});

  });
</script>



<script>
    // Función para actualizar la suma total
    function actualizarSuma() {
    var filas = document.getElementById('tabla').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    var sumaTotal = 0;

    // Itera sobre cada fila y suma los valores de los campos
    for (var i = 0; i < filas.length; i++) {
      var cantidad = parseFloat(filas[i].getElementsByClassName('cantidad_orden')[0].value) || 0;
      var valorNeto = parseFloat(filas[i].getElementsByClassName('valor_neto')[0].value) || 0;
      var valorIva = parseFloat(filas[i].getElementsByClassName('valor_iva')[0].value) || 0;

      // Realiza la suma
      var total = cantidad * valorNeto + valorIva;
      sumaTotal += total;

      // Actualiza el valor en la columna 'Total'
      filas[i].getElementsByClassName('valor_total')[0].value = total.toFixed(0);
      
    }

    // Actualiza el valor del input de suma total
    document.getElementById('sumaTotal').value = sumaTotal.toFixed(0);
    }
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
      actualizarSuma(); // Actualiza la suma después de eliminar la fila

    });
    /*=============================================
    Evento que selecciona la fila y la elimina 
    =============================================*/
    $(document).on("click", ".eliminar", function() {
      var parent = $(this).parents().get(0);
      $(parent).remove();
      sumarTotalPrecios()
      actualizarSuma(); // Actualiza la suma después de eliminar la fila


    });
  });
</script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<script>
  $(document).ready(function() {
    // Inicializa Quill en el contenedor
    var quill = new Quill('.quill-content', {
      theme: 'snow'
    });

    // Actualiza el contenido del textarea cuando cambia Quill
    quill.on('text-change', function() {
      $('.editor').val(quill.root.innerHTML);
    });
  });
</script>

<script>
   $(function() {

     'use strict';

     var ticksStyle = {
       fontColor: '#FFFFFF',
       fontStyle: 'bold',
     };

     var mode = 'index';
     var intersect = true;

     var $salesChart = $('#sales-chart');
     // eslint-disable-next-line no-unused-vars
     var salesChart = new Chart($salesChart, {
       type: 'bar',
       data: {
         labels: ['Meta (2 Mejora - 1 Preventiva)', 'Auditoria Interna', 'Auditoria Externa'],
         datasets: [{
             label: 'Acciones Correctivas',
             backgroundColor: '#FF6060',
             borderColor: '#FF6060',

             data: [
               <?php
                $total_correctiva_c = 0;
                $total_correctiva_ai = 0;
                $total_correctiva_ae = 0;
                foreach ($conn->query("SELECT
          (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
           WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'Otros'  AND a.id_usuario_fk = '$id_usuario_fk ') AS total_correctiva_otros,
          
          (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
           WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'AI'  AND a.id_usuario_fk = '$id_usuario_fk') AS total_correctiva_ai,
          
          (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
           WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'AE'  AND a.id_usuario_fk = '$id_usuario_fk') AS total_correctiva_ae
        ") as $row) { {
                    $total_correctiva_otros = $row["total_correctiva_otros"];
                    $total_correctiva_ai = $row["total_correctiva_ai"];
                    $total_correctiva_ae = $row["total_correctiva_ae"];
                  }
                }
                ?> '<?php echo $total_correctiva_otros; ?>', '<?php echo $total_correctiva_ai; ?>', '<?php echo $total_correctiva_ae; ?>'

             ],
           },
           {
             label: 'Acciones Correctivas Realizadas',
             backgroundColor: '#dc3545',
             borderColor: '#dc3545',

             data: [
               <?php
                $total_correctiva_cr = 0;
                $total_correctiva_air = 0;
                $total_correctiva_aer = 0;

                foreach ($conn->query("SELECT
      (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
       WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'Otros' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk ') AS total_correctiva_otrosr,
      
      (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
       WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'AI' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_correctiva_air,
      
      (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
       WHERE a.tipo_acpm = 'AC' AND a.fuente_acpm = 'AE' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_correctiva_aer
    ") as $row) {
                  $total_correctiva_otrosr = $row["total_correctiva_otrosr"];
                  $total_correctiva_air = $row["total_correctiva_air"];
                  $total_correctiva_aer = $row["total_correctiva_aer"];
                }
                ?> '<?php echo $total_correctiva_otrosr; ?>',
               '<?php echo $total_correctiva_air; ?>',
               '<?php echo $total_correctiva_aer; ?>'
             ],

           },
           {
             label: 'Acciones Preventivas',
             backgroundColor: '#FEE960',
             borderColor: '#FEE960',

             data: [
               <?php
                $total_preventivas_m = 0;
                $total_preventivas_ai = 0;
                $total_preventivas_ae = 0;

                foreach ($conn->query("SELECT
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'Otros' AND a.id_usuario_fk = '$id_usuario_fk ') AS total_preventivas_m,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'AI' AND a.id_usuario_fk = '$id_usuario_fk') AS total_preventivas_ai,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'AE' AND a.id_usuario_fk = '$id_usuario_fk') AS total_preventivas_ae
                ") as $row) {
                  $total_preventivas_m = $row["total_preventivas_m"];
                  $total_preventivas_ai = $row["total_preventivas_ai"];
                  $total_preventivas_ae = $row["total_preventivas_ae"];
                }
                ?> '<?php echo $total_preventivas_m; ?>',
               '<?php echo $total_preventivas_ai; ?>',
               '<?php echo $total_preventivas_ae; ?>'
             ],
           },
           {
             label: 'Acciones Preventivas Realizadas',
             backgroundColor: '#ffc107',
             borderColor: '#ffc107',
            
             data: [
               <?php
                $total_preventivas_mr = 0;
                $total_preventivas_air = 0;
                $total_preventivas_aer = 0;

                foreach ($conn->query("SELECT
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'Otros' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk ') AS total_preventivas_mr,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'AI' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_preventivas_air,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AP' AND a.fuente_acpm = 'AE' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_preventivas_aer
                ") as $row) {
                  $total_preventivas_mr = $row["total_preventivas_mr"];
                  $total_preventivas_air = $row["total_preventivas_air"];
                  $total_preventivas_aer = $row["total_preventivas_aer"];
                }
                ?> 
                '<?php echo $total_preventivas_mr; ?>',
               '<?php echo $total_preventivas_air; ?>',
               '<?php echo $total_preventivas_aer; ?>'
             ],
           },
           {
             label: 'Acciones de Mejora',
             backgroundColor: '#71FE60',
             borderColor: '#71FE60',
                      
             data: [
               <?php
                $total_mejora_m = 0;
                $total_mejora_ai = 0;
                $total_mejora_ae = 0;

                foreach ($conn->query("SELECT
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'Otros'  AND a.id_usuario_fk = '$id_usuario_fk ') AS total_mejora_m,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'AI'  AND a.id_usuario_fk = '$id_usuario_fk') AS total_mejora_ai,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'AE'  AND a.id_usuario_fk = '$id_usuario_fk') AS total_mejora_ae
                ") as $row) {
                  $total_mejora_m = $row["total_mejora_m"];
                  $total_mejora_ai = $row["total_mejora_ai"];
                  $total_mejora_ae = $row["total_mejora_ae"];
                }
                ?> 
                '<?php echo $total_mejora_m; ?>',
               '<?php echo $total_mejora_ai; ?>',
               '<?php echo $total_mejora_ae; ?>'
             ],
           },
           {
             label: 'Acciones de Mejora Realizadas',
             backgroundColor: '#28a745',
             borderColor: '#28a745',
                    
             data: [
               <?php
                 $total_mejora_mr = 0;
                 $total_mejora_air = 0;
                 $total_mejora_aer = 0;

                foreach ($conn->query("SELECT
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'Otros' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk ') AS total_mejora_mr,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'AI' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_mejora_air,
                
                (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                WHERE a.tipo_acpm = 'AM' AND a.fuente_acpm = 'AE' AND a.estado_acpm='Cerrada' AND a.id_usuario_fk = '$id_usuario_fk') AS total_mejora_aer
                ") as $row) {
                  $total_mejora_mr = $row["total_mejora_mr"];
                  $total_mejora_air = $row["total_mejora_air"];
                  $total_mejora_aer = $row["total_mejora_aer"];
                }
                ?> 
                '<?php echo $total_mejora_mr; ?>',
               '<?php echo $total_mejora_air; ?>',
               '<?php echo $total_mejora_aer; ?>'
             ],
           },
         ],
       },
       options: {
         maintainAspectRatio: false,
         tooltips: {
           mode: mode,
           intersect: intersect,
         },
         hover: {
           mode: mode,
           intersect: intersect,
         },
         legend: {
           display: true,
         },
         scales: {
           yAxes: [{
             gridLines: {
               display: true,
               lineWidth: '4px',
               color: 'rgba(0, 0, 0, .1)',
               zeroLineColor: 'transparent',
             },
             ticks: $.extend({
                 beginAtZero: true,
                 max: 10,
                 stepSize: 1,
               },
               ticksStyle
             ),
           }, ],
           xAxes: [{
             display: true,
             gridLines: {
               display: false,
             },
             ticks: ticksStyle,
           }, ],
         },
       },

       plugins: {
      datalabels: {},
    },
    // Agregar etiquetas manualmente
    plugins: [{
      afterDatasetsDraw: function(chart) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function(dataset, datasetIndex) {
          var meta = chart.getDatasetMeta(datasetIndex);
          if (!meta.hidden) {
            meta.data.forEach(function(element, index) {
              var model = element._model;
              var yPos = model.y - 10; // Ajusta la posición vertical de la etiqueta
              ctx.fillStyle = '#FFFFFF';
              ctx.font = ticksStyle.fontStyle + ' ' + ticksStyle.fontColor;
              ctx.fillText(dataset.data[index], model.x, yPos);
            });
          }
        });
      }
    }]
     });
   });
 </script>
<script>
  $(function() {
    'use strict';

    var ticksStyle = {
      fontColor: '#FFFFFF',
      fontStyle: 'bold',
    };

    var mode = 'index';
    var intersect = true;

    var $salesChart = $('#seguimiento_acpm');
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: ['Seguimiento Gestión ACPM <?php echo $_SESSION["nombre_proceso"]?>'],
        datasets: [{
            label: 'Cerradas',
            backgroundColor: '#28a745',
             borderColor: '#28a745',
            data: [
              <?php
                $acpm_cerrada = 0;
                foreach ($conn->query("SELECT
                  (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                   WHERE a.estado_acpm = 'Cerrada'  AND a.id_usuario_fk = '$id_usuario_fk ') AS acpm_cerrada
                ") as $row) {
                  $acpm_cerrada = $row["acpm_cerrada"];
                }
                echo $acpm_cerrada;
              ?>
            ],
          },
          {
            label: 'Abiertas con Tiempo',
            backgroundColor: '#FFD700',
            borderColor: '#FFD700',
            data: [
              <?php
              $fecha_actual = date('Y-m-d');
              $fecha_limite = date('Y-m-d', strtotime('+10 days', strtotime($fecha_actual)));
                $tiempo_vencimiento = 0;
                foreach ($conn->query("SELECT
                  (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                   WHERE a.fecha_finalizacion >= '$fecha_limite' AND a.id_usuario_fk = '$id_usuario_fk') AS tiempo_vencimiento
                ") as $row) {
                  $tiempo_vencimiento = $row["tiempo_vencimiento"];
                }
                echo $tiempo_vencimiento;
              ?>
            ],
          },
          {
            label: 'Vencidas',
            backgroundColor: '#dc3545',
             borderColor: '#dc3545',
            data: [
              <?php
              $fecha_actual = date('Y-m-d');
              $fecha_limite = date('Y-m-d', strtotime('-10 days', strtotime($fecha_actual)));
                $vencidas = 0;
                foreach ($conn->query("SELECT
                  (SELECT COUNT(*) FROM acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id_usuario
                   WHERE a.fecha_finalizacion <= '$fecha_limite' AND a.id_usuario_fk = '$id_usuario_fk') AS vencidas
                ") as $row) {
                  $vencidas = $row["vencidas"];
                }
                echo $vencidas;
              ?>
            ],
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect,
        },
        hover: {
          mode: mode,
          intersect: intersect,
        },
        legend: {
          display: true,
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .1)',
              zeroLineColor: 'transparent',
            },
            ticks: $.extend({
                beginAtZero: true,
                max: 10,
                stepSize: 1,
              },
              ticksStyle
            ),
          }, ],
          xAxes: [{
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          }, ],
        },
      },

      plugins: {
        datalabels: {},
      },
      // Agregar etiquetas manualmente
      plugins: [{
        afterDatasetsDraw: function(chart) {
          var ctx = chart.ctx;

          chart.data.datasets.forEach(function(dataset, datasetIndex) {
            var meta = chart.getDatasetMeta(datasetIndex);
            if (!meta.hidden) {
              meta.data.forEach(function(element, index) {
                var model = element._model;
                var yPos = model.y - 10; // Ajusta la posición vertical de la etiqueta
                ctx.fillStyle = '#FFFFFF';
                ctx.font = ticksStyle.fontStyle + ' ' + ticksStyle.fontColor;
                ctx.fillText(dataset.data[index], model.x, yPos);
              });
            }
          });
        }
      }]
    });
  });
</script>
