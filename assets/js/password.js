//enviar formulario a la base de datos
var password = document.getElementById("formulario-password");

password.addEventListener("submit", function (e) {
  e.preventDefault();

  var datos = new FormData(password);

  // console.log(datos);
  // console.log(datos.get('password'))
  // console.log(datos.get('email'))
  //  console.log(datos.get('desc'))
  //  console.log(datos.get('fecha'))

   fetch("../user/procesos/recuperarPassword.php", {
     method: "POST",
     body: datos,
   })
     .then((res) => res.json())
     .then((data) => {
       console.log(data);
       if (data === "error") {
         Swal.fire("Error", "Revise los datos ingresados", "error");
       } else if (data === "error-insertar") {
         Swal.fire("Error", "Hubo un error al modificar el boleto", "error");
       } else {
         Swal.fire(
           "Success",
           "Se ha modificado correctamente el boleto",
           "success"
         );
       }
     });
});
