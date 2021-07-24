<?php require_once 'views/Shared/Layout.php' ?>

<div class="card">
    <div class="card-body form-group form-row">
        <div class="col">
            <label class="form-control form-control-plaintext">Cliente:</label>
            <select name="client" id="client" class="form-control">
                <?php echo $this->data['client_selector'];?>
            </select>
        </div>
        <div class="col-3">
            <label class="form-control form-control-plaintext">Estado de la cuota:</label>
            <select name="status" id="status" class="form-control">
                <option value="null">Seleccione un estado</option>
                <option value="All">Cualquiera</option>
                <option value="pending">Pendiente</option>
                <option value="late">Atrasado</option>
                <option value="paid">Pagado</option>
            </select>
        </div>
        <div class="col-auto color-white">
            <label class="form-control form-control-plaintext"></label>
            <a id="btnCharge" class="btn btn-info"><i class="fa fa-spinner" style="margin-right: 7px;"></i>Cargar</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table">
                <thead>
                    <h3>Cuotas del cliente</h3>
                    <tr>
                        <th>Numero de cuota</th>
                        <th>Moneda</th>
                        <th>Monto bruto</th>
                        <th>Interes</th>
                        <th>Descuento</th>
                        <th>Total a pagar</th>
                        <th>Estado</th>
                        <th>Aplicar descuento</th>
                    </tr>
                </thead>
                
                <tbody>
                <?php echo $this->data['dataTable'];?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDeduction" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="row">
                    <div class="col">
                        <h2>Aplicar descuento</h2>
                    </div>
                    <div class="top-right col-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
            <form action="<?php echo constant('URL');?>/editfee/processdeduction" method="POST">
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <input type="text" class="form-control" name="status" id="id_status" hidden>
                            <input type="text" class="form-control" name="client" id="id_client" hidden required>
                            <input type="text" class="form-control" name="id" id="id" hidden required>
                            <label>Monto:</label>
                            <input type="number" class="form-control" step="0.01" min="0" name="deduction" id="deduction" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="Submit">Deducir</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click', 'td label[id*="btnEdit_"]', function (e) {
        var id = $(e.target).attr('id').split('_')[1];
        var fees_documents = <?php echo $this->data['fees_documents'];?>;
        var fee_document = fees_documents.find(x => x.ID == id);

        $('#id').val(fee_document.ID);
        $('#deduction').val(fee_document.DEDUCTION);
        $('#deduction').attr('max',fee_document.GROSS_AMOUNT);

    });
    $(function(){
        $('#client').val(<?php echo $this->data['id_client'];?>);
        $('#status').val('<?php echo $this->data['status'];?>');
        $('#id_client').val(<?php echo $this->data['id_client'];?>);
        $('#id_status').val('<?php echo $this->data['status'];?>');
    });

    $('#btnCharge').on('click', function(){
        window.location = '<?php echo URL; ?>/editfee/render/' + $('#client').val() + '/' + $('#status').val();
    });
</script>

<?php require_once 'views/Shared/Footer.php' ?>