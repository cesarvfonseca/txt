eventListeners_();

function eventListeners_(){
    if(document.querySelector('.nuevo-txt') !== null ) {
        document.querySelector('.nuevo-txt').addEventListener('click', enviarTXT);
    }

    if(document.querySelector('.nuevo-txtc') !== null ) {
        document.querySelector('.nuevo-txtc').addEventListener('click', enviarTXTC);
    }

    if(document.querySelector('.nuevo-vacaciones') !== null ) {
        document.querySelector('.nuevo-vacaciones').addEventListener('click', enviarVACACIONES);
    }
 
}

function enviarVACACIONES(e){
    e.preventDefault();
    document.querySelector('.nuevo-vacaciones').removeEventListener('click', enviarVACACIONES);
    var fechaINI = document.querySelector('#fechaINI').value,
        fechaFIN = document.querySelector('#fechaFIN').value,
        razon = document.querySelector('#txtRazonv').value,
        employeeID = document.querySelector('#employeeIDv').value,
        tipo = document.querySelector('#typev').value;

    // console.log(fechaINI+' '+fechaFIN+' '+razon+' '+employeeID+' '+tipo);

    if (razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }
    else{
        var datosVAC = new FormData();
        datosVAC.append('fechaINI', fechaINI);
        datosVAC.append('fechaFIN', fechaFIN);
        datosVAC.append('razon', razon);
        datosVAC.append('employeeID', employeeID);
        datosVAC.append('accion', tipo);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'inc/model/control.php', true);
        xhr.onload = function(){
        if (this.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xhr.send(datosVAC);
    }

}

function enviarTXT(e){
    e.preventDefault();
    document.querySelector('.nuevo-txt').removeEventListener('click', enviarTXT);
    var fecha = document.querySelector('#txtFecha').value,
        horas = document.querySelector('#txtHoras').value,
        razon = document.querySelector('#txtRazon').value,
        employeeID = document.querySelector('#employeeID').value,
        tipo = document.querySelector('#type').value;

    if (fecha === '' || horas === '' || razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }else{
        var datosTXT = new FormData();
        datosTXT.append('fecha', fecha);
        datosTXT.append('horas', horas);
        datosTXT.append('razon', razon);
        datosTXT.append('employeeID', employeeID);
        datosTXT.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();

        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosTXT);
    }
}

function enviarTXTC(e){
    e.preventDefault();
    document.querySelector('.nuevo-txtc').removeEventListener('click', enviarTXTC);
    var fecha = document.querySelector('#txtFechac').value,
        horas = document.querySelector('#txtHorasc').value,
        razon = document.querySelector('#txtRazonc').value,
        employeeID = document.querySelector('#employeeIDc').value,
        tipo = document.querySelector('#typec').value;
        console.log(tipo);

    if (fecha === '' || horas === '' || razon === '') {
        swal({
          type: 'error',
          title: 'Error!',
          text: 'Todos los campos son obligatorios!'
        })
    }else{
        var datosTXT = new FormData();
        datosTXT.append('fecha', fecha);
        datosTXT.append('horas', horas);
        datosTXT.append('razon', razon);
        datosTXT.append('employeeID', employeeID);
        datosTXT.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();

        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitoso!',
                            type: 'success'
                        })
                        .then(resultado => {
                                if(resultado.value) {
                                   location.reload();
                                }
                            })
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosTXT);
    }
}

