<?php 
    $clients = $this->data['clients'];

include 'Views/Shared/Layout.php' 
?>

<div class="users">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong class="card-title">Clientes</strong>
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
                                    <th scope="col">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $clients?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'Views/Shared/Footer.php' ?>