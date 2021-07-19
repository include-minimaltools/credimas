<?php
require_once "views/Shared/Layout.php";
?>

<div class="profile">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="">Nuevo préstamo</h1>
                    </div>
                    <form action="<?php echo constant('URL');?>/newloan/createloan" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Prestamista:</label>
                                <select name="lender" id="lender" class="form-control" disabled>
                                    <?php echo $this->data['lender']?>
                                </select>
                            </div>    
                            <div class="col">
                                <label>Prestatario:</label>
                                <select name="client" id="client" class="form-control" required>
                                    <?php echo $this->data['clients']?>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Moneda:</label>
                                <select name="currency" id="currency" class="form-control" required>
                                    <?php echo $this->data['currencies']?>
                                </select>
                            </div>
                            <div class="col">
                                <label>Monto a prestar:</label>
                                <input type="number" class="form-control" placeholder="$" name="gross_amount" id="gross_amount" required>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Cuotas:</label>
                                <input type="number" class="form-control" name="partials" id="partials" required>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Interes (%):</label>
                                    <input type="number" class="form-control" name="interes_rate" id="interes_rate" placeholder="%" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Monto por Cuota:</label>
                                <input type="number" step="0.01" class="form-control" placeholder="" name="partial_amount" id="partial_amount">
                            </div>
                            <div class="col">
                                <label>Recibo de transacción:</label>
                                <input hidden type="file" id="loan_receipt">
                                <div class="row">
                                    <div class="col">
                                        <button disabled data-toggle="modal" id="btnModal" data-target="#modalImage" class="form-control">Visualizar recibo</button>
                                    </div>
                                    <div class="col">
                                        <label for="loan_receipt" id="lblloan_receipt" class="form-control btn-outline-primary">Cambiar imagen</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Plazo:</label>
                                <select name="term" id="term" class="form-control">
                                    <option value="">Seleccione un plazo</option>
                                    <option value="7">Semanal</option>
                                    <option value="15">Quincenal</option>
                                    <option value="30">Mensual</option>
                                    <option value="60">Bimestral</option>
                                    <option value="90">Trimestral</option>
                                    <option value="120">Cuatrimestral</option>
                                    <option value="360">Anual</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Fecha de incio:</label>
                                <input type="date" name="date" class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30"><i style="margin-right:10px;" class="fa fa-money"></i>Generar préstamo</button>
                            </div>
                            <div class="col-sm-3">
                                <a href="<?php echo constant('URL')?>/" class="btn btn-info btn-flat m-b-30 m-t-30"><i style="margin-right:10px;" class="fa fa-arrow-left"></i>Volver al inicio</a>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div> 
        </div> 
    </div>
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
                    <img id="documentPreview" width="auto" height="auto" alt="No posee un documento de identificación, por favor evite verificar sin un documento de identificacion válido">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
$('#partials').change(function(){
    calculatePartialAmount();
});
$('#gross_amount').on('change',function()
{
    calculatePartialAmount();
});

$('#partial_amount').on('change',function()
{
    calculatePartialAmount();
});

$("#loan_receipt").change(function() {
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#documentPreview').attr('src',e.target.result);
            $('#btnModal').removeAttr('disabled');
        };
        reader.readAsDataURL(this.files[0]);
    }
});

function calculatePartialAmount()
{
    var partials = $('#partials').val();
    var gross_amount = $('#gross_amount').val();

    if(partials === null || partials === "" || gross_amount === null || gross_amount === "" || partials === "0")
    {
        $('#partial_amount').val(0);
        return;
    }

    var partial_amount = (parseFloat(gross_amount)/parseFloat(partials)).toFixed(2);

    $('#partial_amount').val(partial_amount);
}

</script>

<?php require_once 'views/Shared/Footer.php'?>