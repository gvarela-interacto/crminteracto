<?php
header("Content-Type: application/json");

$rutaBase = __DIR__ . "/../../../includes/";

$tabla      = $_POST['setTabla'] ?? '';
if (!isset($_POST['setTabla']) || empty(trim($_POST['setTabla']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la tabla"
    ]);
    exit;
}

$carpeta      = $_POST['setCarpeta'] ?? '';
if (!isset($_POST['setCarpeta']) || empty(trim($_POST['setCarpeta']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la carpeta"
    ]);
    exit;
}

$archivo      = $_POST['setArchivo'] ?? '';
if (!isset($_POST['setArchivo']) || empty(trim($_POST['setArchivo']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la archivo"
    ]);
    exit;
}

$multimagen   = $_POST['setMultimagen'] ?? '';
if (!isset($_POST['setMultimagen']) || empty(trim($_POST['setMultimagen']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la archivo"
    ]);
    exit;
}

$setDatos      = $_POST['setDatos'] ?? '';
$images="";
$imagesProcesar="";

foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ayudante   = $dato['ayudante']    ?? '';
    $ol         = $dato['ol']       ?? false;
    $rl         = $dato['rl']       ?? false;
    $oc         = $dato['oc']       ?? false;
    $rc         = $dato['rc']       ?? false;

    if($tipo=='imagen'){
        $images.= ' $("#sibleImg'.$nombre.'").click(function () {
            $("#ctr'.$nombre.'").click();
        });';

        $images.= '$("#ctr'.$nombre.'").change(function (event) {
                    var archivo = event.target.files[0];
                        if (archivo) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("#sibleImg'.$nombre.'").attr("src", e.target.result).show();
                                $("#lblCargarImagen'.$nombre.'").html(archivo.name);
                                $("#lblCargar2Imagen'.$nombre.'").html("Clic sobre la imágen para cargar nuevamente");
                            };
                            reader.readAsDataURL(archivo);
                        }
                   });';
    }

    if($tipo=='document'){
        $images.= ' $("#docSingle'.$nombre.'").click(function () {
            $("#ctr'.$nombre.'").click();
        });';

        $images.= '$("#ctr'.$nombre.'").change(function (event) {
                    var archivo = event.target.files[0];
                         if (archivo && archivo.type === "application/pdf") {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $("#docSingle'.$nombre.'").attr("src", "images/previewSinglepdf.png").show();
                                $("#lblCargarDocumento'.$nombre.'").html(archivo.name);
                                $("#lblCargar2Documento'.$nombre.'").html("Clic sobre el icono para cargar nuevamente");
                            };
                            reader.readAsDataURL(archivo);
                        }
                   });';
    }
}

if($multimagen!='false'){
    $images.= ' $("#dropArea").click(function () {
        $("#ctrIma'.$tabla.'").click();
    });';
    $images.= '$("#ctrIma'.$tabla.'").change(function (event) {
        let files = Array.from(event.target.files); 
        if (uploadedFiles.length + files.length > '.intval($multimagen).') {
            alert("Solo puedes subir hasta '.intval($multimagen).' imágenes.");
            $("#ctrIma'.$tabla.'").val("");
            return;
        }
        $("#dropArea").hide();
        $("#divPreviewContenedor").css("display", "flex");
        if(uploadedFiles.length==0){
            var firstImage = uploadedFiles.length === 0 ? "TRUE" : "FALSE";
        }else{
            var firstImage = "FALSE";
        }
        
        files.forEach(file => {
            if (!uploadedFiles.some(f => f.name === file.name && f.size === file.size)) {
                uploadedFiles.push(file);
                let reader = new FileReader();
                let index = uploadedFiles.findIndex(f => f.name === file.name && f.size === file.size);
                reader.onload = function (e) {
                    let img = $("<img>")
                        .attr("src", e.target.result)
                        .attr("data-portada", firstImage)
                        .attr("data-index", encodeURIComponent(file.name))
                        .addClass("preview-img")
                        .click(function () {
                            $("#previewArea").html("<img src=\'" + $(this).attr("src") + "\'>");
                            let getPortada = $(this).attr("data-portada");
                            if (getPortada == "TRUE") {
                                $("#previewAreaOptions").html("<i onclick=deleteImagen(\'"+encodeURIComponent(file.name)+"\') class=\'menu-icon size22 mdi mdi-trash-can-outline\'></i><br/><span onclick=setMarcaPortada(\'TRUE\',\'"+encodeURIComponent(file.name)+"\') class=\'mdi colorBlueSel size22 mdi-star-box\'   ></span>");
                                $("#previewArea").removeClass("hide-before");
                            } else {
                                $("#previewAreaOptions").html("<i onclick=deleteImagen(\'"+encodeURIComponent(file.name)+"\') class=\'menu-icon size22 mdi mdi-trash-can-outline\'></i><br/><span  onclick=setMarcaPortada(\'FALSE\',\'"+encodeURIComponent(file.name)+"\') class=\'mdi colorGray size22 mdi-star-box\'></span>");
                                $("#previewArea").addClass("hide-before");
                            }
                        });
                    $("#previewContainer").append(img);    
                    if (firstImage == "TRUE") { 
                        $("#previewArea").html("<img src=" + e.target.result + ">");
                        $("#previewAreaOptions").html("<i onclick=deleteImagen(\'"+encodeURIComponent(file.name)+"\') class=\'menu-icon size22 mdi mdi-trash-can-outline\'></i><br/><span onclick=setMarcaPortada(\'TRUE\',\'"+encodeURIComponent(file.name)+"\') class=\'mdi colorBlueSel size22 mdi-star-box\'></span>");
                        $("#previewArea").removeClass("hide-before");
                        firstImage = "FALSE"; 
                    }
                };
                reader.readAsDataURL(file);
            }
        });
        $(".preview-img-add").remove(); 
        let imgAdd = $("<img>")
            .attr("src", "images/btnAddImagen.png")
            .attr("data-portada", firstImage)
            .addClass("preview-img-add")
            .click(function () {
                $("#ctrIma'.$tabla.'").click();
            });        
        $("#previewContainer").prepend(imgAdd);
    });';

    $imagesProcesar.='uploadedFiles.forEach((file, index) => {
            formData.append("imagenes[]", file);
            let isPortada = $("img[data-index=\'" + file.name + "\']").attr("data-portada") === "TRUE" ? 1 : 0;
            formData.append("portadas[]", isPortada);
        });';

}


