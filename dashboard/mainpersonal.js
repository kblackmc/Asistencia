$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>De baja</button></div></div>"  
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
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo Personal");            
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
    apellidos = fila.find('td:eq(2)').text();
    dni = fila.find('td:eq(3)').text();
    nacionalidad =fila.find('td:eq(4)').text();
    edad = fila.find('td:eq(5)').text();
    sexo = fila.find('td:eq(6)').text();
    gruposanguineo = fila.find('td:eq(7)').text();
    estadocivil = fila.find('td:eq(8)').text();
    fechanacimiento = fila.find('td:eq(9)').text();
    paisnacimiento = fila.find('td:eq(10)').text();
    lugarnacimiento = fila.find('td:eq(11)').text();
    departamento = fila.find('td:eq(12)').text();
    provincia = fila.find('td:eq(13)').text();
    distrito = fila.find('td:eq(14)').text();
    categoria = fila.find('td:eq(15)').text();
    puesto = fila.find('td:eq(16)').text();
    fingreso = fila.find('td:eq(17)').text();
    unidadfuncional = fila.find('td:eq(18)').text();
    centrocostos = fila.find('td:eq(19)').text();
    estado = fila.find('td:eq(20)').text();


    $("#nombres").val(nombres);
    $("#apellidos").val(apellidos);
    $("#dni").val(dni);
    $("#nacionalidad").val(nacionalidad);
    $("#edad").val(edad);
    $("#sexo").val(sexo);
    $("#gruposanguineo").val(gruposanguineo);
    $("#estadocivil").val(estadocivil);
    $("#fechanacimiento").val(fechanacimiento);
    $("#paisnacimiento").val(paisnacimiento);
    $("#lugarnacimiento").val(lugarnacimiento);
    $("#departamento").val(departamento);
    $("#provincia").val(provincia);
    $("#distrito").val(distrito);
    $("#categoria").val(categoria);
    $("#puesto").val(puesto);
    $("#fingreso").val(fingreso);
    $("#unidadfuncional").val(unidadfuncional);
    $("#centrocostos").val(centrocostos);
    $("#estado").val(estado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Personal");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    
    if(respuesta){
        $.ajax({
            url: "bd/personal.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
        Swal.fire(
            'Obrero de baja!',
            'Correctamente!',
            'success'
            
          )
        $("#modalCRUD").modal("hide");    
    } 
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombres = $.trim($("#nombres").val());
    apellidos = $.trim($("#apellidos").val());
    dni = $.trim($("#dni").val());
    nacionalidad = $.trim($("#nacionalidad").val());
    edad = $.trim($("#edad").val());
    sexo = $.trim($("#sexo").val());
    gruposanguineo = $.trim($("#gruposanguineo").val());
    estadocivil = $.trim($("#estadocivil").val());
    fechanacimiento = $.trim($("#fechanacimiento").val());
    paisnacimiento = $.trim($("#paisnacimiento").val()); 
    lugarnacimiento = $.trim($("#lugarnacimiento").val());
    departamento = $.trim($("#departamento").val());
    provincia = $.trim($("#provincia").val());
    distrito = $.trim($("#distrito").val());
    categoria = $.trim($("#categoria").val());
    puesto = $.trim($("#puesto").val());
    fingreso = $.trim($("#fingreso").val());
    unidadfuncional = $.trim($("#unidadfuncional").val());
    centrocostos = $.trim($("#centrocostos").val());
    estado = $.trim($("#estado").val());  
    if(nombres.length == "" || dni.length == "" || apellidos.length == ""|| gruposanguineo.length == ""){
        Swal.fire({
            type:'error',
            title:'Apellidos y DNI vacios',
        });
        return false; 
      }else{   
    $.ajax({
        url: "bd/personal.php",
        type: "POST",
        dataType: "json",
        data: {nombres:nombres, apellidos:apellidos, dni:dni,nacionalidad:nacionalidad,edad:edad,sexo:sexo,gruposanguineo:gruposanguineo,estadocivil:estadocivil,fechanacimiento:fechanacimiento,paisnacimiento:paisnacimiento,lugarnacimiento:lugarnacimiento,departamento:departamento,provincia:provincia,distrito:distrito,categoria:categoria,puesto:puesto,fingreso:fingreso,unidadfuncional:unidadfuncional,centrocostos:centrocostos,estado:estado, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            nombres = data[0].nombres;
            apellidos = data[0].apellidos;
            dni = data[0].dni;
            nacionalidad = data[0].nacionalidad;
            edad = data[0].edad;
            sexo = data[0].sexo;
            gruposanguineo = data[0].gruposanguineo;
            estadocivil = data[0].estadocivil;
            fechanacimiento = data[0].fechanacimiento;
            paisnacimiento = data[0].paisnacimiento;
            lugarnacimiento = data[0].lugarnacimiento;
            departamento = data[0].departamento;
            provincia = data[0].provincia;
            distrito = data[0].distrito;
            categoria = data[0].categoria;
            puesto = data[0].puesto;
            fingreso = data[0].fingreso;
            unidadfuncional = data[0].unidadfuncional;
            centrocostos = data[0].centrocostos;
            estado = data[0].estado;
 
            if(opcion == 1){tablaPersonas.row.add([id,nombres,apellidos,dni,nacionalidad,edad,sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado]).draw();
               }
            else{tablaPersonas.row(fila).data([id,nombres,apellidos,dni,nacionalidad,edad,sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado]).draw();
            
            }            
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