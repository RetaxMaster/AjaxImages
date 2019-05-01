$(document).ready(function(){

    // Modal

    $(document).on("click", ".modal", function (e) {
        if (($(e.target).hasClass("modal-main") || $(e.target).hasClass("close-modal")) && $("#loading").css("display") == "none") {
            closeModal();
        }
    });

    // -> Modal

    //Se abre el panel para poder seleccionar la foto
    $(document).on("click", "#upload-image", function () {
        $("#file").click();
    });

    //Se cacha el evento change para poder detectar la imagen
    /*
    
    Tipos MIME de imagenes:
    image/jpeg = .jpg - .jpeg
    image/png = .png
    image/gif = .gif
    
    */

    $(document).on("change", "#file", function(){
        var supportedImages = ["image/jpeg", "image/png", "image/gif"];
        var image = this.files[0].type;
        var oldImage = $("#Imagen").attr("src").split("/");
        oldImage = oldImage.pop();

        if (supportedImages.indexOf(image) != -1) {
            var formData = new FormData($("#Formulario")[0]);
            formData.append("oldImage", oldImage);
    
            $.ajax({
                url: "process.php",
                type: "post",
                dataType : "json",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    loading(true, "Subiendo foto...");
                },
                success: function (res) {
                    loading(false);

                    if (res.status == "true") {
                        var path = "images/" + res.name;
                        $("#Imagen").attr("src", path);
                    }
                    else{
                        alert(res.error);
                    }
                },
                error: function (e) {
                    console.log(e.responseText);
                }
            });
        }
        else {
            alert("Sube una imagen");
        }
        
    });

});