$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Eliminar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar Puestos:",
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
    puesto = fila.find('td:eq(1)').text();
    area = fila.find('td:eq(2)').text();
    categoria = fila.find('td:eq(3)').text();
    

    $("#puesto").val(puesto);
    $("#area").val(area);
    $("#categoria").val(categoria);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Categoria");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    categoria = $(this).closest("tr").find('td:eq(1)').text();
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el puesto : "+id+" "+puesto+"?");
    if(respuesta){
        $.ajax({
            url: "bd/categoria.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
        $("#modalCRUD").modal("hide");    
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    categoria = $.trim($("#categoria").val());
    puesto = $.trim($("#puesto").val());
    area = $.trim($("#area").val());
    if(categoria.length == "" || puesto.length == ""){
        Swal.fire({
            type:'error',
            title:'Categoria o puesto vacia',
        });
        return false; 
      }else{   
    $.ajax({
        url: "bd/categoria.php",
        type: "POST",
        dataType: "json",
        data: { puesto:puesto, area:area, categoria:categoria,  id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;   
            puesto = data[0].puesto;
            area = data[0].area;         
            categoria = data[0].categoria;
            if(opcion == 1){tablaPersonas.row.add([id,puesto,area,categoria]).draw();}
            else{tablaPersonas.row(fila).data([id,puesto,area,categoria]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
      }    
});  
  
    
});