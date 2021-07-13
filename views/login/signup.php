<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrar cliente</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <!-- <img class="align-content" src="images/logo.png" alt=""> -->
                </div>
                <div class="login-form">
                <form action="<?php echo constant('URL');?>/SignUp/NewUser" method="POST">
                <div class="text-center">
                            <h1>Nuevo Usuario</h1>
                        </div>
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type='file' id="photo" accept=".png, .jpg, .jpeg" />
                                <label for="photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('images/users/default.jpg')">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" placeholder="" name="username">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" placeholder="" name="password">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="999-999999-9999A" pattern="^[0-9]{3}-[0-9]{6}-[0-9]{4}[a-zA-Z]{1}$" name="identify" id="identify">
                                        <div class="input-group-btn">
                                            <div>
                                                <input type="file" class="file" name="photo_identify" id="photo_identify" accept=".png, .jpg, .jpeg">
                                                <label for="photo_identify" class="btn btn-sm btn-outline-secondary" style="height:38px; font-size:10px;">Subir foto</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Teléfono celular</label>
                            <input type="text" class="form-control" placeholder="8888-8888"  pattern="^[0-9]{4}-[0-9]{4}$" name="phone" id="phone" required>
                        </div>    
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" placeholder="" name="address">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="first_name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="second_name">
                                </div>
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="first_lastname">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="second_lastname">
                                </div>
                            </div>
                        </div>
                        <div class="form-group color-red">
                            <p><?php $this->showMessages(); ?></p>
                        </div>
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Registrar nuevo usuario</button>
                        <div class="social-login-content">
                            <div class="social-button">
                                <a href="<?php echo constant('URL')?>" class="btn social facebook btn-flat btn-addon mb-3">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        jQuery(document).ready(function($) {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                        $('#imagePreview').hide();
                        $('#imagePreview').fadeIn(650);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#photo").change(function() {
                readURL(this);
            });
        });
    </script>
</body>
</html>