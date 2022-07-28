
    // console.log('Funcionando');
//enviar formulario a la base de datos
var facturacion = document.getElementById('facturacion');

facturacion.addEventListener('submit',  function(e) {
    e.preventDefault();
    // console.log('Me diste un click UwU');

    var datos = new FormData(facturacion);


    // console.log(datos);
    console.log(datos.get('status'))
    console.log(datos.get('operacion'))
    // console.log(datos.get('fechaV'))
    // console.log(datos.get('costo'))
    // console.log(datos.get('ruta'))
    // console.log(datos.get('operacion'))
    // console.log(datos.get('horario'))
    // var No_operacion = Math.floor(Math.random() * (1000000 - 1 + 2) + 10);
    // console.log(No_operacion);

    fetch('../../admin/operaciones/update_factura.php',{
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
           
        }else if(data === 'error-insertar'){
            Swal.fire(
                'Error',
                'Hubo un error al guardar el status',
                'error'
              )
        }else if(data === 'error-pago'){
            Swal.fire(
                'Error',
                'El boleto todavia no se encuentra pagado',
                'error'
              )
        }else{
            Swal.fire(
                'Success',
                'Se ha modificado correctamente el status de la factura',
                'success'
              )
        }
    })

    });