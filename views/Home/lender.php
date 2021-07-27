<?php 
    $clients = $this->data['clients'];

include 'Views/Shared/Layout.php' 
?>
<div class="col-2">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Tipo de cliente:</label>
                <select id="client_type" class="form-control">
                    <option value="A">A - Excelente</option>
                    <option value="B">B - Correcto</option>
                    <option value="C">C - Regular</option>
                    <option value="D">D - Pésimo</option>
                </select>
            </div>
        </div>
    </div>
</div>


<div class="users">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <strong class="card-title">Clientes</strong>
                        </div>
                        <div class="col-auto">
                            <a href="<?php echo URL;?>/newclient" class="btn btn-primary">Nuevo Cliente</a>
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
                                    <th>Tipo</th>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <form action="<?php echo URL?>/lender/updatetype" method="post">
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
                    <label>Tipo</label>
                    <input class="form-control" id="id" name="id" hidden>
                    <select class="form-control" name="type" id="type">
                        <option value="A">A - Excelente</option>
                        <option value="B">B - Correcto</option>
                        <option value="C">C - Regular</option>
                        <option value="D">D - Pésimo</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
                <input type="submit" class="btn btn-primary" value="Editar">
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    var clients = <?php echo $this->data['clients_data'];?>;

    $(function(){
        $('#client_type').val('<?php echo $this->data['type'];?>');
    })

    $('#client_type').change(function(){
        window.location = '<?php echo URL?>/lender/render/' + $('#client_type').val();
    });

    $(document).on('click', 'td button[id*="btnEdit_"]', function (e) {
        var id = $(e.target).attr('id').split('_')[1];
        var client = clients.find(x => x.ID == id);

        $('#id').val(client.ID);    
        $('#type').val(client.TYPE);
    });
</script>

<?php include 'Views/Shared/Footer.php' ?>