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
                    <form action="<?php echo constant('URL');?>/UpdateProfile/UpdateUser" method="POST" enctype="multipart/form-data">
                        <div class="avatar-upload">
                            <div class="avatar-edit">
                                <input type="file" id="photo" name="photo" accept=".png, .jpg, .jpeg" >
                                <label for="photo"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="background-image: url('images/avatar/default.jpg')"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" class="form-control" placeholder="" name="username" id="username" required>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cédula</label>
                                    <div class="input-group">
                                        <input type="text" <?php if($this->data['verified']) echo 'disabled'?> class="form-control" placeholder="999-999999-9999A" pattern="^[0-9]{3}-[0-9]{6}-[0-9]{4}[a-zA-Z]{1}$" name="identify" id="identify">
                                        <div class="input-group-btn">
                                            <div class="btn btn-sm btn-outline-secondary <?php if($this->data['verified']) echo 'disabled'?>">
                                                <input type="file" <?php if($this->data['verified']) echo 'disabled'?> class="file" name="photo_identify" id="photo_identify" accept=".png, .jpg, .jpeg">
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
                            <input type="text" class="form-control" placeholder="" name="address" id="address">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="first_name" id="first_name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Nombre</label>
                                    <input type="text" class="form-control" placeholder="" name="second_name" id="second_name">
                                </div>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Primer Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="first_lastname" id="first_lastname">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Segundo Apellido</label>
                                    <input type="text" class="form-control" placeholder="" name="second_lastname" id="second_lastname">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group color-red">
                            <p><?php $this->showMessages(); ?></p>
                        </div> -->
                        <div class="card">
                            <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Actualizar perfil</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div> 
    </div>
</div>

<script>
    $(function () {
        <?php 
        foreach ($this->data as $key => $item) 
        {
            if($key == "photo")
            {
                if($item == "")
                    echo `$('#imagePreview').css('background-image', 'url(images/avatar/default.jpg)');\n`;
                else
                    echo "$('#imagePreview').css('background-image', 'url(images/users/$item)');\n";

            }
            else
            {
                echo "$(`#".$key."`).val('".$item."');\n";
            }
        }
        ?>
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