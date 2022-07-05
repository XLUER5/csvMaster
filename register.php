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
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3 class="mb-5">Nuevo Usuario</h3>
                            <form id="formulario" class="was-validated">
                            <div class="form-outline mb-4">
                                <input type="text" id="nombreUsuario" required class="form-control form-control-lg" v-model="register.nombreUsuario" />
                                <label class="form-label" for="nombreUsuario">Nombre</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" id="emailUsuario" required class="form-control form-control-lg" v-model="register.emailUsuario" />
                                <label class="form-label" for="emailUsuario">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="passwordUsuario" required class="form-control form-control-lg" v-model="register.password1" />
                                <label class="form-label" for="passwordUsuario">Password</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="confirmarPassword" required class="form-control form-control-lg" v-model="register.password2" />
                                <label class="form-label" for="confirmarPassword">Confirmar Password</label>
                            </div>
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Registar</button>
                            <hr>
                            <div class="my-3">
                                <span>Ya tienes cuenta? <a href="login.php">Inicia Sesion</a></span>
                            </div>
                            </form>
                        </div>
                    </div>
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
    var register=new Vue({
        el:"#formulario",
        data:{
            register:{}
        }
    })

    $("#formulario").submit(async function(event){
        event.preventDefault();
        if(register._data.register.password1 == register._data.register.password2){

            var body = {
                "nombre": register._data.register.nombreUsuario,
                "email": register._data.register.emailUsuario,
                "password" : register._data.register.password1,
                "password_confirmation": register._data.register.password2
            };

            const response = await fetch("https://candidates-exam.herokuapp.com/api/v1/usuarios", {
                method: 'POST',
                body: JSON.stringify(body)
            });
            const data = await response.json();
            console.log(data)
        }else {
            Swal.fire({
                icon: 'error',
                title: 'Contraseñas no coinciden',
                text: 'Intente de nuevo porfavor!',
            })
        }
    })

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

