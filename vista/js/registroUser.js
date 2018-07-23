$(document).ready(function(){
	//MUESTRA EL FORMULARIO DE LOGUEO
    function obtieneLogueo(){
        $.ajax({
            url: "traeFormLogin.html",
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

	//REGISTRO LOGIN
	$(document).on("submit", "#formregistrouser", function(event){
		event.preventDefault();

		$.ajax({
			url: "../../../controlador/controller.php",
			type: "POST",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function(){

			}
		})
		.done(function(respuesta){
			console.log(respuesta);
			if(respuesta.result==true){
                alert("Insertado correctamente.");
                $("#formregistrouser")[0].reset();
            }else if (respuesta.result==false) {
                alert("Error al insertar.");
                $("#formregistrouser")[0].reset();
            }else if (respuesta.result=="passinvalidas") {
                alert("Las contraseñas no coinciden.");
            }else if (respuesta.result=="otro") {
                alert(respuesta.error);
            }
		})
		.fail(function(resp){
			console.log(resp.responseText);
		})
		.always(function(){
			console.log("Completado");
		})
	});


})