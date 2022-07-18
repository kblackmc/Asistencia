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
            "sSearch": "Buscar Nacionalidades:",
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
    $(".modal-header").css("color", "white");
    $(".modal-title").text(" Nueva Nacionalidad");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    pais = fila.find('td:eq(1)').text();
    nacion = fila.find('td:eq(2)').text();


    $("#pais").val(pais);
    $("#nacion").val(nacion);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Nacionalidad");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    nacion = $(this).closest("tr").find('td:eq(2)').text();
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar la nacionalidad : "+id+" "+nacion+"?");
    if(respuesta){
        $.ajax({
            url: "bd/nacionalidad.php",
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
    pais = $.trim($("#pais").val());
    nacion = $.trim($("#nacion").val());
    if(pais.length == "" || nacion.length == ""){
        Swal.fire({
            type:'error',
            title:'Pais o nacionalidad vacia',
        });
        return false; 
      }else{   
    $.ajax({
        url: "bd/nacionalidad.php",
        type: "POST",
        dataType: "json",
        data: {pais:pais, nacion:nacion, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            pais = data[0].pais;
            nacion = data[0].nacion;

            if(opcion == 1){tablaPersonas.row.add([id,pais,nacion]).draw();}
            else{tablaPersonas.row(fila).data([id,pais,nacion]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
      }    
});  
  
    
});