<?php
session_start();
if(!$_SESSION['sesion']=="activa"){
    header('location:../login.php');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Admin</title>

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">CV Master</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="../logout.php">Cerrar Sesion</a>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="perfil.php">
                            Perfil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="cargaCSV.php">
                            Cargar CV
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="formulario">
            <form id="formulario">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Cargar Curriculum Vitae</h1>
                </div>

                <div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Adjunte su archivo</label>
                            <input class="form-control" type="file" id="file" onchange="return fileValidation()">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <input class="btn btn-success" type="button" value="Guardar" id="btnReporte" onclick="subirArchivo()">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <input class="btn btn-success" type="button" value="Mostrar" id="btnReporte" onclick="mostrarArchivo()">
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
</body>
</html>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script>
    function fileValidation() {
        var fileInput = document.getElementById('file');

        var filePath = fileInput.value;

        // Allowing file type
        var allowedExtensions =
            /(\.pdf|\.)$/i;

        if (!allowedExtensions.exec(filePath)) {
            Swal.fire({
                icon: 'error',
                title: "Archivo Incompatible",
                text: 'Unicamente puede subir PDF!',
            })
            fileInput.value = '';
            return false;
        }else{
            const oFile = document.getElementById("file").files[0];
            if (oFile.size > 4768370)
            {
                Swal.fire({
                    icon: 'error',
                    title: "Archivo muy pesado!",
                    text: 'Unicamente puede subir archivos de max 5MB!',
                })
                return;
            }
        }
    }

    async function subirArchivo(){

        const oFile = document.getElementById("file").files[0];

        if (oFile == undefined){
            Swal.fire({
                icon: 'error',
                title: "Por favor seleccione archivo"
            })
        }else{
            var fd = new FormData();
            fd.append("curriculum", oFile);

            const response = await fetch("https://candidates-exam.herokuapp.com/api/v1/usuarios/"+ <?php $url = $_SESSION["url"]; echo '"'.$url.'"' ;?>+"/cargar_cv", {
                method: 'POST',
                headers:{
                    "Authorization":<?php $token = $_SESSION["token"]; echo "'".$token."'";?>,
                },
                body: fd,
                contentType: false,
                processData: false,
            });


            const data = await response.json();

            Swal.fire({
                icon: 'success',
                title: data.mensaje || data.error
            })
        }


    }

    async function mostrarArchivo(){
        const response = await fetch("https://candidates-exam.herokuapp.com/api/v1/usuarios/mostrar_cv", {
            method: 'GET',
            headers:{
                "Authorization":<?php $token = $_SESSION["token"]; echo "'".$token."'";?>
            }
        });
        const data = await response.json();

        if (data.error == "No route matches {:action=>\"show\", :controller=>\"active_storage/blobs/redirect\", :disposition=>\"attachment\", :filename=>nil, :signed_id=>nil}, possible unmatched constraints: [:filename, :signed_id]"){
            Swal.fire({
                icon: 'error',
                title: "Usuario sin archivo cargado"
            })
        }else{
            var newUrl = data.url

            window.open(newUrl)

        }


    }

</script>
