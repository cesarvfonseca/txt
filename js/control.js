let searchParams = new URLSearchParams(window.location.search)
let seccionActual = searchParams.get('request');

eventListeners_();
$('#txtDIV').hide();
$('#tabla-personalDIV').hide();
$('#txtcDIV').hide();
$('#vacacionesDIV').hide();
$('#panel-usuarioDIV').hide();
$('#panel-personalDIV').hide();
$('#panel-salidaTrabajo').hide();
$('#defaultDIV').show();

//EXPORTAR TABLA A EXCEL
$('.exportTableE').click(function () {
    $("#panelEmpleado").table2excel({
        containerid: ".table",
        datatype: 'table',
        name: "report",
        filename: "Reporte Empelado", // Here, you can assign exported file name
        fileext: ".xls"
    });
});

$('.exportTableP').click(function () {
    $("#panelPersonal").table2excel({
        containerid: ".table",
        datatype: 'table',
        name: "report",
        filename: "Reporte Jefe", // Here, you can assign exported file name
        fileext: ".xls"
    });
});

$('.exportTableRH').click(function () {
    $("#tablaRH").table2excel({
        containerid: ".table",
        datatype: 'table',
        name: "report",
        filename: "Reporte RH", // Here, you can assign exported file name
        fileext: ".xls"
    });
});

function eventListeners_() {
    if (document.querySelector('.nuevo-txt') !== null) {
        document.querySelector('.nuevo-txt').addEventListener('click', enviarTXT);
    }

    if (document.querySelector('.nuevo-txtc') !== null) {
        document.querySelector('.nuevo-txtc').addEventListener('click', enviarTXTC);
    }

    if (document.querySelector('.nuevo-vacaciones') !== null) {
        document.querySelector('.nuevo-vacaciones').addEventListener('click', enviarVACACIONES);
    }

}

switch (seccionActual) {
    case 'nominas':
        $('#btnRangoNominas').click(function (e) {
            e.preventDefault();

            var fechaInicial = $('#txtFechaINI').val(),
                fechafinal = $('#txtFechaFIN').val(),
                // txtBuscado = '',
                accion = 'consulta_nominas';
            //console.log(fechaInicial + ' ' + fechafinal + ' ');
            $('#tablanominas').empty();
            //LIMPIAR CAJA DE BUSQUEDA
            // $("#txtBuscar").val('');
            var consulta_rango_nominas = new FormData();
            consulta_rango_nominas.append('fechaINI', fechaInicial);
            consulta_rango_nominas.append('fechaFIN', fechafinal);
            // consulta_rango_rh.append('valorBuscado', txtBuscado);
            consulta_rango_nominas.append('accion', accion);
            var xmlhrnom = new XMLHttpRequest();
            xmlhrnom.open('POST', 'inc/model/fetch.php', true);

            xmlhrnom.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xmlhrnom.responseText);
                    //console.log(respuesta);
                    if (respuesta.estado === 'correcto') {
                        var informacion = respuesta.informacion;
                        console.log(informacion);
                        for (var i in informacion) {
                            tablaNominas(informacion[i]);
                            $('#alertaR').hide();
                            $('#avisoR').hide();
                        }
                    } else if (respuesta.estado === 'error') {
                        var informacion = respuesta.informacion;
                        $('#alertaR').show();
                        $('#avisoR').hide();
                    }
                }
            }
            xmlhrnom.send(consulta_rango_nominas);
        });

        function tablaNominas(rowInfo) {

            let row = $("<tr />")

            $("#tablanominas").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
            // NUMERO DE NOMINA DEL EMPLEADO
            row.append($("<td> " + rowInfo.numero_nomina + " </td>"));
            // NOMBRE DEL EMPLEADO
            row.append($("<td> " + rowInfo.nombre_largo + " </td>"));

            // NOMBRE DEL DEPARTAMENTO
            row.append($("<td> " + rowInfo.Departamento + " </td>"));
            // row.append($("<td> " + rowInfo.fechaINI.date.substring(0, 10) + ' Al ' + rowInfo.fechaFIN.date.substring(0, 10)  + " </td>"));
            row.append($("<td> " + rowInfo.fechaINI.date.substring(0, 10) + " </td>"));
            row.append($("<td> " + rowInfo.fechaFIN.date.substring(0, 10) + " </td>"));
            row.append($("<td> " + rowInfo.dias + " </td>"));
        }

        $('.exportTableNominas').click(function () {
            $("#tablaNominas").table2excel({
                containerid: ".table",
                datatype: 'table',
                name: "report",
                filename: "Reporte Nominas", // Here, you can assign exported file name
                fileext: ".xls"
            });
        });
        break;
    default:
        break;
}