function getComboA(selectObject) {
    var value = selectObject.value;
    if (value == 'txt' ) {
        $('#txtDIV').show();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR TXT SELECCIONADO');
    }
    else if (value == 'txtc' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').show();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR TXTC SELECCIONADO');
    }
    else if (value == 'vacaciones' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').show();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        console.log('VALOR VACACIONES SELECCIONADO');
    }else if (value == 'panel-usuario' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').show();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').hide();

        console.log('VALOR PANEL SELECCIONADO');
    } else if (value == 'panel-personal' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').show();
        $('#defaultDIV').hide();

        console.log('VALOR PANEL PERSONAL SELECCIONADO');
    } else if (value == 'non' ) {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').show();
        console.log('NINGUN PANEL SELECCIONADO');
    }
}
//FUNCION EDITAR REGISTROS DEL EMPLEADO
async function editarRegistros(btnEditar){
  var idempleado = btnEditar.data('idemp'),
      idmov = btnEditar.data('mov'),
      horas_bd = btnEditar.data('horas'),
      accion = 'editar_incidencia';
      const {value: horas} = await swal({
      title: 'Modificar Horas',
      input: 'text',
      inputPlaceholder: 'Ingrese horas ej: 1.5 ',
      inputValue: horas_bd
      })

      if ( horas ) {
        var editar_registro = new FormData();
        editar_registro.append('horas',horas);
        editar_registro.append('idempleado',idempleado);
        editar_registro.append('idmov',idmov);
        editar_registro.append('accion',accion);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                if (respuesta.estado === 'correcto') {
                    var informacion = respuesta.informacion;
                    swal(
                      'Registro Actualizado!',
                      informacion,
                      'success'
                    )
                  //ACTUALIZAR LA HORAS EN LA TABLA
                  btnEditar.parent().parent().find(".row_hours b").text(horas);
                } else if (respuesta.estado === 'incorrecto') {
                  var informacion = respuesta.informacion;
                  swal(
                    'Registro no editado!',
                    informacion,
                    'info'
                  )
                } else {
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(editar_registro);

      } else{
        swal(
              'Error!',
              'Las horas no pueden ir vacias',
              'error'
            )
      }

}

//FUNCION ELIMINAR REGISTROS DE LA TABLA EMPLEADO
function eliminarRegistros(btnEliminar){
  var idempleado = btnEliminar.data('idemp'),
      idmov = btnEliminar.data('mov'),
      accion = 'eliminar_incidencia';
  swal({
  title: 'Eliminar incidencia',
  text: "El registro sera eliminado",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar!',
  cancelButtonText: 'Cancelar!'
  }).then((result) => {
    if (result.value) {
      var eliminar_registro = new FormData();
      eliminar_registro.append('id_mov', idmov);
      eliminar_registro.append('accion', accion);
      // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
      var xmlhr = new XMLHttpRequest();
      //ABRIR LA CONEXION
      xmlhr.open('POST', 'inc/model/control.php', true);
      // VERIFICAR LA RESPUESTA DEL SERVICIO
      xmlhr.onload = function(){
          if (this.status === 200) {
              var respuesta = JSON.parse(xmlhr.responseText);
              // console.log(respuesta);
              if (respuesta.estado === 'correcto') {
                  var informacion = respuesta.informacion;
                  swal(
                    'Registro Eliminado!',
                    informacion,
                    'success'
                  )
                  btnEliminar.parents("tr").remove();
                  console.log(respuesta);
              } else if (respuesta.estado === 'incorrecto') {
                var informacion = respuesta.informacion;
                swal(
                  'Registro no eliminado!',
                  informacion,
                  'info'
                )
                console.log(respuesta);
              } else {
                  swal({
                      title: 'Error!',
                      text: 'Hubo un error',
                      type: 'error'
                  })
              }
          }
      }
      // Enviar la petición
      xmlhr.send(eliminar_registro);
    }
  })
}

//FUNCION ELIMINAR REGISTROS NO AUTORIZADOS, VIEJOS
function eliminar_registrosViejos(args){
    // console.log(args);
    var accion = 'eliminar_regviejos';
    var eliminar_registros_viejos = new FormData();
    eliminar_registros_viejos.append('id_empleado', args);
    eliminar_registros_viejos.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/control.php', true);
    xmlhr.onload = function(){
    if (this.status === 200) {
      var respuesta = JSON.parse(xmlhr.responseText);
      // console.log('DESDE PHP: ' + respuesta);
      if (respuesta.estado === 'correcto') {
          var informacion = respuesta.informacion;
          // console.log('DESDE PHP: ' + informacion);
      } else if(respuesta.estado === 'error'){
            var informacion = respuesta.informacion;
            // console.log('DESDE PHP: ' + informacion);
      }
    }
    }
    xmlhr.send(eliminar_registros_viejos);
}


$('#daterange').daterangepicker();
$('#daterange').on('apply.daterangepicker', function(ev, picker) {

    var fechaInicial = picker.startDate.format('YYYY-MM-DD'),
        fechafinal = picker.endDate.format('YYYY-MM-DD'),
        employeeID = $('#employeeID').val(),
        accion = 'consulta';
    console.log(fechaInicial + ' ' + fechafinal + ' ' + employeeID);
    $('#bodyTable').empty();
    var consulta_rango = new FormData();
    consulta_rango.append('fechaINI', fechaInicial);
    consulta_rango.append('fechaFIN', fechafinal);
    consulta_rango.append('employeeID', employeeID);
    consulta_rango.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function(){
    if (this.status === 200) {
      var respuesta = JSON.parse(xmlhr.responseText);
      // console.log(respuesta);
      if (respuesta.estado === 'correcto') {
        var informacion = respuesta.informacion;
        // console.log(informacion);
        for(var i in informacion){
            drawRow(informacion[i]);
            $('#alerta').hide();
            $('#aviso').hide();
        }     
      } else if(respuesta.estado === 'error'){
        var informacion = respuesta.informacion;
        $('#alerta').show();
        $('#aviso').hide();
      }
    }
    }
    xmlhr.send(consulta_rango);
});

function drawRow(rowData) {
    var row = $("<tr />")
    $("#order_data").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    //COLUMNA TIPO
    row.append($("<td class='tipo_incidencia'><a tabindex='0'" + 
        " class='btn btn-sm btn-outline-dark' role='button'"+
        " data-toggle='popover' data-trigger='focus' title='Razón' data-content='" + rowData.emp_observaciones + 
        "'><i class='fas fa-info'></i></a> <b>" + rowData.tipo_incidencia + "</td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowData.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowData.tipo!==3){
        row.append($("<td class='row_hours'><b>" + rowData.horas + "</td>"));
    }else{
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
    }
    //COLUMNA AUTORIZACION DEL JEFE
    row.append($("<td id='vobo'><a tabindex='0' class='btn btn-sm btn-outline-dark' role='button'"+
                " data-toggle='popover' data-trigger='focus' title='Razón' data-content='" + rowData.jefe_observaciones + 
                "'><i class='fas fa-info'></i></a> <b>" + rowData.voboJefe + "</td>"));
    //COLUMNA VOBO RH
    row.append($("<td id='vobo'><a tabindex='0' class='btn btn-sm btn-outline-dark' role='button' data-toggle='popover'"+
                " data-trigger='focus' title='Razón' data-content='" + rowData.rh_observaciones + 
                "'><i class='fas fa-info'></i></a> <b>" + rowData.voboRH + "</td>"));
    //COLUMNA ACCIONES
    if (rowData.tipo===3){
        row.append($("<td class='text-center'>" + "<a tabindex='0' class='btn btn-sm btn-secondary disabled' role='button'>"+
                "<i class='fas fa-pen-square'></i> Editar</a>   "+
                "<a tabindex='1' class='btn btn-sm btn-danger btnEliminar' data-idemp='" + rowData.employee + "' data-mov='" +
                rowData.id + "' role='button'><i class='fas fa-trash-alt'></i> Eliminar</a>"+ "</td>"));
    }else{
    row.append($("<td class='text-center'>" + "<a tabindex='0' class='btn btn-sm btn-primary btnEditar' data-horas='" + rowData.horas + "'"+
                " data-idemp='" + rowData.employee + "' data-mov='" + rowData.id + "' role='button'>"+
                "<i class='fas fa-pen-square'></i> Editar</a>   "+
                "<a tabindex='1' class='btn btn-sm btn-danger btnEliminar' data-idemp='" + rowData.employee + "' data-mov='" +
                rowData.id + "' role='button'><i class='fas fa-trash-alt'></i> Eliminar</a>"+ "</td>"));
    }
    var voboJefe = $('#vobojefe').text(),
    rowLine = $('td').text();

    var $rows = $('#order_data tr #vobo');
    $rows.each(function(i, item) {
        $this = $(item);
        if ( $this.text().trim() == 'Pendiente' ) {
            $this.addClass('bg-warning');
        }else if ( $this.text().trim() == 'Autorizado' ){
            $this.addClass('bg-success text-white');
        }else if ( $this.text().trim() == 'No Autorizado' ){
            $this.addClass('bg-danger text-white');
        }
    });

    // Activar POPOVER
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    //EDITAR REGISTRO
    $(".btnEditar").click(function(){
      editarRegistros($(this));
    });

    // Borrar Registros
    $(".btnEliminar").click(function(){
      eliminarRegistros($(this));
    });

    eliminar_registrosViejos(rowData.employee);

}

//PANEL JEFES
$('#daterange_manager').daterangepicker();
$('#daterange_manager').on('apply.daterangepicker', function(ev, picker) {

    var fechaInicial = picker.startDate.format('YYYY-MM-DD'),
        fechafinal = picker.endDate.format('YYYY-MM-DD'),
        employeeID = $('#employeeID').val(),
        accion = 'consulta_jefe';
    console.log(fechaInicial + ' ' + fechafinal + ' ' + employeeID + ' ' + accion);
    $('.tablaPersonal').empty();
    var consulta_rango = new FormData();
    consulta_rango.append('fechaINI', fechaInicial);
    consulta_rango.append('fechaFIN', fechafinal);
    consulta_rango.append('employeeID', employeeID);
    consulta_rango.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function(){
    if (this.status === 200) {
      var respuesta = JSON.parse(xmlhr.responseText);
      // console.log(respuesta);
      if (respuesta.estado === 'correcto') {
        var informacion = respuesta.informacion;
        console.log(informacion);
        for(var i in informacion){
            tablaPersonal(informacion[i]);
            $('#alertaM').hide();
            $('#avisoM').hide();
        }     
      } else if(respuesta.estado === 'error'){
        var informacion = respuesta.informacion;
        $('#alertaM').show();
        $('#avisoM').hide();
      }
    }
    }
    xmlhr.send(consulta_rango);
});

function tablaPersonal(rowInfo){
    var row = $("<tr />"),
        txtBoton = 'Pendiente',
        trClass = 'bg-warning',//CLASE VOBORH
        btnClass = 'btn-warning';
    if (rowInfo.jefe_autorizacion === 1) {
        txtBoton = 'Autorizada',
        trClass = 'bg-success',
        btnClass = 'btn-success';        
    } else if( rowInfo.jefe_autorizacion === 2 ){
        txtBoton = 'No Autorizada',
        trClass = 'bg-danger',
        btnClass = 'btn-danger';   
    }
    if (rowInfo.rh_vobo === 1) {
        trClass = 'bg-success';      
    } else if( rowInfo.rh_vobo === 2 ){
        trClass = 'bg-danger';
    }
    $("#tabla-personal").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    // NUMERO DE NOMINA DEL EMPLEADO
    row.append($("<td> <b>" + rowInfo.employee + " </b> </td>"));
    // NOMBRE DEL EMPLEADO
    row.append($("<td> <b>" + rowInfo.emp_name + " </b> </td>"));
    //TIPO DE INCIDENCIA
    row.append($("<td class='tipo_incidencia'><a tabindex='0'" + 
        " class='btn btn-sm btn-outline-dark' role='button'"+
        " data-toggle='popover' data-trigger='focus' title='Razón' data-content='" + rowInfo.emp_observaciones + 
        "'><i class='fas fa-info'></i></a> <b>" + rowInfo.tipo_incidencia + "</td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowInfo.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowInfo.tipo!==3){
        row.append($("<td class='row_hours'><b>" + rowInfo.horas + "</td>"));
    }else{
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
    }    
    //COLUMNA VOBO RH
    row.append($("<td class='" + trClass + "'><a tabindex='0' class='btn btn-sm btn-outline-dark' role='button' data-toggle='popover'"+
                " data-trigger='focus' title='Razón' data-content='" + rowInfo.rh_observaciones + 
                "'><i class='fas fa-info'></i></a> <b>" + rowInfo.voboRH + "</td>"));
    //COLUMNA AUTORIZACION DEL JEFE
    // var txtBoton = 'Pendiente',
    //     btnClass = 'btn-warning';
    // if (rowInfo.jefe_autorizacion === 1) {
    //     txtBoton = 'Autorizada',
    //     btnClass = 'btn-success';        
    // } else if( rowInfo.jefe_autorizacion === 2 ){
    //     txtBoton = 'No Autorizada',
    //     btnClass = 'btn-danger';   
    // }
    row.append($("<td class='autorizado'>" + "<a tabindex='1' class='btn btn-sm " + btnClass + " btnRevisar' " +
                                                "data-idemp='" + rowInfo.employee + "' data-mov='" + rowInfo.id + "' data-razon='" + rowInfo.emp_observaciones + 
                                                "' data-empleado='" + rowInfo.emp_name + "' role='button'> " + txtBoton + " </a>" + "</td>"));


    // Activar POPOVER
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    //BOTON AUTORIZAR JEFES
    $(".btnRevisar").click( function(){
        validarIncidencia($(this));
    });
}

//VALIDAR INCIDENCIAS DEL EMPLEADO
async function validarIncidencia(btnValidar){
    var razon = btnValidar.data('razon'),
        empleado = btnValidar.data('empleado'),
        idempleado = $('#employeeID').val(),
        accion = 'voboJefe',
        idMovimiento = btnValidar.data('mov');

    const {value: validacion} = await 
    swal({
          title: 'Validar incidencia',
          html: empleado + '</br> <b>Razón:</b> ' + razon,
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Autorizar!',
          cancelButtonText: 'No Autorizar!',
          allowOutsideClick: false,
          allowEscapeKey: false
        })

    if ( validacion ){
        const {value: comentario} = await swal({
        title: 'Incidencias Autorizadas',
        input: 'text',
        type: 'info',
        inputPlaceholder: 'Ingrese horas ej: 1.5 ',
        inputValue: 'Autorizada'
        })
        btnValidar.removeClass('btn-warning');
        btnValidar.removeClass('btn-danger');
        btnValidar.text('Autorizada');
        btnValidar.addClass('btn-success');
        var status = 1;
        var datosAutorizado = new FormData();
        datosAutorizado.append('id', idMovimiento);
        datosAutorizado.append('status', status);
        datosAutorizado.append('accion', accion);
        datosAutorizado.append('idempleado', idempleado);
        datosAutorizado.append('observaciones_default', comentario);
        // swal(idMovimiento + ' ' + status + ' ' + accion + ' ' + idempleado + ' ' + comentario):
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                // console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    console.log(respuesta);
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosAutorizado);     
    } else { 
        const {value: comentario} = await swal({
        title: 'Incidencias No autorizadas',
        input: 'text',
        type: 'warning',
        inputPlaceholder: 'Ingrese horas ej: 1.5 ',
        inputValue: 'No Autorizada'
        })       
        btnValidar.text('No Autorizada');
        btnValidar.removeClass('btn-warning');
        btnValidar.removeClass('btn-success');
        btnValidar.addClass('btn-danger');
        // btnValidar.parents("tr").remove(); 
        var status = 2;
        var datosAutorizado = new FormData();
        datosAutorizado.append('id', idMovimiento);
        datosAutorizado.append('status', status);
        datosAutorizado.append('accion', accion);
        datosAutorizado.append('idempleado', idempleado);
        datosAutorizado.append('observaciones_default', comentario);
        // swal(idMovimiento + ' ' + status + ' ' + accion + ' ' + idempleado + ' ' + comentario);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                // console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    console.log(respuesta);
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosAutorizado); 
    }
    
}

//PANEL RRHH
$('#daterange_hhrr').daterangepicker();
$('#daterange_hhrr').on('apply.daterangepicker', function(ev, picker) {

    var fechaInicial = picker.startDate.format('YYYY-MM-DD'),
        fechafinal = picker.endDate.format('YYYY-MM-DD'),
        txtBuscado = '',
        accion = 'consulta_rh';
    console.log(fechaInicial + ' ' + fechafinal + ' ');
    $('#tablehhrr').empty();
    //LIMPIAR CAJA DE BUSQUEDA
    $("#txtBuscar").val('');
    var consulta_rango_rh = new FormData();
    consulta_rango_rh.append('fechaINI', fechaInicial);
    consulta_rango_rh.append('fechaFIN', fechafinal);
    consulta_rango_rh.append('valorBuscado', txtBuscado);
    consulta_rango_rh.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function(){
    if (this.status === 200) {
      var respuesta = JSON.parse(xmlhr.responseText);
      console.log(respuesta);
      if (respuesta.estado === 'correcto') {
        var informacion = respuesta.informacion;
        // console.log(informacion);
        for(var i in informacion){
            tablaRH(informacion[i]);
            $('#alertaR').hide();
            $('#avisoR').hide();
        }     
      } else if(respuesta.estado === 'error'){
        var informacion = respuesta.informacion;
        $('#alertaR').show();
        $('#avisoR').hide();
      }
    }
    }
    xmlhr.send(consulta_rango_rh);
});

function tablaRH(rowInfo){
    var row = $("<tr />"),
        txtBoton = 'Pendiente',
        trClass = 'bg-warning',//CLASE VOBORH
        btnClass = 'btn-warning';
    if (rowInfo.rh_vobo === 1) {
        txtBoton = 'Revisada',
        btnClass = 'btn-info';        
    } else if( rowInfo.rh_vobo === 2 ){
        txtBoton = 'No Autorizada',
        btnClass = 'btn-danger';   
    }
    if (rowInfo.jefe_autorizacion === 1) {
        trClass = 'bg-success';      
    } else if( rowInfo.jefe_autorizacion === 2 ){
        trClass = 'bg-danger';
    }
    $("#tablaRH").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    // NUMERO DE NOMINA DEL EMPLEADO
    row.append($("<td> " + rowInfo.employee + " </td>"));
    // NOMBRE DEL EMPLEADO
    row.append($("<td> " + rowInfo.emp_name + " </td>"));
    // NOMBRE DEL DEPARTAMENTO
    row.append($("<td> " + rowInfo.deptname + " </td>"));
    //TIPO DE INCIDENCIA
    row.append($("<td class='tipo_incidencia'><a tabindex='0'" + 
        " class='btn btn-sm btn-outline-dark' role='button'"+
        " data-toggle='popover' data-trigger='focus' title='Razón' data-content='" + rowInfo.emp_observaciones + 
        "'><i class='fas fa-info'></i></a> <b>" + rowInfo.tipo_incidencia + "</td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowInfo.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowInfo.tipo!==3){
        row.append($("<td class='row_hours'>" + rowInfo.horas + "</td>"));
    }else{
        row.append($("<td>" + 'N/A' + "</td>"));
    }    
    //COLUMNA VOBO JEFE
    row.append($("<td class='" + trClass + "'><a tabindex='0' class='btn btn-sm btn-outline-dark' role='button' data-toggle='popover'"+
                " data-trigger='focus' title='Razón' data-content='" + rowInfo.jefe_observaciones + 
                "'><i class='fas fa-info'></i></a> <b>" + rowInfo.voboJefe + "</td>"));
    //COLUMNA BOTON VOBO RH
    // var txtBoton = 'Pendiente',
    //     btnClass = 'btn-warning';

    row.append($("<td>" + "<a tabindex='1' class='btn btn-sm " + btnClass + " btnRevisar_rh' " +
                                                "data-idemp='" + rowInfo.employee + "' data-mov='" + rowInfo.id + "' data-razon='" + rowInfo.emp_observaciones + 
                                                "' data-empleado='" + rowInfo.emp_name + "' role='button'> " + txtBoton + " </a>" + "</td>"));

    // Activar POPOVER
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
    //BOTON REVISION RH
    $(".btnRevisar_rh").click( function(){
        revisarIncidencia($(this));
    });

    //ACTIVAR CAMPO DE BUSQUEDA
    $("#txtBuscar").removeAttr('disabled');
}

//VALIDAR INCIDENCIAS DEL EMPLEADO
async function revisarIncidencia(btnRevisar){
    var razon = btnRevisar.data('razon'),
        empleado = btnRevisar.data('empleado'),
        idempleado = $('#idemp').val(),
        accion = 'voboRH',
        idMovimiento = btnRevisar.data('mov');

    const {value: validacion} = await 
    swal({
          title: 'Validar incidencia',
          html: empleado + '</br> <b>Razón:</b> ' + razon,
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Revisado!',
          cancelButtonText: 'No Autorizar!',
          allowOutsideClick: false,
          allowEscapeKey: false
        })

    if ( validacion ){
        const {value: comentario} = await swal({
        title: 'Revisiar incidencias',
        input: 'text',
        type: 'info',
        inputValue: 'Validado por Recursos Humanos'
        })
        btnRevisar.removeClass('btn-warning');
        btnRevisar.removeClass('btn-danger');
        btnRevisar.text('Revisado');
        btnRevisar.addClass('btn-info');
        var status = 1;
        var datosAutorizado = new FormData();
        datosAutorizado.append('id', idMovimiento);
        datosAutorizado.append('status', status);
        datosAutorizado.append('accion', accion);
        datosAutorizado.append('idempleado', idempleado);
        datosAutorizado.append('observaciones_default', comentario);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                // console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    // console.log(respuesta);
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosAutorizado);     
    } else { 
        const {value: comentario} = await swal({
        title: 'Incidencias No autorizadas',
        input: 'text',
        type: 'warning',
        inputPlaceholder: 'Ingrese horas ej: 1.5 ',
        inputValue: 'No Autorizada'
        })       
        btnRevisar.text('No Autorizada');
        btnRevisar.removeClass('btn-warning');
        btnRevisar.removeClass('btn-info');
        btnRevisar.addClass('btn-danger');
        // btnRevisar.parents("tr").remove(); 
        var status = 2;
        var datosAutorizado = new FormData();
        datosAutorizado.append('id', idMovimiento);
        datosAutorizado.append('status', status);
        datosAutorizado.append('accion', accion);
        datosAutorizado.append('idempleado', idempleado);
        datosAutorizado.append('observaciones_default', comentario);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function(){
            if (this.status === 200) {
                var respuesta = JSON.parse(xmlhr.responseText);
                // console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    // console.log(respuesta);
                } else {
                    // Hubo un error
                    swal({
                        title: 'Error!',
                        text: 'Hubo un error',
                        type: 'error'
                    })
                }
            }
        }
        // Enviar la petición
        xmlhr.send(datosAutorizado); 
    }
}

