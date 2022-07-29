// console.log('Funcionando');
//enviar formulario a la base de datos
var formulario5 = document.getElementById('modificar-boleto');

formulario5.addEventListener('submit',  function(e) {
    e.preventDefault();
    // console.log('Me diste un click UwU');

    var datos = new FormData(formulario5);


    console.log(datos);
    console.log(datos.get('cliente'))
    console.log(datos.get('fechaC'))
    console.log(datos.get('fechaV'))
    console.log(datos.get('costo'))
    console.log(datos.get('ruta'))
    console.log(datos.get('operacion'))

    fetch('../../admin/operaciones/modificar_boleto2.php',{
        method: 'POST',
        body: datos
    })
    .then( res => res.json())
    .then( data => {
        console.log(data)
        if(data === 'error') {
            Swal.fire(
              'Error',
              'Revise los datos ingresados',
              'error'
            )
           
        }else if(data=== 'error-insertar'){
            Swal.fire(
                'Error',
                'Hubo un error al crear el boleto',
                'error'
              )
        }else{
            Swal.fire(
                'Success',
                'Se ha modificado correctamente el boleto',
                'success'
              )
        }
    })

    });
