<!-- Modal -->
<div class="modal fade text-left" name="modal_eliminar" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="seccion_eliminar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="seccion_eliminar">Cancelar</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" name="form_eliminar" id="form_eliminar" action="<?php echo site_url('site/notas/eliminar'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-justify">¿Está seguro de que desea eliminar este registro, está acción no se podrá revertir y la información no se podrán recuperar.</p>
                        <input type="hidden" class="form-control" name="identificador" id="identificador" value="" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-grey" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp;Atrás</button>
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-check-circle"></i>&nbsp;Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
