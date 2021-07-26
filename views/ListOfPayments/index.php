<?php require_once 'views/Shared/Layout.php' ?>

<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <h3>Registro de pagos por revisar</h3>
                    <tr>
                        <th>Cliente</th>
                        <th>Cuota</th>
                        <th>Monto a pagar</th>
                        <th>Entidad Financiera</th>
                        <th>Moneda</th>
                        <th>Monto pagado</th>
                        <th>Tipo de Cambio</th>
                        <th>Estado</th>
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

<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <h3>Registro de pagos rechazados</h3>
                    <tr>
                        <th>Cliente</th>
                        <th>Cuota</th>
                        <th>Monto a pagar</th>
                        <th>Entidad Financiera</th>
                        <th>Moneda</th>
                        <th>Monto pagado</th>
                        <th>Tipo de Cambio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php echo $this->data['tblRejected'];?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <h3>Registro de pagos aceptados</h3>
                    <tr>
                        <th>Cliente</th>
                        <th>Cuota</th>
                        <th>Monto a pagar</th>
                        <th>Entidad Financiera</th>
                        <th>Moneda</th>
                        <th>Monto pagado</th>
                        <th>Tipo de Cambio</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php echo $this->data['tblAccepted'];?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="row">
                    <div class="col">
                        <h2>Verificación del pago</h2>
                    </div>
                    <div class="top-right col-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
            
                <div class="form-group">
                    <div class="col">
                        <div class="card text-white bg-flat-color-3">
                            <div class="card-body">
                                <div class="form-row">
                                    <h3 class="mb-0 fw-r">
                                        <span>Detalles del pago</span>
                                    </h3>
                                </div>
                                <div class="form-row">
                                    <label>Estado: <span id="status"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Entidad Financiera: <span id="financial_entity"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Tasa de cambio: <span id="exchange_rate"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Moneda: <span id="currency"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Monto del recibo: <span id="amount"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-flat-color-6">
                            <div class="card-body">
                                <div class="form-row">
                                    <h3 class="mb-0 fw-r">
                                        <span>Detalles de la cuota</span>
                                    </h3>
                                </div>
                                <div class="form-row">
                                    <label>Moneda de la cuota: <span id="document_currency"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Monto a pagar bruto: <span id="gross_amount"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Interes de la cuota: <span id="interes"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Descuento: <span id="deduction"></span></label>
                                </div>
                                <div class="form-row">
                                    <label>Total monto a pagar: <span id="total_amount"></span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card text-white bg-flat-color-1">
                            <div class="card-header">
                                <div class="form-row">
                                    <h3 class="mb-0 fw-r">
                                        <span>Imagen anexada del recibo</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body" id="image" style="background-image: none;">
                                <img src="" class="card card-body" alt="" id="transaction">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                <form action="<?php echo constant('URL');?>/listofpayments/refusepayment" method="POST">
                    <input type="text" id="id" name="id" hidden>
                    <button type="submit" class="btn btn-danger" id="Reject">Rechazar</button>
                </form>
                <form action="<?php echo constant('URL');?>/listofpayments/acceptpayment" method="POST">
                    <input type="text" id="id_2" name="id" hidden>
                    <button type="submit" class="btn btn-primary" id="Accept">Aprobar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var payments = <?php echo $this->data['payments']; ?>;

    $(document).on('click', 'td label[id*="btnEdit_"]', function (e) {
        var id = $(e.target).attr('id').split('_')[1];
        var payment = payments.find(x => x.id == id);
        
        if(payment.status != 'pending')
        {
            $('#Accept').attr('hidden',true);
            $('#Reject').attr('hidden',true);
        }
        else
        {
            $('#Accept').removeAttr('hidden');
            $('#Reject').removeAttr('hidden');
        }

        for(var prop in payment)
        {
            if(prop == "transaction")
            {
                $(`#${prop}`).attr('src','<?php echo URL?>/images/transaction/' + payment[prop]);
                $(`#${prop}`).attr('style','background-image:url(images/transaction/' + payment[prop] + ')');
            }
            else if (prop == "id")
            {
                $('#id').val(id);
                $('#id_2').val(id);
            }
            else
                $(`#${prop}`).html(payment[prop]);
        }
    });
</script>

<?php require_once 'views/Shared/Footer.php' ?>