// JavaScript Document
$(document).ready(function () {
  MisPuntos();

  function MisPuntos() {
    var MisPuntos = document.getElementById("MisPuntos");
    $.ajax({
      url: "../../ajax/jueces.php?op=MisPuntos",
      type: "POST",
      success: function (datos) {
        datos = datos.replace(/\\/g, '').replace(/"/g, '');
        MisPuntos.innerHTML = datos;
      }
    });
  }
});

function MarcarPunto(participante, pcontrol) {
  $.ajax({
    url: "../../ajax/pcontrol.php?op=Registrar",
    type: "POST",
    data: {
      participante: participante,
      pcontrol: pcontrol
    },
    success: function (datos) {
      alert(datos);
      if (datos === "0") {
        alert("punto ya estuvo registrado");
      } else {
        alert("punto registrado");
      }
    }
  });
}
