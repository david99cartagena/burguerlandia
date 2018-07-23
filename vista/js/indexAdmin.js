$(document).ready(function () {

    /***************************************** T A B L A  U S U A R I O *****************************************/

    //INSERTA EN LA TABLA USUARIO
    $(document).on("submit", "#formUsuario", function (event) {
        event.preventDefault();

        $.ajax({
            url: "../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend:function () {

            }
        })
        .done(function (respuesta) {
            if(respuesta.result==true){
                alert("Insertado correctamente.");
            }else if (respuesta.result==false) {
                alert("Error al insertar.");
            }else if (respuesta.result=="otro") {
                alert(respuesta.error);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            $("#formUsuario")[0].reset();
            console.log("Completado");
        })
    });

    /***************************************** T A B L A  P R O D U C T O S *****************************************/

    //INSERTA EN LA TABLA PRODUCTO
    $(document).on("submit", "#formProducto", function (event) {
        event.preventDefault();

        var formdata = new FormData();
        formdata.append("enviaProducto", "");
        formdata.append("nombreprod", $("input[type=text][name=nombreprod]").val());
        formdata.append("valorprod", $("input[type=number][name=valorprod]").val());
        formdata.append("descprod", $("textarea[name=descprod]").val());
        formdata.append("imagenprod", $("#imagenprod")[0].files[0]);

        $.ajax({
            url: "../../controlador/controller.php",
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
            if (respuesta.result == true){
                alert("Insertado correctamente.");
            }else if (respuesta.result == "errordeformatoimagen"){
                alert("Solo se permiten los formatos png, pneg, gif y jpg.");
            }else if (respuesta.result == "errordetamano"){
                alert("El tamaño de la imagen debe de ser menor a 3 megabytes.");
            }else if (respuesta.result==false) {
                alert("Error al insertar.");
            }else if (respuesta.result=="otro"){
                alert(respuesta.error);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            $("#formProducto")[0].reset();
            console.log("Completado");
        })
    });

    /***************************************** T A B L A  D O M I C I L I O S *****************************************/

    //INSERTA EN LA TABLA PRODUCTO
    $(document).on("submit", "#formDomicilio", function (event) {
        event.preventDefault();

        $.ajax({
            url: "../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend:function () {

            }
        })
        .done(function (respuesta) {
            if (respuesta.result){
                alert("Insertado correctamente.");
            }else{
                alert("Error al insertar.");
                console.log(respuesta.responseText);
            }
        })
        .fail(function (resp) {
            console.log(resp.responseText);
        })
        .always(function () {
            $("#formDomicilio")[0].reset();
            console.log("Completado");
        })
    });

    //CIERRA LA SESSION
    $(document).on("click", "#cierrasession", function () {
        $.ajax({
            url: "../../controlador/controller.php",
            type: "POST",
            dataType: "json",
            data: {session:"logout"},
            beforeSend: function () {

            }
        })
        .done(function (respuesta) {
            if (respuesta.result){
                location.href="../../index.php";
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