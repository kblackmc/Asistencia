$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Acceso</button><button class='btn btn-danger btnBorrar'>Excluir</button><button class='btn btn-success btnedit'>Editar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros de Usuarios",
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
    $(".modal-header").css("background-color", "#1F618D");
    $(".modal-header").css("color", "#F0F3F4");
    $(".modal-title").text("Nuevo Usuario");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
 

$(document).on("click", ".btnedit", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    password =fila.find('td:eq(2)').text();
    email = fila.find('td:eq(3)').text();
    tipo = fila.find('td:eq(4)').text();
    costos = fila.find('td:eq(5)').text();
    estado = fila.find('td:eq(6)').text();
    
    
    
    $("#usuario").val(usuario);
    $("#password").val(password);
    $("#email").val(email);
    $("#tipo").val(tipo);
    $("#costos").val(costos);
    $("#estado").val(estado);
    opcion = 4; //editar
    
    $(".modal-header").css("background-image", "linear-gradient(98deg,#3d688d 10%,#004178 100%)",);
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");            
    $("#modalCRUD").modal("show");  
    
});

//botón EDITAR 
//aqui jala de la tabla a los textbox   
$(document).on("click", ".btnEditar", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 2 //dar acceso
    var respuesta = confirm("¿Deseas Dar Acceso al usuario: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/usuario.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                
            }
            
        });
        Swal.fire(
            'Usuario con Acceso!',
            'En Buena Hora!',
            'success'
            
          )
    } 
    
});


//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //quitar acceso
    var respuesta = confirm("¿Deseas quitar el acceso al usuario: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/usuario.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                
            }
        });
        Swal.fire(
            'Usuario sin Acceso!',
            ' :( !',
            'success'
            
          )
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    usuario = $.trim($("#usuario").val());
    password = $.trim($("#password").val());
    email = $.trim($("#email").val());
    tipo = $.trim($("#tipo").val());
    costos = $.trim($("#costos").val());
    estado = $.trim($("#estado").val());
    
    $.ajax({
        url: "bd/usuario.php",
        type: "POST",
        dataType: "json",
        data: {usuario:usuario, password:password, email:email,tipo:tipo,costos:costos,estado:estado, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            usuario = data[0].usuario;
            password = data[0].password;
            email = data[0].email;
            tipo = data[0].tipo;
            costos = data[0].costos;
            estado = data[0].estado;
            if(opcion == 1){tablaPersonas.row.add([id,usuario,password,email,tipo,costos,estado]).draw();}
            else{tablaPersonas.row(fila).data([id,usuario,password,email,tipo,costos,estado]).draw();}            
        }        
    });
    Swal.fire(
        'Datos Actulizados!',
        'Correctamente!',
        'success'
        
      )
    $("#modalCRUD").modal("hide");    

});    
    
});