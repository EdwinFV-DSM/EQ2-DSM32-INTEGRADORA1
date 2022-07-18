     //console.log('Funcionando');
//enviar formulario a la base de datos
var formulario2 = document.getElementById('crear-cliente');

formulario2.addEventListener('submit',  function(e) {
    e.preventDefault();
    //console.log('Me diste un click UwU');

    var datos = new FormData(formulario2);


    //console.log(datos);
    console.log(datos.get('nombre'))
    console.log(datos.get('apellidos'))
    console.log(datos.get('fechaNac'))
    console.log(datos.get('TUsuario'))
    console.log(datos.get('email'))
    console.log(datos.get('phone'))
    console.log(datos.get('direccion'))
    console.log(datos.get('cp'))
    console.log(datos.get('numExt'))
    console.log(datos.get('numInt'))
    console.log(datos.get('municipio'))
    console.log(datos.get('escuela'))
    console.log(datos.get('password'))
    console.log(datos.get('sexo'))
    // console.log(datos.get('sexoF'))
    



      fetch('../admin/operaciones/crear_cliente2.php',{
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
                  'Hubo un error al crear el cliente',
                  'error'
                )
          }else{
              Swal.fire(
                  'Success',
                  'Se a creado correctamente el cliente',
                  'success'
                )
                formulario2.reset();
          }
      })

    });