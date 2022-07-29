
    // console.log('Funcionando');
//enviar formulario a la base de datos
var formulario3 = document.getElementById('crear-boleto');

formulario3.addEventListener('submit',  function(e) {
    e.preventDefault();
    // console.log('Me diste un click UwU');

    var datos = new FormData(formulario3);


    // console.log(datos);
    // console.log(datos.get('cliente'))
    // console.log(datos.get('fechaC'))
    // console.log(datos.get('fechaV'))
    // console.log(datos.get('costo'))
    // console.log(datos.get('ruta'))
    // console.log(datos.get('operacion'))
    // console.log(datos.get('horario'))
    // var No_operacion = Math.floor(Math.random() * (1000000 - 1 + 2) + 10);
    // console.log(No_operacion);

    fetch('../admin/operaciones/crear_boleto2.php',{
        method: 'POST',
        body: datos
    })
    .then( res => res.json())
    .then( data => {
        console.log(data)
        if(data === 'error_insertar') {
            Swal.fire(
              'Error',
              'Revise los datos ingresados',
              'error'
            )
           
        }else{
            Swal.fire(
                'Success',
                'Se ha creado correctamente el boleto',
                'success'
              )
              formulario3.reset();
        }
    })

    });