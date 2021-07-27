<?php 
    $lenders = $this->data['lenders'];

include 'Views/Shared/Layout.php' 
?>

<div class="users">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong class="card-title">Prestamistas</strong>
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
                                    <th scope="col">Número de contacto</th>
                                    <!-- <th scope="col">Accion</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $lenders?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title">Cuotas no pagadas</strong>
    </div>
    <div class="card-body">
        <div class="table-danger table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Número de cuota</th>
                        <th>Fecha de pago</th>
                        <th>Monto a pagar</th>
                        <th>Prestamista</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $this->data['tblLate'];?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <strong class="card-title">Cuotas pendientes</strong>
    </div>
    <div class="card-body">
        <div class="table-primary table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Número de cuota</th>
                        <th>Fecha de pago</th>
                        <th>Monto a pagar</th>
                        <th>Prestamista</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $this->data['tblPending'];?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).on('click', 'td button[id*="btnPay_"]', function (e) {
        var id = $(e.target).attr('id').split('_')[1];
        window.location = '<?php echo constant('URL'); ?>/payfee/render/' + id;
    });
</script>

<?php include 'Views/Shared/Footer.php' ?>