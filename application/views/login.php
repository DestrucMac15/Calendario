<div class="container-fluid">
    <div class="row">
        <div class="d-none d-md-block col-md-7 p-0">
            <div class="row header" style="background-image: url('<?php echo base_url(); ?>assets/images/background.jpg'); margin: 0;">
            </div>
        </div>
        <div class="col-md-5 d-flex align-items-center justify-content-center">
            <section class="card w-100 my-5" style="border-radius: 10px;">
                <form class="card-body" id="form_login" role="login" class="needs-validation" novalidate>    
                    <div class="d-flex justify-content-center ">
                        <img src="<?php echo base_url(); ?>assets/images/logo.jpg" width="100" alt="">
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="">Correo Electrónicos</label>
                        <input type="email" name="correo" class="form-control" required/>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label for="">Contraseña</label>
                        <a href="<?php echo base_url('login/recuperar'); ?>">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control"  required>
                    </div>
                    <button type="submit" class="btn bg-vocom text-white btn-block">
                        Ingresar
                    </button>
                </form>
            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        let ruta = $('body').data('ruta');

        $('#form_login').submit(function(event){
    
            event.preventDefault();
    
            let datos = $(this).serialize();
    
            $.ajax({
                url: 'login/auth',
                method: 'POST',
                dataType: 'JSON',
                data: datos,
                success: function(response){
    
                iziToast.success({
                    timeout: 3000,
                    overlay: true,
                    displayMode: 'once',
                    id: 'inputs',
                    zindex: 999,
                    title: 'Correcto!',
                    message: 'Bienvenido',
                    position: 'topRight',
                    drag: false
                });
    
                setInterval(function(){
    
                    location.replace(ruta+'leads');
    
                },1000);
                },
                statusCode: {
                    400: function(xhr){
    
                        iziToast.error({
                            timeout: 3000,
                            overlay: true,
                            displayMode: 'once',
                            id: 'inputs',
                            zindex: 999,
                            title: 'Atención!',
                            message: 'Rellena los campos correctamente',
                            position: 'topRight',
                            drag: false
                        });
    
                    },
                    401: function(xhr){
                    
                        iziToast.error({
                            timeout: 3000,
                            overlay: true,
                            displayMode: 'once',
                            id: 'inputs',
                            zindex: 999,
                            title: 'Atención!',
                            message: xhr.responseText,
                            position: 'topRight',
                            drag: false
                        });
    
                    }
                }
            })
    
        });

    });
</script>