//BUSQUEDA POR TEXTO
$('#txtBuscar').keyup(function() {
  var rango = $('#daterange_hhrr').val(),
      txtBuscado = this.value,
      idempleado = $('#idemp').val(),
      accion = 'consulta_rh',
      fechaInicial = rango.substring(0, 10),  
      fechafinal = rango.substring(13, 23); 
  // console.log(txtBuscado + ' ' + fechaInicial + '-' + fechafinal + ' ' + accion);
  $('#tablehhrr').empty();
  var consulta_parametros = new FormData();
      consulta_parametros.append('fechaINI', fechaInicial);
      consulta_parametros.append('fechaFIN', fechafinal);
      consulta_parametros.append('valorBuscado', txtBuscado);
      consulta_parametros.append('accion', accion);
      var xmlhr = new XMLHttpRequest();
      xmlhr.open('POST', 'inc/model/fetch.php', true);

      xmlhr.onload = function()
      {
      if (this.status === 200) {
        var respuesta = JSON.parse(xmlhr.responseText);
        // console.log(respuesta);
        if (respuesta.estado === 'correcto') {
          var informacion = respuesta.informacion;
          // console.log(informacion);
          for(var i in informacion){
              tablaRH(informacion[i]);
              $('#alertaR').hide();
              $('#avisoR').hide();
          }     
        } else if(respuesta.estado === 'error'){
          var informacion = respuesta.informacion;
          $('#alertaR').show();
          $('#avisoR').hide();
        }
      }
      }
      xmlhr.send(consulta_parametros);
});
