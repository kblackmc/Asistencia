$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Asistencia</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar Personal:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    $(document).ready(function(){
        tablaAsistencias = $("#tablaAsistencias").DataTable({
           "columnDefs":[{
            "targets": -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnBorrar'>Eliminar</button></div></div>"  
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
    
    });
    });
});


    
    var fila; //capturar la fila para editar o borrar el registro
    $("#btnNuevo").click(function(){
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Personal");            
        $("#modalCRUD").modal("show");  
        id=null;
        opcion = 1; //alta
    });  
      //botón BORRAR
      $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        nombres = $(this).closest("tr").find('td:eq(1)').text();
        dni = $(this).closest("tr").find('td:eq(2)').text();
        fecha = $(this).closest("tr").find('td:eq(5)').text();
        opcion = 2 //borrar
        var respuesta = confirm("¿Está seguro de eliminar la asistencia del empleado : " +nombres+ " con número de DNI "+ dni+ " ID " +id+ "? con Fecha "+fecha+"");
        if(respuesta){
            $.ajax({
                url: "bd/asistencias.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaAsistencias.row(fila.parents('tr')).remove().draw();
                }
            });
            $("#modalCRUD").modal("hide");    
        }   
    });

    var fila; //capturar la fila para editar o borrar el registro
    
    //botón EDITAR    
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        nombres = fila.find('td:eq(1)').text();
        dni = parseInt(fila.find('td:eq(3)').text());
        puesto =fila.find('td:eq(4)').text();
        centrocostos = fila.find('td:eq(5)').text();    
        $("#nombres").val(nombres);
        $("#dni").val(dni);
        $("#puesto").val(puesto);
        $("#centrocostos").val(centrocostos);
        opcion = 1; //editar
        
        $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Asistencia");            
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
        if(nombres.length == "" || dni.length == "" || puesto.length == ""|| centrocostos.length == ""){
            Swal.fire({
                type:'error',
                title:'Nombres y DNI vacios',
            });
            return false; 
          }else{   
        $.ajax({
            url: "bd/asistencias.php",
            type: "POST",
            dataType: "json",
            data: {nombres:nombres, dni:dni,puesto:puesto,centrocostos:centrocostos,fecha:fecha,entrada:entrada,salida:salida, opcion:opcion},
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
                opcion == 1;
                tablaAsistencias.row.add([id,nombres,dni,puesto,centrocostos,fecha,entrada,salida]).draw();
              
                       
            }        
        });
        $("#modalCRUD").modal("hide");    
          }    
    });  
  



