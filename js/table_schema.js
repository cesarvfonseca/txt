$(document).ready(function(){
	console.info('hola');


//PANEL RRHH
$('#daterange_hhrr').daterangepicker();
$('#daterange_hhrr').on('apply.daterangepicker', function(ev, picker) {

    var fechaInicial = picker.startDate.format('YYYY-MM-DD'),
        fechafinal = picker.endDate.format('YYYY-MM-DD'),
        employeeID = $('#employeeID').val(),
        accion = 'consulta_jefe';
    console.log(fechaInicial + ' ' + fechafinal + ' ' + employeeID);
    // $('.tablaPersonal').empty();
    // var consulta_rango = new FormData();
    // consulta_rango.append('fechaINI', fechaInicial);
    // consulta_rango.append('fechaFIN', fechafinal);
    // consulta_rango.append('employeeID', employeeID);
    // consulta_rango.append('accion', accion);
    // var xmlhr = new XMLHttpRequest();
    // xmlhr.open('POST', 'inc/model/fetch.php', true);

    // xmlhr.onload = function(){
    // if (this.status === 200) {
    //   var respuesta = JSON.parse(xmlhr.responseText);
    //   // console.log(respuesta);
    //   if (respuesta.estado === 'correcto') {
    //     var informacion = respuesta.informacion;
    //     // console.log(informacion);
    //     for(var i in informacion){
    //         tablaPersonal(informacion[i]);
    //         $('#alertaM').hide();
    //         $('#avisoM').hide();
    //     }     
    //   } else if(respuesta.estado === 'error'){
    //     var informacion = respuesta.informacion;
    //     $('#alertaM').show();
    //     $('#avisoM').hide();
    //   }
    // }
    // }
    // xmlhr.send(consulta_rango);
});


});