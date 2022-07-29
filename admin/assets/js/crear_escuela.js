var Escuela = document.getElementById('crear-escuela');

Escuela.addEventListener('submit',  function(e) {
    e.preventDefault();
    //console.log('Me diste un click UwU');

    var datos = new FormData(Escuela);


    //console.log(datos);
    // console.log(datos.get('imagen'))
    // console.log(datos.get('nombre'))
    // console.log(datos.get('direccion'))

    



       fetch('../admin/operaciones/crear_escuela2.php',{
           method: 'POST',
           body: datos
       })
       .then( res => res.json())
       .then( data => {
           console.log(data)
           if(data === 'error-server') {
               Swal.fire(
                 'Error',
                 'Ocurrio un error del lado del servidor',
                 'error'
               )
           
           }else if(data === 'error-type'){
            Swal.fire(
                'Error',
                'Solo se permite archivos jpeg, gif, webp',
                'error'
              )
           }else if(data === 'error-nombre'){
            Swal.fire(
                'Error',
                'Ingrese un nombre',
                'error'
              )
           }else if(data === 'error-direccion'){
            Swal.fire(
                'Error',
                'Ingrese una direccion',
                'error'
              )
           }else if(data === 'error-email'){
            Swal.fire(
                'Error',
                'ingrese un correo electronico',
                'error'
              )
           }else if(data=== 'error-password'){
            Swal.fire(
                'Error',
                'Ingrese un password',
                'error'
              )
           }else if(data=== 'error-imagen'){
            Swal.fire(
                'Error',
                'Selecciones una imagen',
                'error'
              )
           }else{
               Swal.fire(
                   'Success',
                   'Se a creado correctamente el cliente',
                   'success'
                 )
                 Escuela.reset();
           }
       })

    });