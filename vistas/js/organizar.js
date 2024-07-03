$(document).ready(function () {
	
  cbbCarreras();
  cbbParticipantes();

  var puntoscontrol = [];
  var Participantes = [];

  function cbbCarreras() {
    var cbbcarreras = $("#cbbCarreras");
    $.ajax({
      url: "../../ajax/carreras.php?op=comboCar",
      type: "POST",
      contentType: false,
      processData: false,
      async: false,
      success: function (datos) {
        datos = datos.replace(/\\/g, '').replace(/"/g, '');
        cbbcarreras.html(datos);
      }
    });
  }

  function cbbParticipantes() {
    var cbbparticipantes = $("#cbbParticipantes");
    $.ajax({
      url: "../../ajax/participantes.php?op=comboPar",
      type: "POST",
      contentType: false,
      processData: false,
      async: false,
      success: function (datos) {
        datos = datos.replace(/\\/g, '').replace(/"/g, '');
        cbbparticipantes.html(datos);
      }
    });
  }

  $("#cbbCarreras").change(function () {
    var carrera = $(this).val();
    var cbbcarreras = $("#pcontrol");
    $.ajax({
      url: "../../ajax/carreras.php?op=pControl",
      type: "POST",
      data: {
        car: carrera
      },
      success: function (datos) {
        datos = datos.replace(/\\/g, '').replace(/"/g, '');
        cbbcarreras.html(datos);
      }
    });  
  });

  $("#agregarParticipante").click(function () {
    var selectedText = $("#cbbParticipantes option:selected").text();
    if (selectedText && Participantes.indexOf(selectedText) === -1) {
      Participantes.push(selectedText);
      $("#ListaParticipantes").append("<li>" + selectedText + "</li>");
    }
  });

  $("#eliminarParticipante").click(function () {
    var selectedLi = $("#ListaParticipantes li.selected");
    var selectedText = selectedLi.text();

    if (selectedText) {
      Participantes = Participantes.filter(function (value) {
        return value !== selectedText;
      });

      selectedLi.remove();
    }
  });

  $("#ListaParticipantes").on("click", "li", function () {
    $(this).toggleClass("selected");
  });

  $(".pcontrol").change(function () {
    var selectId = $(this).attr("id");
    var selectedValue = $(this).val();

    var existingIndex = puntoscontrol.findIndex(function (item) {
      return item.id === selectId;
    });

    if (existingIndex !== -1) {
      puntoscontrol[existingIndex].value = selectedValue;
    } else {
      var seleccionInfo = {
        id: selectId,
        value: selectedValue
      };

      puntoscontrol.push(seleccionInfo);
    }
    console.log(puntoscontrol);
  });


  $("#crearCarrera").click(function () {
    var carrera = $("#cbbCarreras").val();
    $.ajax({
      url: "../../ajax/carreras.php?op=Organizar",
      type: "POST",
      data: {
        car: carrera,
        pcon: puntoscontrol,
        part: Participantes,
      },
      success: function (datos) {
        if (datos === null)
          alert("no es correcto");
      }
    });
  });
});
