$(document).ready(function () {

    /***************************************** T A B L A  O P I N I O N *****************************************/

    //MUESTRA LA TABLA OPINION
    function obtieneOpinion(){
        $.ajax({
            url: "traeOpinion.php",
            method: "POST",
            success: function (data) {
                $("#tblOpinion").html(data)
            }
        })
    }

    obtieneOpinion();

    //ELIMINA EN LA TABLA OPINION
    $(document).on("click", "#eliminaopinion", function () {
        if (confirm("¿Esta seguro de eliminar este registro?")){
            var idopi = $(this).data("idopi");

            $.ajax({
                url: "../../../controlador/controller.php",
                type: "POST",
                dataType: "json",
                data: {deleteOpinion:"uno", idopi:idopi},
                beforeSend:function () {

                }
            })
            .done(function (respuesta) {
                if(respuesta.result){
                    alert("Registro eliminado.");
                    obtieneOpinion()
                }else{
                    alert("Error al eliminar.");
                    obtieneOpinion();
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
});