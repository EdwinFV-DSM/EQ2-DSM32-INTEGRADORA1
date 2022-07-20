// console.log('Funcionando');
//enviar formulario a la base de datos
var formulario = document.getElementById("formulario-login");

formulario.addEventListener("submit", function (e) {
  e.preventDefault();
  // console.log('Me diste un click UwU');

  var datos = new FormData(formulario);

  // console.log(datos);
  // console.log(datos.get('password'))
  // console.log(datos.get('email'))
  //  console.log(datos.get('desc'))
  //  console.log(datos.get('fecha'))

  fetch("../user/procesos/login.php", {
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
      } else {
        let timerInterval;
        Swal.fire({
          title: "Estas siendo redirigido!",
          text: "Te has loegeado exitosamente...",
          html: "I will close in <b></b> milliseconds.",
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector("b");
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft();
            }, 100);
          },
          willClose: () => {
            clearInterval(timerInterval);
          },
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
            window.location.href =
              "http://localhost/EQ2-DSM32-INTEGRADORA1/user/panel.php";
          }
        });
        // Swal.fire({
        //   title: 'Te has logeado correctamente',
        //   icon: 'success',
        //   showCloseButton: true,
        //   showCancelButton: true,
        //   focusConfirm: false,
        //   confirmButtonText:
        //     '<a href="http://localhost/EQ2-DSM32-INTEGRADORA1/user/panel.php" style="color: white;text-decoration: none;"><i class="fa fa-thumbs-up"></i> Great!</a>',
        //   cancelButtonAriaLabel: 'Thumbs down'
        // })

        // Swal.fire(
        //   'Success',
        //   'Se a registrado correctamente',
        //   'success'
        // )
      }
    });
});
