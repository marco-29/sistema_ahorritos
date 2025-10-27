<!-- Modal -->
<?php echo header("X-Frame-Options: SAMEORIGIN"); ?>
<div class="modal fade text-left" name="modal_ver_archivo" id="modal_ver_archivo" tabindex="-1" role="dialog" aria-labelledby="seccion_ver_archivo" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="seccion_ver_archivo">Archivo</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" name="vista_previa" id="vista_previa">
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-outline-grey" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp;Atrás</button>
            </div>
        </div>
    </div>
</div>
