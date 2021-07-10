<?php 
    $users = $this->data['users'];

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
                                <?php echo $users?>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-8 -->
    </div>
</div>
<!-- /.orders -->


<?php include 'Views/Shared/Footer.php' ?>