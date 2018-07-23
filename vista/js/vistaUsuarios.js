$(document).ready(function () {

    /***************************************** T A B L A  U S U A R I O *****************************************/

    //MUESTRA LA TABLA USUARIO
    function obtieneUsuarios(){
        $.ajax({
            url: "traeUsuarios.php",
            method: "POST",
            success: function (data) {
                $("#tblUsuario").html(data)
            }
        })
    }

    obtieneUsuarios();

    //ELIMINA EN LA TABLA USUARIO
    $(document).on("click", "#eliminausuario", function () {
        if (confirm("¿Esta seguro de eliminar este registro?")){
            var ident = $(this).data("ident");

            $.ajax({
                url: "../../../controlador/controller.php",
                type: "POST",
                dataType: "json",
                data: {deleteUsuario:"uno", ident:ident},
                beforeSend:function () {

                }
            })
            .done(function (respuesta) {
                if(respuesta.result==true){
                    alert("Registro eliminado.");
                    obtieneUsuarios()
                }else if (respuesta.result==false) {
                    alert("Error al eliminar.");
                    obtieneUsuarios();
                }else if (respuesta.result=="otro") {
                    alert(respuesta.error);
                }
            })
            .fail(function (resp) {
                console.log(resp.responseText);
            })
            .always(function () {
                console.log("Completado");
            })
        }
    });

    //ACTUALIZA EN LA TABLA USUARIO

    //Colocar los campos como editables
    $(document).on("click", "#nombre,#apelli,#telefo,#celula,#direcc,#usuari,#contra,#correo", function () {
        $(this).attr("contenteditable","true");
    });

    function actualizaUsuario(ident, col, valor){
        $.ajax({
            url: "../../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: {setUsuario:"uno", ident:ident, col:col, valor:valor},
            beforeSend:function () {

            }
        })
        .done(function (respuesta) {
            if(respuesta.result==true){
                alert("Registro actualizado.");
                obtieneUsuarios()
            }else if (respuesta.result==false) {
                alert("Error al actualizar.");
                obtieneUsuarios();
            }else if (respuesta.result=="otro") {
                alert(respuesta.error);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            $(this).removeAttr("contenteditable");
            console.log("Completado");
        })
    }

    $(document).on("blur", "#nombre,#apelli,#telefo,#celula,#direcc,#usuari,#contra,#correo", function () {
        var ident = $(this).data("ident");
        var col = $(this).data("col");
        var valor = $(this).text();

        actualizaUsuario(ident, col, valor);
    });

    $(document).on("blur", "#selecttipoid", function () {
        var ident = $(this).data("ident");
        var col = $(this).data("col");
        var valor = $(this).val();
        actualizaUsuario(ident, col, valor);
    });

    $(document).on("blur", "#selectrol", function () {
        var ident = $(this).data("ident");
        var col = $(this).data("col");
        var valor = $(this).val();
        actualizaUsuario(ident, col, valor);
    });

    //CIERRA LA SESSION
    $(document).on("click", "#cierrasession", function () {
        $.ajax({
            url: "../../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: {session:"logout"},
            beforeSend: function () {

            }
        })
            .done(function (respuesta) {
                if (respuesta.result){
                    location.href="../../../index.php";
                }
            })
            .fail(function (resp) {
                console.log(resp.responseText);
            })
            .always(function () {
                console.log("Completado");
            })
    })
});