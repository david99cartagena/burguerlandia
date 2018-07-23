$(document).ready(function () {

    /***************************************** T A B L A  P R O D U C T O S *****************************************/

    //MUESTRA LA TABLA PRODUCTO
    function obtieneProductos(){
        $.ajax({
            url: "traeProductos.php",
            method: "POST",
            success: function (data) {
                $("#tblProducto").html(data)
            }
        })
    }

    obtieneProductos();

    //ELIMINA EN LA TABLA PRODUCTO
    $(document).on("click", "#eliminaproducto", function () {
        if (confirm("¿Esta seguro de eliminar este registro?")){
            var idprod = $(this).data("idprod");

            $.ajax({
                url: "../../../controlador/controller.php",
                type: "POST",
                dataType: "json",
                data: {deleteProducto:"uno", idprod:idprod},
                beforeSend:function () {

                }
            })
            .done(function (respuesta) {
                if(respuesta.result==true){
                    alert("Registro eliminado.");
                    obtieneProductos();
                }else if (respuesta.result==false) {
                    alert("Error al eliminar.");
                    obtieneProductos();
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

    //ACTUALIZA EN LA TABLA PRODUCTO

    //Colocar los campos como editables
    $(document).on("click", "#nombreprod,#valorprod,#descprod", function () {
        $(this).attr("contenteditable","true");
    });

    //Colocar los campos como editables
    $(document).on("blur", "#nombreprod,#valorprod,#descprod", function () {
        var idprod = $(this).data("idprod");
        var col = $(this).data("col");
        var valor = $(this).text();

        $.ajax({
            url: "../../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: {setProducto:"uno", idprod:idprod, col:col, valor:valor},
            beforeSend:function () {

            }
        })
        .done(function (respuesta) {
            if(respuesta.result==true){
                alert("Registro actualizado.");
                obtieneProductos();
            }else if (respuesta.result==false) {
                alert("Error al actualizar.");
                obtieneProductos();
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
    });

    //INSERTA NUEVA IMAGEN
    $(document).on("click", "#guardaimg", function (event) {
        event.preventDefault();

        var newimg = $("input[type=text][name=setnewimg]").val();
        var id = $(this).data("idprod");
        var col = $(this).data("col");
        var nombre = $(this).data("nombre");

        //alert("newimg: "+newimg+" Id: "+id+" Col: "+col+" Nombre: "+nombre);

        var formdata = new FormData();
        formdata.append("setnewimg", newimg);
        formdata.append("idprod", id);
        formdata.append("col", col);
        formdata.append("nombre", nombre);
        formdata.append("newimg", $("#newimg")[0].files[0]);

        $.ajax({
            url: "../../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: formdata,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend:function () {

            }
        })
        .done(function (respuesta) {
            console.log(respuesta);
            if (respuesta.result == true){
                alert("Imagen actualizada.");
                obtieneProductos();
                $("#ventanaModal").slideUp("fast");
            }else if (respuesta.result == "errordeformatoimagen"){
                $("#erroruno").slideDown("slow");
                setTimeout(function(){
                    $("#erroruno").slideUp("slow");
                }, 3000);
            }else if (respuesta.result == "errordetamano"){
                $("#errordos").slideDown("slow");
                setTimeout(function(){
                    $("#errordos").slideUp("slow");
                }, 3000);
            }else if (respuesta.result==false) {
                $("#errortres").slideDown("slow");
                setTimeout(function(){
                    $("#errortres").slideUp("slow");
                }, 3000);
            }else if (respuesta.result=="otro"){
                alert(respuesta.error);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            console.log("Completado");
        })
    });

    //PASA EL ID DEL REGISTRO AL FORMULARIO DE NUEVA IMAGEN
    $(document).on("dblclick", "#colimagen", function () {
        var id = $(this).data("idprod");
        var col = $(this).data("col");
        var nombre = $(this).data("nombre");
        //Abre la ventana modal
        $("#ventanaModal").slideDown("fast");
        //Asigno los valores al boton del formulario de nueva imagen
        $("#guardaimg").data("idprod", id);
        $("#guardaimg").data("col", col);
        $("#guardaimg").data("nombre", nombre);
    });
    //Cierra la ventana modal
    $(document).on("click", "#cierraModal", function () {
        $("#ventanaModal").slideUp("fast");
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