$('#salida-trabajo').click(function (e) {
    e.preventDefault();
    var fecha = $('#txtFechat').val(),
        horas = $('#txtHorast').val(),
        razon = $('#txtRazont').val(),
        employeeID = $('#employeeID').val(),
        tipo = $('#typet').val(),
        nombre_empleado = $('#employee_name').val(),
        nombre_destinatario = $('#txtNamet').val(),
        correo_destinatario = $('#txtMailt').val();
    console.log(tipo)
    if (razon === '') {
        swal({
            type: 'error',
            title: 'Error!',
            text: 'Todos los campos son obligatorios!'
        })
    } else {
        var datosSTrabajo = new FormData();
        datosSTrabajo.append('fecha', fecha);
        datosSTrabajo.append('horas', horas);
        datosSTrabajo.append('razon', razon);
        datosSTrabajo.append('employeeID', employeeID);
        datosSTrabajo.append('n_empleado', nombre_empleado);
        datosSTrabajo.append('n_destinatario', nombre_destinatario);
        datosSTrabajo.append('c_destinatario', correo_destinatario);
        datosSTrabajo.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function () {
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
                            if (resultado.value) {
                                location.reload();
                            }
                        })
                } else if (respuesta.estado === 'incorrecto') {
                    swal({
                        title: 'Error en proceso!',
                        text: respuesta.mensaje,
                        type: 'warning'
                    })
                        .then(resultado => {
                            if (resultado.value) {
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
        xmlhr.send(datosSTrabajo);
    }
});

function enviarVACACIONES(e) {
    e.preventDefault();
    document.querySelector('.nuevo-vacaciones').removeEventListener('click', enviarVACACIONES);
    var fechaINI = document.querySelector('#fechaINI').value,
        fechaFIN = document.querySelector('#fechaFIN').value,
        razon = document.querySelector('#txtRazonv').value,
        employeeID = document.querySelector('#employeeIDv').value,
        tipo = document.querySelector('#typev').value,
        nombre_empleado = document.querySelector('#employee_name').value,
        nombre_destinatario = document.querySelector('#txtNamev').value,
        correo_destinatario = document.querySelector('#txtMailv').value;

    // console.log(fechaINI+' '+fechaFIN+' '+razon+' '+employeeID+' '+tipo);

    if (razon === '') {
        swal({
            type: 'error',
            title: 'Error!',
            text: 'Todos los campos son obligatorios!'
        })
    }
    else {
        var datosVAC = new FormData();
        datosVAC.append('fechaINI', fechaINI);
        datosVAC.append('fechaFIN', fechaFIN);
        datosVAC.append('razon', razon);
        datosVAC.append('employeeID', employeeID);
        datosVAC.append('n_empleado', nombre_empleado);
        datosVAC.append('n_destinatario', nombre_destinatario);
        datosVAC.append('c_destinatario', correo_destinatario);
        datosVAC.append('accion', tipo);
        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xhr = new XMLHttpRequest();

        xhr.open('POST', 'inc/model/control.php', true);
        xhr.onload = function () {
            if (this.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);
                // console.log(respuesta);
                if (respuesta.estado === 'correcto') {
                    let info = respuesta.informacion;
                    if (info.length === 0) {
                        swal({
                            title: 'Guardado exitoso!',
                            text: 'Guardado de la información exitosa!',
                            type: 'success'
                        })
                            .then(resultado => {
                                if (resultado.value) {
                                    location.reload();
                                }
                            })
                    } else {
                        swal({
                            title: 'Guardado exitoso!',
                            text: 'Excepto los dias siguientes por ser feriados y/o no laborables: ' + info,
                            type: 'success'
                        })
                            .then(resultado => {
                                if (resultado.value) {
                                    location.reload();
                                }
                            })
                    }
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

function enviarTXT(e) {
    e.preventDefault();
    document.querySelector('.nuevo-txt').removeEventListener('click', enviarTXT);
    var fecha = document.querySelector('#txtFecha').value,
        horas = document.querySelector('#txtHoras').value,
        motivo = document.querySelector('#txtMotivoF').value,
        razon = document.querySelector('#txtRazon').value,
        employeeID = document.querySelector('#employeeID').value,
        tipo = document.querySelector('#type').value,
        nombre_empleado = document.querySelector('#employee_name').value,
        nombre_destinatario = document.querySelector('#txtName').value,
        correo_destinatario = document.querySelector('#txtMail').value

    if (fecha === '' || horas === '' || razon === '') {
        swal({
            type: 'error',
            title: 'Error!',
            text: 'Todos los campos son obligatorios!'
        })
    } else {
        var datosTXT = new FormData();
        datosTXT.append('fecha', fecha);
        datosTXT.append('horas', horas);
        datosTXT.append('motivo', motivo);
        datosTXT.append('razon', razon);
        datosTXT.append('employeeID', employeeID);
        datosTXT.append('n_empleado', nombre_empleado);
        datosTXT.append('n_destinatario', nombre_destinatario);
        datosTXT.append('c_destinatario', correo_destinatario);
        datosTXT.append('accion', tipo);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();

        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function () {
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
                            if (resultado.value) {
                                location.reload();
                            }
                        })
                } else if (respuesta.estado === 'incorrecto') {
                    swal({
                        title: 'Error en proceso!',
                        text: respuesta.mensaje,
                        type: 'warning'
                    })
                        .then(resultado => {
                            if (resultado.value) {
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

function enviarTXTC(e) {
    e.preventDefault();
    document.querySelector('.nuevo-txtc').removeEventListener('click', enviarTXTC);
    var fecha = document.querySelector('#txtFechac').value,
        horas = document.querySelector('#txtHorasc').value,
        motivo = document.querySelector('#txtMotivoC').value,
        razon = document.querySelector('#txtRazonc').value,
        employeeID = document.querySelector('#employeeIDc').value,
        tipo = document.querySelector('#typec').value,
        nombre_empleado = document.querySelector('#employee_name').value,
        nombre_destinatario = document.querySelector('#txtNamec').value,
        correo_destinatario = document.querySelector('#txtMailc').value,
        saldoHoras = document.querySelector('#saldoHoras').value;
    //console.log(nombre_empleado + ' ' + nombre_destinatario + ' ' + correo_destinatario + ' ' + tipo);

    if (saldoHoras <= -48) {
        swal({
            type: 'error',
            title: 'Horas en contra excedidas!',
            text: 'Tu saldo de horas negativas es mayor a las permitidas, no puedes generar la solicitur'
        })
    } else {
        if (fecha === '' || horas === '' || razon === '') {
            swal({
                type: 'error',
                title: 'Error!',
                text: 'Todos los campos son obligatorios!'
            })
        } else {
            var datosTXT = new FormData();
            datosTXT.append('fecha', fecha);
            datosTXT.append('horas', horas);
            datosTXT.append('motivo', motivo);
            datosTXT.append('razon', razon);
            datosTXT.append('employeeID', employeeID);
            datosTXT.append('n_empleado', nombre_empleado);
            datosTXT.append('n_destinatario', nombre_destinatario);
            datosTXT.append('c_destinatario', correo_destinatario);
            datosTXT.append('accion', tipo);

            // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
            var xmlhr = new XMLHttpRequest();

            //ABRIR LA CONEXION
            xmlhr.open('POST', 'inc/model/control.php', true);
            // VERIFICAR LA RESPUESTA DEL SERVICIO
            xmlhr.onload = function () {
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
                                if (resultado.value) {
                                    location.reload();
                                }
                            })
                    } else if (respuesta.estado === 'incorrecto') {
                        swal({
                            title: 'Error en proceso!',
                            text: respuesta.mensaje,
                            type: 'warning'
                        })
                            .then(resultado => {
                                if (resultado.value) {
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
}

function getComboA(selectObject) {
    var value = selectObject.value;
    if (value == 'txt') {
        $('#txtDIV').show();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').hide();
        cargarMotivos();
        console.log('VALOR TXT SELECCIONADO');
    }
    else if (value == 'txtc') {
        $('#txtDIV').hide();
        $('#txtcDIV').show();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').hide();
        cargarMotivos();
        console.log('VALOR TXTC SELECCIONADO');
    }
    else if (value == 'salida-trabajo') {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').show();
        console.log('VALOR SALIDAS POR TRABAJO');
    }
    else if (value == 'vacaciones') {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').show();
        $('#defaultDIV').hide();
        $('#panel-personalDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').hide();
        console.log('VALOR VACACIONES SELECCIONADO');
    } else if (value == 'panel-usuario') {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').show();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').hide();
        console.log('VALOR PANEL SELECCIONADO');
    } else if (value == 'panel-personal') {
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').show();
        $('#defaultDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#panel-salidaTrabajo').hide();
        console.log('VALOR PANEL PERSONAL SELECCIONADO');
    } else if (value == 'tabla-personal') {
        let nomina_actvo = $('#employeeID').val();
        $('#txtDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').hide();
        $('#tabla-personalDIV').show();
        $('#panel-salidaTrabajo').hide();
        mostrarTablaPersonal(nomina_actvo);
        console.log('VALOR TABLA PERSONAL SELECCIONADO');
    } else if (value == 'non') {
        $('#txtDIV').hide();
        $('#tabla-personalDIV').hide();
        $('#txtcDIV').hide();
        $('#vacacionesDIV').hide();
        $('#panel-usuarioDIV').hide();
        $('#panel-personalDIV').hide();
        $('#defaultDIV').show();
        $('#panel-salidaTrabajo').hide();
        console.log('NINGUN PANEL SELECCIONADO');
    }
}

let cargarMotivos = () => {
    let txtMotivos = $('.txtMotivo');
    $.ajax({
        type: 'POST',
        url: 'inc/model/fetch.php',
        data: { accion: 'obtenerMotivos' },
        success: function (response) {
            let respuesta = JSON.parse(response);
            //console.log(respuesta);
            let motivos = respuesta.informacion,
                campo = '';
            for (var i in motivos) {
                campo += '<option value="' + motivos[i].code_value + '">' + motivos[i].code_value_desc + '</option>';
            }
            txtMotivos.html(campo);
        }
    });
}

//FUNCION MOSTRAR DATOS TABLA EMPLEADOS
let mostrarTablaPersonal = (numero_nomina) => {
    $('#tablaPersonal').empty();
    $.ajax({
        type: 'POST',
        url: 'inc/model/fetch.php',
        data: { accion: 'tabla-personal', param: numero_nomina },
        success: function (response) {
            var respuesta = JSON.parse(response);
            if (respuesta.estado === 'correcto') {
                var datos = respuesta.informacion.length;
                var informacion = respuesta.informacion;
                if (datos < 1) {
                    $('#alerta').removeClass('d-none');
                }
                else {
                    $('#alerta').addClass('d-none');
                    for (var i in informacion) {
                        tablaPersonal(informacion[i]);
                    }
                }
            }
        }
    });

    let tablaPersonal = (rowInfo) => {
        var row = $("<tr>");
        $("#tablaPersonal").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it id_empleado
        row.append($("<td>" + rowInfo.employee + " </td>"));
        row.append($("<td>" + rowInfo.nombre_largo + " </td>"));
        row.append($("<td>" + rowInfo.txt_favor + " </td>"));
        row.append($("<td>" + rowInfo.txt_contra + " </td>"));
        row.append($("<td>" + rowInfo.txt_saldo + " </td>"));
        row.append($("<td>" + rowInfo.dias + "</td>"));
    }
}

//FUNCION EDITAR REGISTROS DEL EMPLEADO
async function editarRegistros(btnEditar) {
    var idempleado = btnEditar.data('idemp'),
        idmov = btnEditar.data('mov'),
        horas_bd = btnEditar.data('horas'),
        accion = 'editar_incidencia';
    const { value: horas } = await swal({
        title: 'Modificar Horas',
        input: 'text',
        inputPlaceholder: 'Ingrese horas ej: 1.5 ',
        inputValue: horas_bd
    })

    if (horas) {
        var editar_registro = new FormData();
        editar_registro.append('horas', horas);
        editar_registro.append('idempleado', idempleado);
        editar_registro.append('idmov', idmov);
        editar_registro.append('accion', accion);

        // CREAR LA INSTANCIA AJAX PARA EL LLAMADO
        var xmlhr = new XMLHttpRequest();
        //ABRIR LA CONEXION
        xmlhr.open('POST', 'inc/model/control.php', true);
        // VERIFICAR LA RESPUESTA DEL SERVICIO
        xmlhr.onload = function () {
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

    } else {
        swal(
            'Error!',
            'Las horas no pueden ir vacias',
            'error'
        )
    }

}

//FUNCION ELIMINAR REGISTROS DE LA TABLA EMPLEADO
function eliminarRegistros(btnEliminar) {
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
            xmlhr.onload = function () {
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
function eliminar_registrosViejos(args) {
    // console.log(args);
    var accion = 'eliminar_regviejos';
    var eliminar_registros_viejos = new FormData();
    eliminar_registros_viejos.append('id_empleado', args);
    eliminar_registros_viejos.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/control.php', true);
    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            // console.log('DESDE PHP: ' + respuesta);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                // console.log('DESDE PHP: ' + informacion);
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                // console.log('DESDE PHP: ' + informacion);
            }
        } empty
    }
    xmlhr.send(eliminar_registros_viejos);
}

/****PANEL DEL USUARIO*/
$('#btnRangoUsuario').unbind().click(function (e) {
    e.preventDefault();
    let fechaInicial = $('#txtFechaINI').val(),
        fechafinal = $('#txtFechaFIN').val(),
        employeeID = $('#employeeID').val(),
        accion = 'consulta';
    // console.log(fechaInicial + ' ' + fechafinal + ' ' + employeeID);
    $('#bodyTable').empty();
    var consulta_rango = new FormData();
    consulta_rango.append('fechaINI', fechaInicial);
    consulta_rango.append('fechaFIN', fechafinal);
    consulta_rango.append('employeeID', employeeID);
    consulta_rango.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                // console.log(informacion);
                for (var i in informacion) {
                    drawRow(informacion[i]);
                    $('#alerta').hide();
                    $('#aviso').hide();
                }
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                $('#alerta').show();
                $('#aviso').hide();
            }
        }
    }
    xmlhr.send(consulta_rango);
});

function drawRow(rowData) {
    let horaE = '',
        horaS = '';
    if (rowData.horaEntrada === null || rowData.horaSalida === null) {
        horaE = 'N/A';
        horaS = 'N/A';
    } else {
        horaE = rowData.horaEntrada.date.substr(10, 6),
            horaS = rowData.horaSalida.date.substr(10, 6);
    }
    var row = $("<tr />");
    $("#bodyTable").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    //COLUMNA TIPO
    row.append($("<td class='tipo_incidencia'><b>" + rowData.tipo_incidencia + "</td>"));
    //COLUMNA TIPO
    row.append($("<td class='d-none'>N/A</td>"));
    //COLUMNA COMENTARIO
    row.append($("<td class='tdObservaciones'><div>" + rowData.emp_observaciones + "</div></td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowData.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowData.tipo !== 3) {
        row.append($("<td><b>" + horaE + "</td>"));
        row.append($("<td><b>" + horaS + "</td>"));
        row.append($("<td class='row_hours'><b>" + rowData.horas + "</td>"));
    } else {
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
    }
    //COLUMNA AUTORIZACION DEL JEFE
    row.append($("<td id='vobo'>" + rowData.voboJefe + "</td>"));
    //COLUMNA COMENTARIO JEFE
    row.append($("<td class='tdObservaciones'><div>" + rowData.jefe_observaciones + "</div></td>"));
    //COLUMNA VOBO RH
    row.append($("<td id='vobo'><b>" + rowData.voboRH + "</td>"));
    //COLUMNA COMENTARIO RH
    row.append($("<td class='tdObservaciones'><div>" + rowData.rh_observaciones + "</div></td>"));
    //COLUMNA ACCIONES
    if (rowData.tipo === 3) {
        row.append($("<td class='text-center'>" + "<a tabindex='0' class='btn btn-sm btn-secondary disabled' role='button'>" +
            "<i class='fas fa-pen-square'></i> Editar</a>   " +
            "<a tabindex='1' class='btn btn-sm btn-danger btnEliminar' data-idemp='" + rowData.employee + "' data-mov='" +
            rowData.id + "' role='button'><i class='fas fa-trash-alt'></i> Eliminar</a>" + "</td>"));
    } else {
        row.append($("<td class='text-center'>" + "<a tabindex='0' class='btn btn-sm btn-primary btnEditar' data-horas='" + rowData.horas + "'" +
            " data-idemp='" + rowData.employee + "' data-mov='" + rowData.id + "' role='button'>" +
            "<i class='fas fa-pen-square'></i> Editar</a>   " +
            "<a tabindex='1' class='btn btn-sm btn-danger btnEliminar' data-idemp='" + rowData.employee + "' data-mov='" +
            rowData.id + "' role='button'><i class='fas fa-trash-alt'></i> Eliminar</a>" + "</td>"));
    }
    var voboJefe = $('#vobojefe').text(),
        rowLine = $('td').text();

    var $rows = $('#bodyTable tr #vobo');
    $rows.each(function (i, item) {
        $this = $(item);
        if ($this.text().trim() == 'Pendiente') {
            $this.addClass('alert-warning');
        } else if ($this.text().trim() == 'Autorizado') {
            $this.addClass('alert-success text-white');
        } else if ($this.text().trim() == 'No Autorizado') {
            $this.addClass('alert-danger text-white');
        }
    });

    // Activar POPOVER
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    //EDITAR REGISTRO
    $(".btnEditar").click(function () {
        editarRegistros($(this));
    });

    // Borrar Registros
    $(".btnEliminar").click(function () {
        eliminarRegistros($(this));
    });

    eliminar_registrosViejos(rowData.employee);

}

//PANEL JEFES
$('#btnRangoJefe').unbind().click(function (e) {
    e.preventDefault();
    let fechaInicial = $('#txtFechaINIPP').val(),
        fechafinal = $('#txtFechaFINPP').val(),
        employeeID = '',
        empleado_aut = $('#employeeID').val(),
        accion = 'consulta_jefe';

    console.log('FI ' + fechaInicial + 'FF ' + fechafinal + 'EID ' + employeeID + ' ' + accion);
    $('#tablaPersonal').empty();
    var consulta_rango = new FormData();
    consulta_rango.append('fechaINI', fechaInicial);
    consulta_rango.append('fechaFIN', fechafinal);
    consulta_rango.append('employeeID', employeeID);
    consulta_rango.append('empleado_aut', empleado_aut);
    consulta_rango.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            console.log(respuesta);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                console.log(informacion);
                for (var i in informacion) {
                    tablaPersonal(informacion[i]);
                    $('#alertaM').hide();
                    $('#avisoM').hide();
                }
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                $('#alertaM').show();
                $('#avisoM').hide();
            }
        }
    }
    xmlhr.send(consulta_rango);
});

function tablaPersonal(rowInfo) {
    let horaE = '',
        horaS = '';
    if (rowInfo.horaEntrada === null || rowInfo.horaSalida === null) {
        horaE = 'N/A';
        horaS = 'N/A';
    } else {
        horaE = rowInfo.horaEntrada.date.substr(10, 6),
            horaS = rowInfo.horaSalida.date.substr(10, 6);
    }

    var row = $("<tr />"),
        txtBoton = 'Pendiente',
        trClass = 'alert-warning',//CLASE VOBORH
        btnClass = 'btn-warning';
    if (rowInfo.jefe_autorizacion === 1) {
        txtBoton = 'Autorizada',
            btnClass = 'btn-success';
    } else if (rowInfo.jefe_autorizacion === 2) {
        txtBoton = 'No Autorizada',
            btnClass = 'btn-danger';
    }
    if (rowInfo.rh_vobo === 1) {
        trClass = 'alert-success';
    } else if (rowInfo.rh_vobo === 2) {
        trClass = 'alert-danger';
    }
    $("#tablaPersonal").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    // NUMERO DE NOMINA DEL EMPLEADO
    row.append($("<td> <b>" + rowInfo.employee + " </b> </td>"));
    // NOMBRE DEL EMPLEADO
    row.append($("<td> <b>" + rowInfo.nombre_largo + " </b> </td>"));
    //TIPO DE INCIDENCIA
    row.append($("<td class='tipo_incidencia'><b>" + rowInfo.tipo_incidencia + "</td>"));
    //COLUMNA MOTIVO EMPLEADO
    row.append($("<td class='d-none'>N/A</td>"));
    //COLUMNA COMENTARIO EMPLEADO
    row.append($("<td class='tdObservaciones'>" + rowInfo.emp_observaciones + "</td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowInfo.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowInfo.tipo !== 3) {
        row.append($("<td><b>" + horaE + "</td>"));
        row.append($("<td><b>" + horaS + "</td>"));
        row.append($("<td class='row_hours'><b>" + rowInfo.horas + "</td>"));
    } else {
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
        row.append($("<td> <b>" + 'N/A' + " </b> </td>"));
    }
    //COLUMNA VOBO RH
    row.append($("<td class='" + trClass + "'><b>" + rowInfo.voboRH + "</td>"));
    //COLUMNA COMENTARIO RH
    row.append($("<td class='" + trClass + " tdObservaciones'>" + rowInfo.rh_observaciones + "</td>"));
    //COLUMNA COMENTARIO JEFE
    row.append($("<td class='tdObservaciones'>" + rowInfo.jefe_observaciones + "</td>"));
    //COLUMNA AUTORIZACION DEL JEFE
    row.append($("<td class='autorizado'>" + "<a tabindex='1' class='btn btn-sm " + btnClass + " btnRevisar' " +
        "data-idemp='" + rowInfo.employee + "' data-mov='" + rowInfo.id + "' data-razon='" + rowInfo.emp_observaciones +
        "' data-empleado='" + rowInfo.nombre_largo + "' role='button'> " + txtBoton + " </a>" + "</td>"));


    // Activar POPOVER
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    //BOTON AUTORIZAR JEFES
    $(".btnRevisar").click(function () {
        validarIncidencia($(this));
    });
}

//VALIDAR INCIDENCIAS DEL EMPLEADO
async function validarIncidencia(btnValidar) {
    var razon = btnValidar.data('razon'),
        empleado = btnValidar.data('empleado'),
        idempleado = $('#employeeID').val(),
        accion = 'voboJefe',
        idMovimiento = btnValidar.data('mov');

    const { value: validacion } = await
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

    if (validacion) {
        const { value: comentario } = await swal({
            title: 'Incidencias Autorizadas',
            input: 'text',
            type: 'info',
            inputPlaceholder: 'Ingresar comentario',
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
        xmlhr.onload = function () {
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
        const { value: comentario } = await swal({
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
        xmlhr.onload = function () {
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
$('#btnRangoRH').click(function (e) {
    e.preventDefault();

    var fechaInicial = $('#txtFechaINI').val(),
        fechafinal = $('#txtFechaFIN').val(),
        txtBuscado = '',
        accion = 'consulta_rh';
    //console.log(fechaInicial + ' ' + fechafinal + ' ');
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

    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            //console.log(respuesta);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                //console.log(informacion);
                for (var i in informacion) {
                    tablaRH(informacion[i]);
                    $('#alertaR').hide();
                    $('#avisoR').hide();
                }
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                $('#alertaR').show();
                $('#avisoR').hide();
            }
        }
    }
    xmlhr.send(consulta_rango_rh);
});

function tablaRH(rowInfo) {
    let horaE = '',
        horaS = '',
        jl = 0,
        jlStyle = 'alert-warning',
        jlv = 'Error';

    if (rowInfo.tipo === 1) {
        jl = parseFloat(rowInfo.horas) * 60;
        if ((parseFloat(rowInfo.jornada) - 600) > jl) {
            jlv = 'OK';
            jlStyle = 'alert-primary';
        }
    } else if (rowInfo.tipo === 2) {
        jl = parseFloat(rowInfo.horas) * 60;
        if ((600 - jl) > (parseFloat(rowInfo.jornada) / 60)) {
            jlv = 'OK';
            jlStyle = 'alert-primary';
        }
    } else if (rowInfo.tipo === 3) {
        jlv = 'N/A';
        jlStyle = 'alert-primary';
    }


    if (rowInfo.horaEntrada === null || rowInfo.horaSalida === null) {
        horaE = 'N/A';
        horaS = 'N/A';
    } else {
        horaE = rowInfo.horaEntrada.date.substr(10, 6),
            horaS = rowInfo.horaSalida.date.substr(10, 6);
    }

    var row = $("<tr />"),
        txtBoton = 'Pendiente',
        trClass = 'alert-warning',//CLASE VOBORH
        btnClass = 'btn-warning';
    if (rowInfo.rh_vobo === 1) {
        txtBoton = 'Revisada',
            btnClass = 'btn-info';
    } else if (rowInfo.rh_vobo === 2) {
        txtBoton = 'No Autorizada',
            btnClass = 'btn-danger';
    }
    if (rowInfo.jefe_autorizacion === 1) {
        trClass = 'alert-success';
    } else if (rowInfo.jefe_autorizacion === 2) {
        trClass = 'alert-danger';
    }
    $("#tablehhrr").append(row); //this will append tr element to table... keep its reference for a while since we will add cels into it
    // NUMERO DE NOMINA DEL EMPLEADO
    row.append($("<td> " + rowInfo.employee + " </td>"));
    // NOMBRE DEL EMPLEADO
    row.append($("<td> " + rowInfo.nombre_largo + " </td>"));

    // NOMBRE DEL DEPARTAMENTO
    row.append($("<td> " + rowInfo.departamento + " </td>"));
    //TIPO DE INCIDENCIA
    row.append($("<td class='tipo_incidencia'><b>" + rowInfo.tipo_incidencia + "</td>"));
    //COLUMNA MOTIVO
    row.append($("<td class='d-none'>N/A</td>"));
    //COLUMNA COMENTARIO EMPLEADO
    row.append($("<td class='tdObservaciones'>" + rowInfo.emp_observaciones + "</td>"));
    //COLUMNA FECHA
    row.append($("<td>" + rowInfo.fecha.date.substring(0, 10) + "</td>"));
    //COLUMNA HORAS
    if (rowInfo.tipo !== 3) {
        row.append($("<td><b>" + horaE + "</td>"));
        row.append($("<td><b>" + horaS + "</td>"));
        row.append($("<td class='row_hours'>" + rowInfo.horas + "</td>"));
    } else {
        row.append($("<td>" + 'N/A' + "</td>"));
        row.append($("<td>" + 'N/A' + "</td>"));
        row.append($("<td>" + 'N/A' + "</td>"));
    }
    // VALIDAR  JORANDA
    row.append($("<td class='" + jlStyle + "'><b>" + jlv + "</td>"));
    //COLUMNA VOBO JEFE
    row.append($("<td class='" + trClass + "'><b>" + rowInfo.voboJefe + "</td>"));
    //COLUMNA COMENTARIO RH
    row.append($("<td class='" + trClass + " tdObservaciones'>" + rowInfo.jefe_observaciones + "</td>"));
    //COLUMNA COMENTARIO JEFE
    row.append($("<td class='tdObservaciones'>" + rowInfo.rh_observaciones + "</td>"));
    //COLUMNA BOTON VOBO RH
    row.append($("<td>" + "<a tabindex='1' class='btn btn-sm " + btnClass + " btnRevisar_rh' " +
        "data-idemp='" + rowInfo.employee + "' data-mov='" + rowInfo.id + "' data-razon='" + rowInfo.emp_observaciones +
        "' data-empleado='" + rowInfo.nombre_largo + "' role='button'> " + txtBoton + " </a>" + "</td>"));

    // Activar POPOVER
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
    //BOTON REVISION RH
    $(".btnRevisar_rh").click(function () {
        revisarIncidencia($(this));
    });

    //ACTIVAR CAMPO DE BUSQUEDA
    $("#txtBuscar").removeAttr('disabled');
    $("#txtsearchvh").removeAttr('disabled');
}

$("#txtsearchvh").change(function () {
    var value = $(this).val().toLowerCase();
    $("#tablehhrr tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

//VALIDAR INCIDENCIAS DEL EMPLEADO
async function revisarIncidencia(btnRevisar) {
    var razon = btnRevisar.data('razon'),
        empleado = btnRevisar.data('empleado'),
        idempleado = $('#idemp').val(),
        accion = 'voboRH',
        idMovimiento = btnRevisar.data('mov');

    const { value: validacion } = await
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

    if (validacion) {
        const { value: comentario } = await swal({
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
        xmlhr.onload = function () {
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
        const { value: comentario } = await swal({
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
        xmlhr.onload = function () {
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
$('#txtBuscar').keyup(function () {
    var txtBuscado = this.value,
        idempleado = $('#idemp').val(),
        accion = 'consulta_rh',
        fechaInicial = $('#txtFechaINI').val(),
        fechafinal = $('#txtFechaFIN').val();
    // console.log(txtBuscado + ' ' + fechaInicial + '-' + fechafinal + ' ' + accion);
    $('#tablehhrr').empty();
    var consulta_parametros = new FormData();
    consulta_parametros.append('fechaINI', fechaInicial);
    consulta_parametros.append('fechaFIN', fechafinal);
    consulta_parametros.append('valorBuscado', txtBuscado);
    consulta_parametros.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            // console.log(respuesta);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                ///console.log(informacion);
                for (var i in informacion) {
                    tablaRH(informacion[i]);
                    $('#alertaR').hide();
                    $('#avisoR').hide();
                }
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                $('#alertaR').show();
                $('#avisoR').hide();
            }
        }
    }
    xmlhr.send(consulta_parametros);
});

//PANEL DE AUTORIZACION DEL CORREO
var empleado_aut = $('#emp_id_a').val();
if (empleado_aut !== null) {
    // console.log(empleado_aut);
    var fechaInicial = $('#fecha_a').val(),
        fechafinal = $('#fecha_b').val(),
        employeeID = 'NA',
        accion = 'consulta_jefe_correo';

    //console.log(empleado_aut, fechaInicial, fechafinal);
    // $('.tablaPersonal').empty();
    var consulta_rango = new FormData();
    consulta_rango.append('fechaINI', fechaInicial);
    consulta_rango.append('fechaFIN', fechafinal);
    consulta_rango.append('employeeID', empleado_aut);
    consulta_rango.append('empleado_aut', employeeID);
    consulta_rango.append('accion', accion);
    var xmlhr = new XMLHttpRequest();
    xmlhr.open('POST', 'inc/model/fetch.php', true);

    xmlhr.onload = function () {
        if (this.status === 200) {
            var respuesta = JSON.parse(xmlhr.responseText);
            //console.log(respuesta);
            if (respuesta.estado === 'correcto') {
                var informacion = respuesta.informacion;
                console.log(informacion);
                for (var i in informacion) {
                    tablaPersonal(informacion[i]);
                    $('#alertaM').hide();
                    $('#avisoM').hide();
                }
            } else if (respuesta.estado === 'error') {
                var informacion = respuesta.informacion;
                $('#alertaM').show();
                $('#avisoM').hide();
            }
        }
    }
    xmlhr.send(consulta_rango);
};
