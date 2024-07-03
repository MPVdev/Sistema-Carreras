$(document).ready(function () {

  $("#btnMostrarPar").click(function () {
    $("#formParDiv").toggle();
    $("#tblparticipantes").toggle();
    var texto = $("#formPar").is(":visible") ? "Tabla" : "Nuevo";
    $("#btnMostrarPar").text(texto);
  });

  $("#formPar").on('submit', function (e) {
    Ingreso(e);
  });

  function Ingreso(e) {
    e.preventDefault();
    var formData = new FormData($("#formPar")[0]);
    $.ajax({
      url: "../../ajax/participantes.php?op=IngresoPar",
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
        Verparticipantes();
      }
    });
  }

  Verparticipantes();

  function Verparticipantes() {
    $('#participantes').DataTable().destroy();
    $('#participantes').DataTable({
      language: {
        url: "../../files/datatable-spanish.json"
      },
      ajax: {
        url: "../../ajax/participantes.php?op=listar",
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
          data: 'Telefono'
        },
        {
          data: 'Equipo'
        },
      ]
    });
  }
});

function Verparticipantes() {
  $('#participantes').DataTable().destroy();
  $('#participantes').DataTable({
    language: {
      url: "../../files/datatable-spanish.json"
    },
    ajax: {
      url: "../../ajax/participantes.php?op=listar",
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
        data: 'Telefono'
      },
      {
        data: 'Equipo'
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
    url: "../../ajax/participantes.php?op=EliminarPar",
    data: {
      cedula: cedula
    },
    success: function (datos) {
      if (datos === "1") {
        alert("eliminado exitosamente");
        Verparticipantes();
      } else if (datos === "0") {
        alert("El usuario no existe");
      }
    }
  });
}

function editar(recibe) {
  $("#formParDiv").show();
  $("#tblparticipantes").toggle();
  var datos = recibe.split("*");
  $("#cedula").val(datos[0]);
  $("#cedula").prop("readonly", true);
  $("#nombre").val(datos[1]);
  $("#apellido").val(datos[2]);
  $("#telefono").val(datos[3]);
  $("#equipo").val(datos[4]);
  $("#btnEnviarPar").text("Modificar");
  $("#btnMostrarPar").text("Tabla");
}

function limpiar() {
  $("#btnEnviarPar").text("Crear");
  $("#cedula").prop("readonly", false);
}
