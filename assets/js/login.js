$("#frmLogin").submit(function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    $.ajax({
        url: "includes/_userlogin/login.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta.success === true) {
                localStorage.setItem("logged", "true");
                localStorage.setItem("uid", respuesta.userinfo.uid);
                localStorage.setItem("nombres", respuesta.userinfo.nombres);
                localStorage.setItem("apellidos", respuesta.userinfo.apellidos);
                localStorage.setItem("correoelectronico", respuesta.userinfo.correoelectronico);
                localStorage.setItem("whatsapp", respuesta.userinfo.whatsapp);
                localStorage.setItem("rol", respuesta.userinfo.rol);
                location.href="index.php";      
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: respuesta.message
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error el ejecutar la petición"
            });
        }
    });
});
