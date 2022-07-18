$(document).ready(function(){
    tablaAsistencias = $("#tablaAsistencias").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar Asistencias:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }

});$("#btnNuevo").click(function(){
   $("#formPersonas").trigger("reset");
   $(".modal-header").css("background-color", "#1cc88a",);
   $(".modal-header").css("color", "white");
   $(".modal-title").text("Nuevo Puesto");            
   $("#modalCRUD").modal("show");        
   id=null;
   opcion = 1; //alta
});    
   
var fila; //capturar la fila para editar o borrar el registro
   
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
   fila = $(this).closest("tr");
   id = parseInt(fila.find('td:eq(0)').text());
   nombres = fila.find('td:eq(1)').text();
   dni = fila.find('td:eq(2)').text();
   puesto = fila.find('td:eq(3)').text();
   centrocostos = fila.find('td:eq(4)').text();
   fecha = fila.find('td:eq(5)').text();
   entrada = fila.find('td:eq(6)').text();
   salida = fila.find('td:eq(7)').text();
   

   $("#nombres").val(nombres);
   $("#dni").val(dni);
   $("#puesto").val(puesto);
   $("#centrocostos").val(centrocostos);
   $("#fecha").val(fecha);
   $("#entrada").val(entrada);
   $("#salida").val(salida);
   opcion = 3; //editar
   
   $(".modal-header").css("background-color", "#4e73df");
   $(".modal-header").css("color", "white");
   $(".modal-title").text("Editar Asistencia");            
   $("#modalCRUD").modal("show");  
   
});

$("#formPersonas").submit(function(e){
   e.preventDefault();    
   nombres = $.trim($("#nombres").val());
   dni = $.trim($("#dni").val());
   puesto = $.trim($("#puesto").val());
   centrocostos = $.trim($("#centrocostos").val());
   fecha = $.trim($("#fecha").val());
   entrada = $.trim($("#entrada").val());
   salida = $.trim($("#salida").val());
   if(nombres.length == "" || dni.length == ""){
       Swal.fire({
           type:'error',
           title:'nombre y dni vacio',
       });
       return false; 
     }else{   
   $.ajax({
       url: "bd/asistencias.php",
       type: "POST",
       dataType: "json",
       data: { nombres:nombres, dni:dni, puesto:puesto,centrocostos:centrocostos,fecha:fecha,entrada:entrada,salida:salida, id:id, opcion:opcion},
       success: function(data){  
           console.log(data);
           id = data[0].id;   
           nombres = data[0].nombres;
           dni = data[0].dni;         
           puesto = data[0].puesto;
           centrocostos = data[0].centrocostos;
           fecha = data[0].fecha;
           entrada = data[0].entrada;
           salida = data[0].salida;
           tablaAsistencias.row(fila).data([id,nombres,dni,puesto,centrocostos,fecha,entrada,salida]).draw();         
       }        
   });
   Swal.fire(
      'Datos Actulizados!',
      'Correctamente!',
      'success'
      
    )
   $("#modalCRUD").modal("hide");    
     }    
});  

});