<?php 
    $dataTable = $this->data['dataTable'];
    $currencies = $this->data['currencies'];
include 'Views/Shared/Layout.php' 
?>

<div class="users">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong class="card-title">Monedas y Divisas</strong>
                        </div>
                        <div class="top-right">
                            <div class="col color-white">
                                <button id="btnAdd" class="btn btn-primary buttons-right" data-toggle="modal" data-target="#modalCurrency">Nueva moneda/divisa</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-stats order-table ov-h">
                        <table class="table" id="tblUsers">
                            <thead>
                                <tr>
                                    <th scope="col">Id Moneda</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $dataTable?>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCurrency" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="row">
                    <div class="col">
                        <h2>Moneda / Divisa</h2>
                    </div>
                    <div class="top-right col-1">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-body">
            <form action="<?php echo constant('URL');?>/currencies/InsertOrUpdateCurrency" method="POST">
                <div class="form-row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Moneda:</label>
                            <input type="text" maxlength="10" class="form-control" name="id" id="id" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Descripción:</label>
                            <input type="text" maxlength="100" class="form-control" name="description" id="description" required>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="Submit">Agregar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>

var currencies = <?php echo $currencies ?>;

$(function(){
    
    $(document).on('click', 'td button[id*="btnEdit_"]', function (e) {

        var id = $(e.target).attr('id').split('_')[1];
        var currency = currencies.find(x => x.ID == id);
        
        $('#id').attr('disabled', true);
        $('#Submit').html('Actualizar');
        $('#id').val(currency.ID);
        $('#description').val(currency.DESCRIPTION);
    });

    $('#Submit').on('click', function(){
        $('#id').removeAttr('disabled');
    });

    $('#btnAdd').on('click', function() {
        $('#Submit').html('Agregar');
        $('#id').val('');
        $('#description').val('');
        $('#id').removeAttr('disabled');
    });
    
});

</script>

<?php include 'Views/Shared/Footer.php' ?>