$getArchivo         = $_POST['setArchivo'] ?? '';
$setDatos           = explode(".",$getArchivo);
$archivo            = "/__".$setDatos[0].'.js';
$rutaArchivo        = $rutaBase.$carpeta.$archivo;
$archivocorte       = $carpeta.'/_save_'.$setDatos[0].'.php';
$setNombreNomUC     = ucfirst($tabla);

$codigo = <<<PHP

let uploadedFiles = []; 

$(document).ready(function(){
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    $images

})

$("#frm$setNombreNomUC").submit(function(event) {
    event.preventDefault();
    $("#btnSave$setNombreNomUC").prop("disabled", true);
    let formData = new FormData(this);

    $imagesProcesar

    $.ajax({
        url: "includes/$archivocorte",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            if (respuesta.success === true) {
                Swal.fire({
                    icon: "success",
                    title: "EMPRESA REGISTRADA",
                    text: "Ha registrado una nueva empresa satisfactoriamente",
                    allowOutsideClick: false
                }).then(() => {
                    location.href="?p=$carpeta ";
                })
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: respuesta.message,
                    allowOutsideClick: false
                }).then(() => {
                    $("#btnSave$setNombreNomUC").prop("disabled", false);
                })
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Error el ejecutar la petición",
                allowOutsideClick: false
            }).then(() => {
                $("#btnSave$setNombreNomUC").prop("disabled", false);
            })
        }
    });
});

function deleteImagen(filename) {
    var limpio=filename;
    filename=decodeURIComponent(filename);
    let index = uploadedFiles.findIndex(file => file.name === filename);
    if (index !== -1) {
        uploadedFiles.splice(index, 1);
        $("img[data-index='"+limpio+"']").remove();
        if (uploadedFiles.length === 0) {
            $("#dropArea").show();
            $('#divPreviewContenedor').css("display", "none");
        }else{
            let setfilename = encodeURIComponent(uploadedFiles[0].name);
            $("img[data-portada='TRUE']").attr("data-portada", "FALSE");
            $("img[data-index='" + setfilename + "']").attr("data-portada","TRUE");
            $("img[data-index='" + setfilename + "']").trigger("click");
        }
    }   
}

function setMarcaPortada(portada,filename){
    var limpio=filename;
    filename=decodeURIComponent(filename);
    if (portada === 'FALSE') {
        let index = uploadedFiles.findIndex(file => file.name === filename);
        if (index !== -1) {  
            $("img[data-portada='TRUE']").attr("data-portada", "FALSE");
            $("img[data-index='" + limpio + "']").attr("data-portada", "TRUE");
            $("img[data-index='" + limpio + "']").trigger("click");
        }
    }
}

PHP;

include('_loadDataToProcessEnd.php');

?>