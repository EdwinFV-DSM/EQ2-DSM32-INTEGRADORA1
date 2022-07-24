// console.log('Funcionando');
//enviar formulario a la base de datos
var signup = document.getElementById("formulario-signup");

signup.addEventListener("submit", function (e) {
  e.preventDefault();
  // console.log('Me diste un click UwU');

  var datos = new FormData(signup);

  // console.log(datos);
  // console.log(datos.get('password'))
  // console.log(datos.get('email'))
  //  console.log(datos.get('desc'))
  //  console.log(datos.get('fecha'))

  fetch("../user/procesos/signup.php", {
    method: "POST",
    body: datos,
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      if (data === "error") {
        Swal.fire(
        "Error", 
        "Revise los datos ingresados", 
        "error"
        );
      } else if(data === "error-nombre"){
        Swal.fire(
            "Error", 
            "Revise que el campo nombre este lleno", 
            "error"
            );
      }else if(data === "error-apellido"){
        Swal.fire(
            "Error", 
            "Revise que el campo apellido este lleno", 
            "error"
            );
      }else if(data === "error-fechaNa"){
        Swal.fire(
            "Error", 
            "Revise que el campo fecha de nacimiento este lleno", 
            "error"
            );
      }else if(data === "error-email"){
        Swal.fire(
            "Error", 
            "Revise que el campo email este lleno", 
            "error"
            );
      }
      else if(data === "error-password"){
        Swal.fire(
            "Error", 
            "Revise que el campo password este lleno", 
            "error"
            );
      }else if(data === "error-sexo"){
        Swal.fire(
            "Error", 
            "Revise que el campo sexo este lleno", 
            "error"
            );
      } else if(data === "error-insertar"){
        Swal.fire(
            "Error", 
            "Hubo un error al crear la cuenta", 
            "error"
            );
      }else if(data === "error-cuenta"){
        Swal.fire(
            "Error", 
            "El correo ingresado ya se encuentra en uso", 
            "error"
            );
        }else if(data === "success"){
        Swal.fire(
            "success", 
            "Se ha creado correctamente su cuenta", 
            "success"
            );
      }

    });
});
