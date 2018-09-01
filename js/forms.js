eventListeners();

function eventListeners() {
    document.querySelector('#loginForm').addEventListener('submit', validarRegistro);
}

function validarRegistro(e) {
    e.preventDefault();
    
    var usuario = document.querySelector('#txtUser').value,
    password = document.querySelector('#txtPwd').value,
    tipo = document.querySelector('#type').value;

    if(usuario === '' || password === ''){
            // la validación falló
            swal({
              type: 'error',
              title: 'Error!',
              text: 'Ambos campos son obligatorios!'
          })
        } 
        else 
        {
            // Ambos campos son correctos, mandar ejecutar Ajax
            // datos que se envian al servidor
            var datos = new FormData();
            datos.append('usuario', usuario);
            datos.append('password', password);
            datos.append('accion', tipo);
            
            // crear el llamado a ajax
            var xhr = new XMLHttpRequest();
            
            // abrir la conexión.
            xhr.open('POST', 'inc/model/control.php', true);
            
            // retorno de datos
            xhr.onload = function(){
                if(this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    
                    console.log(respuesta);
                    // Si la respuesta es correcta
                    if(respuesta.estado === 'correcto') {
                        // si es un acceso a sitio
                        if(respuesta.tipo === 'login'){
                            var nombreu = respuesta.nombre;
                            swal({
                                title: 'Acceso Correcto',
                                text: 'Bienvenido(a) '+nombreu,
                                type: 'success'
                            })
                            .then(resultado => {
                                if(resultado.value) {
                                    window.location.href = 'index.php';
                                }
                            })
                        }
                    } else if(respuesta.estado === 'error'){
                        var informacion = respuesta.informacion;
                        swal({
                            title: 'Error de Acceso',
                            text: informacion,
                            type: 'warning'
                        })
                        .then(resultado => {
                            if(resultado.value) {
                                window.location.href = 'index.php';
                            }
                        })
                    }else {
                        // Hubo un error
                        swal({
                            title: 'Error',
                            text: 'Hubo un error',
                            type: 'error'
                        }).then(resultado => {
                            if(resultado.value) {
                                window.location.href = 'index.php';
                            }
                        })
                    }
                }
            }
            // Enviar la petición
            xhr.send(datos);
        }
    }