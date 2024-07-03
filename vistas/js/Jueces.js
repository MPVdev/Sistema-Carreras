$(document).ready(function () {

  $("#btnMostrarJue").click(function () {
    $("#formJueDiv").toggle();
    $("#tbljueces").toggle();
    var texto = $("#formJue").is(":visible") ? "Tabla" : "Nuevo";
    $("#btnMostrarJue").text(texto);
  });

  $("#formJue").on('submit', function (e) {
    Ingreso(e);
  });

  function Ingreso(e) {
    e.preventDefault();
    var formData = new FormData($("#formJue")[0]);
    $.ajax({
      url: "../../ajax/jueces.php?op=IngresoJue",
      type: "POST",
      contentType: false,
      processData: false,
      async: false,
      data: formData,
      success: function (datos) {
        if (datos === "1") {
          alert("Guardado exitosamente");
        } else if (datos === "0") {
          alert("Se modifico correctamente");
        }
        Verjueces();
      }
    });
  }

  Verjueces();

  function Verjueces() {
    $('#jueces').DataTable().destroy();
    $('#jueces').DataTable({
      language: {
        url: "../../files/datatable-spanish.json"
      },
      ajax: {
        url: "../../ajax/jueces.php?op=listar",
        type: "POST",
        dataSrc: 'data'
      },
      columns: [{
          data: 'Botones'
        },
        {
          data: 'Cedula'
        },
        {
          data: 'Nombre'
        },
        {
          data: 'Usuario'
        },

      ]
    });
  }
});

function Verjueces() {
  $('#jueces').DataTable().destroy();
  $('#jueces').DataTable({
    language: {
      url: "../../files/datatable-spanish.json"
    },
    ajax: {
      url: "../../ajax/jueces.php?op=listar",
      type: "POST",
      dataSrc: 'data'
    },
    columns: [{
        data: 'Botones'
      },
      {
        data: 'Cedula'
      },
      {
        data: 'Nombre'
      },
      {
        data: 'Usuario'
      },
    ]
  });
}

function validarNumero(input) {
  let valor = input.value.replace(/\D/g, '').substring(0, 10);
  input.value = valor;
}

function eliminar(cedula) {
  $.ajax({
    type: "POST",
    url: "../../ajax/jueces.php?op=EliminarJue",
    data: {
      cedula: cedula
    },
    success: function (datos) {
      if (datos === "1") {
        alert("eliminado exitosamente");
        Verjueces();
      } else if (datos === "0") {
        alert("El usuario no existe");
      }
    }
  });
}

function editar(recibe) {
  $("#formJueDiv").show();
  $("#tbljueces").toggle();
  var datos = recibe.split("*");
  $("#cedula").val(datos[0]);
  $("#cedula").prop("readonly", true);
  $("#nombre").val(datos[1]);
  $("#apellido").val(datos[2]);
  $("#usuario").val(datos[3]);
  $("#btnEnviarJue").text("Modificar");
  $("#btnMostrarJue").text("Tabla");
}

function limpiar() {
  $("#btnEnviarJue").text("Crear");
  $("#cedula").prop("readonly", false);
}
