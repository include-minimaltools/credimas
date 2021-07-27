<?php
require_once "views/Shared/Layout.php";
?>

<div class="profile">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="">Perfil de Usuario</h1>
                    </div>
                    <form action="<?php echo constant('URL');?>/NewClient/CreateUser" method="POST" enctype="multipart/form-data">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" id="photo" name="photo" accept=".png, .jpg, .jpeg" >
                                <label for="photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('images/avatar/default.jpg')"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Usuario</label>
                                <input type="text" class="form-control" placeholder="" name="username" id="username" required>
                            </div>
                            <div class="col">
                                <label>Rol de usuario:</label>
                                <select name="role" id="role" class="form-control" disabled>
                                    <option value="client">Cliente</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="col">
                                <label>Contraseña</label>
                                <input type="password" class="form-control" placeholder="" name="password" id="password" required>
                            </div>
                            <div class="col">
                                <label>Confirme la contraseña</label>
                                <input type="password" class="form-control" placeholder="" name="confirmPassword" id="confirmPassword" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <div class="input-group">
                                        <input type="text"  class="form-control" placeholder="999-999999-9999A" pattern="^[0-9]{3}-[0-9]{6}-[0-9]{4}[a-zA-Z]{1}$" name="identify" id="identify" required>
                                        <div class="input-group-btn">
                                            <div class="btn btn-sm btn-outline-secondary ">
                                                <input type="file"  class="file" name="photo_identify" id="photo_identify" accept=".png, .jpg, .jpeg">
                                                <label for="photo_identify">Subir foto</label>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Teléfono celular</label>
                                    <input type="text" class="form-control" placeholder="8888-8888"  pattern="^[0-9]{4}-[0-9]{4}$" name="phone" id="phone" required>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" placeholder="" name="address" id="address" required>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="first_name" id="first_name" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="second_name" id="second_name" required>
                                </div>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="first_lastname" id="first_lastname" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="second_lastname" id="second_lastname" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"><i style="margin-right:10px;" class="fa fa-save"></i>Crear nuevo usuario</button>
                            </div>
                            <div class="col-sm-4">
                                <a href="<?php echo constant('URL')?>/" class="btn btn-info btn-flat m-b-30 m-t-30"><i style="margin-right:10px;" class="fa fa-arrow-left"></i>Volver al inicio</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 
    </div>
</div>

<script>
    

    $(function () {
        $('#imagePreview').css('background-image', 'url(images/users/default.jpg)');
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
    }
    }
    $("#photo").change(function() {
    console.log($("#photo"));
    readURL(this);
    });
</script>
<?php require_once 'views/Shared/Footer.php'?>