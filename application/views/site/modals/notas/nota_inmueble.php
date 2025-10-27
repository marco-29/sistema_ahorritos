<!-- Modal -->
<div class="modal fade text-left" name="modal_nota_inmueble" id="modal_nota_inmueble" tabindex="-1" role="dialog" aria-labelledby="modal_nota_inmueble" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Notas del inmueble</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_nota" action="<?php echo site_url('site/inmuebles/guardar_nota'); ?>">
                <div class="modal-body">
                    <label>Agregar nota: </label>
                    <div class="form-group">
                        <textarea class="form-control" name="nota" id="nota" cols="30" rows="10" rows="4" placeholder="Nota"></textarea>
                        <input type="hidden" class="form-control" name="identificador" id="identificador" value="<?php echo $inmueble_row->identificador; ?>" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-grey" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp;Atrás</button>
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-check-circle"></i>&nbsp;Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>