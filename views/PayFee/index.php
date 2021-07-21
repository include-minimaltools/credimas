<?php 
require_once "views/Shared/Layout.php";
require_once "database/FEE_DOCUMENT.php";

$fee_document = new FEE_DOCUMENT();
$fee_document->From($this->data["fee_document"]);

$interes_amount = $fee_document->TOTAL_AMOUNT - $fee_document->GROSS_AMOUNT + $fee_document->DEDUCTION;
?>

<div class="card">
    <form action="<?php echo constant('URL');?>/payfee/savepayfee" method="post" enctype="multipart/form-data">
        <div class="card-header">
            <h2>Pagar cuota</h2>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="col">
                    <div class="row">
                        <label class="h3">Detalles de la cuota</label>
                    </div>
                    <div class="row">
                        <label>Número de cuota: <?php echo $fee_document->N_PARTIAL?></label>
                    </div>
                    <div class="row">
                        <label>Cliente: <?php echo $this->data["name"]?></label>
                    </div>
                    <div class="row">
                        <label>Prestamista: <?php echo $this->data["lender"]["FIRST_NAME"] . ' ' . $this->data["lender"]["FIRST_LASTNAME"]; ?></label>
                    </div>
                    <div class="row">
                        <label>Moneda: <?php echo $this->data["currency"]["DESCRIPTION"]?></label>
                    </div>
                    <div class="row">
                        <label>Monto bruto: <?php echo $fee_document->GROSS_AMOUNT?>  </label>
                    </div>
                    <div class="row">
                        <label>Interés: <?php echo $interes_amount ?></label>
                    </div>
                    <div class="row">
                        <label>Descuento: <?php echo $fee_document->DEDUCTION?></label>
                    </div>
                    <div class="row">
                        <label>Monto total a pagar: <?php echo $fee_document->TOTAL_AMOUNT?> </label>
                    </div>
                </div>
            </div>
            
            <input type="text" value="<?php echo $fee_document->CURRENCY?>" name="document_currency" id="document_currency" hidden>
            <input type="text" value="<?php echo $fee_document->ID?>" name="fee_id" id="fee_id" hidden>
            <div class="form-group form-row">
                <div class="col">
                    <label>Entidad financiera:</label>
                    <select name="financialentity" id="financialentity" class="form-control" required>
                    <?php echo $this->data["financialentities_selector"];?>
                    </select>
                </div>
                <div class="col">
                    <label>Moneda:</label>
                    <select name="currency" id="currency" class="form-control" required>
                        <?php echo $this->data["currencies_selector"];?>
                    </select>
                </div>
            </div>
            <div class="form-group form-row">
                <div class="col">
                    <label>Monto:</label>
                    <input type="number" name="amount" id="amount" class="form-control" required>
                </div>
                <div class="col">
                    <label>Tasa de Cambio</label>
                    <input type="number" step="0.01" class="form-control" id="exchange_rate" name="exchange_rate" value=1 disabled>
                </div>
            </div>
            <div class="form-group form-row">
                <div class="col">
                    <label>Imagen del Recibo</label>
                    <input type="file" name="transaction" id="transaction" hidden>

                    <div class="row">
                        <div class="col-sm-2">
                            <label for="transaction" class="btn btn-outline-secondary" required>Cargar Imagen</label>
                        </div>
                        <div class="col">
                            <input type="button" data-toggle="modal" data-target="#modalImage" class="btn btn-outline-secondary" value="Visualizar Imagen" id="btnModal" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group color-red">
            <p><?php echo $this->showMessages(); ?></p>
        </div>
        <div class="card-footer">
            <input type="submit" value="Realizar pago" class="btn btn-primary">
            <a class="btn btn-info" href="<?php echo constant('URL');?>/viewloans" style="margin-top:0px;">
                <i class="fa fa-arrow-circle-left" style="margin-right:5px;"></i>Volver
            </a>
        </div>
    </form>
</div>

<!-- Modal para visualizar el recibo -->
<div class="modal fade" id="modalImage" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="row">
                    <div class="col">
                        <h2>Recibo</h2>
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
                    <img id="documentPreview" width="auto" height="auto" alt="No posee una imagen del recibo de la transacción.">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#currency').on('change',function(){
    if($('#currency').val() === null || $('#currency').val() === '' || $('#currency').val() === '<?php echo $fee_document->CURRENCY?>')
    {
        $('#exchange_rate').val(1);
        $('#exchange_rate').attr('disabled',true);
        $('#exchange_rate').removeAttr('required');
    }
    else
    {
        $('#exchange_rate').attr('required', true);
        $('#exchange_rate').removeAttr('disabled');
    }
});

$("#transaction").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#documentPreview').attr('src',e.target.result);
            $('#btnModal').removeAttr('disabled');
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>

<?php require_once "views/Shared/Footer.php" ?>