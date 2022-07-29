//enviar Settings a la base de datos
var Settings = document.getElementById("formulario-settings");

Settings.addEventListener("submit", function (e) {
  e.preventDefault();

  var datos = new FormData(Settings);

  // console.log(datos);
  // console.log(datos.get('password'))
  // console.log(datos.get('email'))
  //  console.log(datos.get('desc'))
  //  console.log(datos.get('fecha'))

  fetch("../user/procesos/settings.php", {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data === "error") {
        Swal.fire("Error", "Revise los datos ingresados", "error");
      } else if(data === "error-servidor") {
        Swal.fire("Error", "Hubo un error en el servidor", "error");
      } else if(data === "error-extension") {
        Swal.fire("Error", "Solo se permite archivos jpeg, gif, webp", "error");
      }else{
        Swal.fire("Se a modificado correctamente", "Los cambios se veran en el siguiente inicio de sesion", "success");
      }
    });
});
