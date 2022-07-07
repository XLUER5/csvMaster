<?php
session_start();
if (isset($_SESSION["sesion"])) {
    header('location:pages/cargaCSV.php');
}
?>

<!DOCTYPE html>
<html lang="es">
 <head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
 </head>
   <body id="app">
   <section class="vh-100" style="background-color: #508bfc;">
       <div class="container py-5 h-100">
           <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                   <form id="formulario"  class="was-validated">
                       <div class="card shadow-2-strong" style="border-radius: 1rem;">
                           <div class="card-body p-5 text-center">
                               <h3 class="mb-5">Bienvenido</h3>
                               <div class="form-outline mb-4">
                                   <input type="email" id="typeEmailX-2" class="form-control form-control-lg" required v-model="login.email" />
                                   <label class="form-label" for="typeEmailX-2">Email</label>
                               </div>
                               <div class="form-outline mb-4">
                                   <input type="password" id="typePasswordX-2" class="form-control form-control-lg" required v-model="login.password" />
                                   <label class="form-label" for="typePasswordX-2">Password</label>
                               </div>
                               <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesion</button>
                               <hr>
                               <div class="my-3">
                                    <span>No tienes cuenta? <a href="register.php">Registrate</a></span>
                               </div>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </section>
   </body>
</html>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
    var login=new Vue({
        el:"#formulario",
        data:{
            login:{}
        }
    })

    $("#formulario").submit(async function(event){
        event.preventDefault();

            const body = {
                email: login._data.login.email,
                password : login._data.login.password
            };


            const response = await fetch("https://candidates-exam.herokuapp.com/api/v1/auth/login", {
                method: 'POST',
                headers:{
                    "Content-Type":"application/json"
                },
                body: JSON.stringify(body)
            });

            const data = await response.json();

            if(data.tipo == true){
                Swal.fire({
                    icon: 'success',
                    title: 'Bienvendido'
                })
                var token = data.token
                var usuario = data.usuario
                window.location.href = "loginRedirect.php?token="+token+"&usuario="+usuario
            }else{
                Swal.fire({
                    icon: 'error',
                    title: data.error,
                    text: 'Intente de nuevo porfavor!',
                })
            }
    })

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

