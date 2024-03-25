<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0fa4c9e4d0.js" crossorigin="anonymous"></script>
<script src="<?php echo URL;?>public_html/customjs/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el campo de fecha
    var fecha_ingreso = document.getElementById('fecha_ingreso');

    // Obtener la fecha actual en el formato YYYY-MM-DD
    var fechaActual = new Date().toISOString().split('T')[0];

    // Establecer la fecha actual en el campo de fecha
    fecha_ingreso.value = fechaActual;
  });
</script>


