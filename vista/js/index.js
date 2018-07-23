$(document).ready(function () {
    //MUESTRA EL FORMULARIO DE LOGUEO
    function obtieneLogueo(){
        $.ajax({
            url: "vista/user/registro_user/traeFormLogin.html",
            method: "POST",
            success: function (data) {
                $("#ventanaModal").html(data)
            }
        })
    }
    
    //-----------------------------VENTANA MODAL LOGIN-------------------------------
    $(document).on("click", "#abreLogin", function () {
        obtieneLogueo();
        $("#ventanaModal").slideDown("fast");
    });

    $(document).on("click", "#cierraModal", function () {
        $("#ventanaModal").slideUp("fast");
    });

    //------------------------------ENVIA LOGIN--------------------------------------
    $(document).on("submit", "#formLogin", function () {
        event.preventDefault();

        $.ajax({
            url: "controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend:function () {
                $("#btnUno").css({
                   "display":"none"
                });
                $("#btnDos").css({
                    "display":"inline"
                });
            }
        })
        .done(function(respuesta){
            console.log(respuesta);
            if (!respuesta.error) {
                if(respuesta.tipo=="Administrador"){
                    location.href="vista/admin/indexAdmin.php";
                }else if(respuesta.tipo=="Usuario"){
                    location.href="vista/usuario/indexUsuario.php";
                }
            }else{
                if(respuesta.tipo=="sinrol"){
                    $("#usuariosinrol").slideDown("slow");
                    setTimeout(function(){
                        $("#usuariosinrol").slideUp("slow");
                    }, 3000);
                    $("#btnUno").css({
                        "display":"inline"
                    });
                    $("#btnDos").css({
                        "display":"none"
                    });
                }else if(respuesta.tipo=="Incorrecto"){
                    $("#loginincorrecto").slideDown("slow");
                    setTimeout(function(){
                        $("#loginincorrecto").slideUp("slow");
                    }, 3000);
                    $("#btnUno").css({
                        "display":"inline"
                    });
                    $("#btnDos").css({
                        "display":"none"
                    });
                }
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log("Completado");
        })
    });


});


