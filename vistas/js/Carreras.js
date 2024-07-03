$(document).ready(function () {

  $("#btnMostrarCar").click(function () {
    $("#formCarDiv").toggle();
    $("#tblcarreras").toggle();
    var texto = $("#formCar").is(":visible") ? "Tabla" : "Nuevo";
    $("#btnMostrarCar").text(texto);
  });

  $("#formCar").on('submit', function (e) {
    Ingreso(e);
  });

  function Ingreso(e) {
    e.preventDefault();
    $('#PconNombre, #PconDistancia').prop('disabled', true);
    var formData = new FormData($("#formCar")[0]);
    formData.append('PconAlmacenados', JSON.stringify(PconAlmacenados));
    $.ajax({
      url: "../../ajax/carreras.php?op=AgregarCarreras",
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
        VerCarreras();
        $('#PconNombre, #PconDistancia').prop('disabled', false);
      }
    });
  }

  VerCarreras();

  var FechaCar = $("#FechaCar")[0];
  var fechaActual = new Date().toISOString().split('T')[0];
  FechaCar.min = fechaActual;

  function VerCarreras() {
    $('#VerCarreras').DataTable().destroy();
    $('#VerCarreras').DataTable({
      ajax: {
        url: "../../ajax/carreras.php?op=VerCarreras",
        type: "POST",
        dataSrc: 'data'
      },
      columns: [{
          data: 'Botones'
        },
        {
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

function VerCarreras() {
  $('#VerCarreras').DataTable().destroy();
  $('#VerCarreras').DataTable({
    ajax: {
      url: "../../ajax/carreras.php?op=VerCarreras",
      type: "POST",
      dataSrc: 'data'
    },
    columns: [{
        data: 'Botones'
      },
      {
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

function validarNumero(input) {
  let valor = input.value.replace(/\D/g, '').substring(0, 10);
  input.value = valor;
}

function eliminar(id) {
  $.ajax({
    type: "POST",
    url: "../../ajax/carreras.php?op=EliminarCar",
    data: {
      id: id
    },
    success: function (datos) {
      if (datos === "1") {
        alert("eliminado exitosamente");
        VerCarreras();
      } else if (datos === "0") {
        alert("El usuario no existe");
      }
    }
  });
}

function editar(recibe) {
  $("#formCarDiv").show();
  $("#tblcarreras").toggle();
  var datos = recibe.split("*");
  $("#idCar").val(datos[0]);
  $("#NombreCar").val(datos[1]);
  $("#FechaCar").val(datos[2]);
  $("#HoraCar").val(datos[3]);
  $("#btnEnviarCar").text("Modificar");
  $("#btnMostrarCar").text("Tabla");
  $.ajax({
    url: "../../ajax/carreras.php?op=Pcontrol2",
    type: "POST",
    data: {
      idCarre: datos[0]
    },
    success: function (datos) {
      PconAlmacenados = JSON.parse(datos);
		actualizarLista();
    }
  });
}

function limpiar() {
  $("#btnEnviarCar").text("Crear");
  PconAlmacenados = [];
  actualizarLista();
}

function Detalle(idCarrera) {
  var detalles = $("#detalles")[0];
  $.ajax({
    url: "../../ajax/carreras.php?op=Detalles",
    type: "POST",
    data: {
      idCarrera: idCarrera
    },
    success: function (datos) {
      datos = datos.replace(/\\/g, '').replace(/"/g, '');
      detalles.innerHTML = datos;
    }
  });
}

var PconAlmacenados = [];

function AgregarPcon(event) {
  event.preventDefault();
  var PconNombre = $("#PconNombre").val();
  var PconDistancia = $("#PconDistancia").val();

  if (PconNombre.trim() === '' || PconDistancia.trim() === '') {
    alert('Por favor, completa todos los campos.');
    return;
  }

  PconAlmacenados.push({
    nombre: PconNombre,
    distancia: PconDistancia
  });

  actualizarLista();

  $("#PconNombre, #PconDistancia").val('');
}

function actualizarLista() {
  var listaPcon = $("#listaPcon");
  listaPcon.empty();

  PconAlmacenados.forEach(function (dato) {
    var nuevoPconLista = $("<li>").text('Nombre: ' + dato.nombre + ', Distancia: ' + dato.distancia);
    listaPcon.append(nuevoPconLista);
  });
}

$("#eliminarPcon").click(function () {
    var selectedLi = $("#listaPcon li.selected");
    var selectedText = selectedLi.text();

    if (selectedText) {
      PconAlmacenados = PconAlmacenados.filter(function (value) {
        return value !== selectedText;
      });

      selectedLi.remove();
    }
  });

  $("#listaPcon").on("click", "li", function () {
    $(this).toggleClass("selected");
  });
