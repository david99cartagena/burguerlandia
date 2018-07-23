$(document).ready(function () {

    /***************************************** T A B L A  D O M I C I L I O *****************************************/

    //MUESTRA LA TABLA DOMICILIO
    function obtieneDomicilios(){
        $.ajax({
            url: "traeDomicilios.php",
            method: "POST",
            success: function (data) {
                $("#tblDomicilio").html(data)
            }
        })
    }

    obtieneDomicilios();

    //ELIMINA EN LA TABLA DOMICILIO
    $(document).on("click", "#eliminadomicilio", function () {
        if (confirm("¿Esta seguro de eliminar este registro?")){
            var numdom = $(this).data("numdom");

            $.ajax({
                url: "../../../controlador/controller.php",
                type: "POST",
                dataType: "json",
                data: {deleteDomicilio:"uno", numdom:numdom},
                beforeSend:function () {

                }
            })
            .done(function (respuesta) {
                if(respuesta.result){
                    alert("Registro eliminado.");
                    obtieneDomicilios()
                }else{
                    alert("Error al eliminar.");
                    obtieneDomicilios();
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

    /*
    //ACTUALIZA EN LA TABLA DOMICILIO

    //Colocar los campos como editables
    $(document).on("click", "#fechayhora,#totaldom,#identusu,#mediopago,#tipoprod,#idprod,#nitrest", function () {
        $(this).attr("contenteditable","true");
    });

    function actualizaDomicilio(ident, col, valor){
        $.ajax({
            url: "../../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: {setDomicilio:"uno", numdom:numdom, col:col, valor:valor},
            beforeSend:function () {

            }
        })
            .done(function (respuesta) {
                if(respuesta.result){
                    alert("Registro actualizado.");
                    obtieneDomicilios();
                }else{
                    alert("Error al actualizar.");
                    obtieneDomicilios();
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
        var numdom = $(this).data("numdom");
        var col = $(this).data("col");
        var valor = $(this).text();
    });
    */
});