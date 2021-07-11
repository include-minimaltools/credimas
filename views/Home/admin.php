<?php 
    $users = $this->data['users'];
    $tblUsers = $this->data['tblUsers'];

include 'Views/Shared/Layout.php' 
?>

<div class="users">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong class="card-title">Usuarios</strong>
                        </div>
                        <div class="top-right">
                            <div class="col">
                                <a class="btn btn-primary buttons-right" href="<?php echo constant('URL'); ?>/signup">Nuevo usuario</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-stats order-table ov-h">
                        <table class="table" id="tblUsers">
                            <thead>
                                <tr>
                                    <th scope="col">Usuario</th>
                                    <th scope="col" colspan="2">Nombre</th>
                                    <th scope="col" colspan="2">Apellido</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $tblUsers?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-8 -->
    </div>
</div>
<!-- /.orders -->

<div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserLabel">Datos del usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="avatar-upload">
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url('images/avatar/default.jpg')"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <input type="text" class="form-control" placeholder="" name="username" id="username" disabled>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Cédula</label>
                            <input type="text" disabled class="form-control" placeholder="999-999999-9999A" name="identification" id="identification">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Teléfono celular</label>
                            <input type="text" class="form-control" placeholder="8888-8888"  pattern="^[0-9]{4}-[0-9]{4}$" name="phone" id="phone" disabled>
                        </div>    
                    </div>
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" class="form-control" placeholder="" name="address" id="address" disabled>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Primer Nombre</label>
                            <input type="text" class="form-control" placeholder="" name="first_name" id="first_name" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Segundo Nombre</label>
                            <input type="text" class="form-control" placeholder="" name="second_name" id="second_name" disabled>
                        </div>
                    </div>
                </div> 
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <label>Primer Apellido</label>
                            <input type="text" class="form-control" placeholder="" name="first_lastname" id="first_lastname" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Segundo Apellido</label>
                            <input type="text" class="form-control" placeholder="" name="second_lastname" id="second_lastname" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Documento de identificacion</label>
                    <div class="color-red">
                        <img id="documentPreview" width="auto" height="auto" alt="No posee un documento de identificación, por favor evite verificar sin un documento de identificacion válido">
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Verificar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(document).on('click', 'td button[id*="btnVerify_"]', function (e) { 
            var id = $(e.target).attr('id').split('_')[1];
            var users = <?php echo $users; ?>;
            var user = users.find(x => x.ID == id);
            
            if(user.PHOTO != null && user.PHOTO != "")
                $('#imagePreview').css("background-image","url('images/users/" + user.PHOTO + "')");
            else
                $('#imagePreview').css("background-image","url('images/users/default.jpg')");

            if(user.IDENTIFICATION_PHOTO != null && user.IDENTIFICATION_PHOTO != "")
                $('#documentPreview').attr('src',`images/identification/${user.IDENTIFICATION_PHOTO}`);
            else
                $('#documentPreview').removeAttr('src');

            $('#username').val(user.USERNAME);
            $('#identification').val(user.IDENTIFICATION);
            $('#phone').val(user.PHONE);
            $('#address').val(user.ADDRESS);
            $('#first_name').val(user.FIRST_NAME);
            $('#second_name').val(user.SECOND_NAME);
            $('#first_lastname').val(user.FIRST_LASTNAME);
            $('#second_lastname').val(user.SECOND_LASTNAME);
        });
    });
</script>


<?php include 'Views/Shared/Footer.php' ?>