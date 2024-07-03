// JavaScript Document
$(document).ready(function () {
  VerCarreras();

  function VerCarreras() {
    $('#VerCarreras').DataTable().destroy();
    $('#VerCarreras').DataTable({
      ajax: {
        url: "../../ajax/carreras.php?op=VerCarreras",
        type: "POST",
        dataSrc: 'data'
      },
      columns: [{
          data: 'Nombre'
        },
        {
          data: 'Fecha'
        },
        {
          data: 'Hora'
        },
        {
          data: 'Estado'
        },
        {
          data: 'Ganador'
        },
        {
          data: 'Detalle'
        },
      ]
    });
  }
});

function Detalle(idCarrera){
  var detalles = document.getElementById("detalles");
    $.ajax({
      url: "../../ajax/carreras.php?op=Detalles",
      type: "POST",
      data: {idCarrera: idCarrera},
      success: function (datos) {
        datos = datos.replace(/\\/g, '').replace(/"/g,'');
        detalles.innerHTML = datos;
          }
    });
  }