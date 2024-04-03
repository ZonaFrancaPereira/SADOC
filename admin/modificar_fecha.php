<?php
require('seguridad.php');
$id_acpm = $_GET['id_acpm'];
$descripcion = $_GET['descripcion'];
$id_actividad = 0;
?>
<footer>
    <small class="bg-teal">SADOC 3.0 &copy; Copyright 2022, ZFIP SAS</small>
</footer>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

1
<?php require('footer.php'); ?>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('.select2').select2()

    });

    $('#modal-fecha_actividad').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #id_actividad').val(id_actividad);
    });
</script>
</body>

</html>