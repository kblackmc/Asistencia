$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros de centro de costos",
            "zeroRecords": "NO HAY NADA PARA MOSTRAR",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
    $(".modal-header").css("color", "#F0F3F4");
    $(".modal-title").text("Nuevo Centro de Costos");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR 
//aqui jala de la tabla a los textbox   
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    Nombre = fila.find('td:eq(1)').text();
    codigo = fila.find('td:eq(2)').text();
    Departamento = fila.find('td:eq(3)').text();
    Provincia = fila.find('td:eq(4)').text();
    Distrito = fila.find('td:eq(5)').text();
    Estado = fila.find('td:eq(6)').text();  
    
    $("#Nombre").val(Nombre);
    $("#codigo").val(codigo);
    $("#Departamento").val(Departamento);
    $("#Provincia").val(Provincia);
    $("#Distrito").val(Distrito);
    $("#Estado").val(Estado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
    $(".modal-header").css("color", "#F0F3F4");
    $(".modal-title").text("Editar Centro de Costos");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Deseas eliminar el centro de Costos: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php", 
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
                
            }
        });
        Swal.fire(
            'Centro de cosotos de baja!',
            'Correctamente!',
            'success'
            
          )
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    Nombre = $.trim($("#Nombre").val());
    Departamento = $.trim($("#Departamento").val());
    Provincia = $.trim($("#Provincia").val());
    Distrito = $.trim($("#Distrito").val());
    Estado = $.trim($("#Estado").val());      
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Nombre:Nombre, Departamento:Departamento, Provincia:Provincia,Distrito:Distrito,Estado:Estado, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            Nombre = data[0].Nombre;
            Departamento = data[0].Departamento;
            Provincia = data[0].Provincia;
            Distrito = data[0].Distrito;
            Estado = data[0].Estado;
            if(opcion == 1){tablaPersonas.row.add([id,Nombre,Departamento,Provincia,Distrito,Estado]).draw();}
            else{tablaPersonas.row(fila).data([id,Nombre,Departamento,Provincia,Distrito,Estado]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});