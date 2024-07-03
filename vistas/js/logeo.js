$(document).ready(function () {
  $("#formlogeo").on('submit', function (e) {
    logeo(e);
  });

  function logeo(e) {
    e.preventDefault();
    var Data = new FormData($("#formlogeo")[0]);
    $.ajax({
      url: "../ajax/jueces.php?op=logeo",
      type: "POST",
      contentType: false,
      processData: false,
      async: false,
      data: Data,
      success: function (datos) {
        if (datos.includes(0)) {
          alert("bienvenido");
          $(location).attr("href", "Admin/home.php");
        } else if (datos.includes(1)) {
          alert("bienvenido");
          $(location).attr("href", "Juez/home.php");
        } else {
          alert("Clave o Usuario incorrecto");
        }
      }
    });
  }
});
