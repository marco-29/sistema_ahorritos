<!-- Modal -->
<div class="modal fade text-left" name="modal_eliminar_archivo" id="modal_eliminar_archivo" tabindex="-1" role="dialog" aria-labelledby="seccion_eliminar_archivo" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="seccion_eliminar_archivo">¿Está seguro de querer eliminar este archivo?</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_eliminar_archivo" action="<?php echo site_url('site/proyectos/eliminar_archivo'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <p class="text-justify">¿Está seguro de que desea eliminar el archivo?, está acción no se podrá revertir y los archivos no se podrán recuperar.</p>
                        <input type="hidden" class="form-control" name="url_archivo" id="url_archivo" value="" readonly>
                        <input type="hidden" class="form-control" name="carpeta" id="carpeta" value="" readonly>
                        <input type="hidden" class="form-control" name="archivo" id="archivo" value="" readonly>
                        <input type="hidden" class="form-control" name="servicio" id="servicio" value="" readonly>
                        <input type="hidden" class="form-control" name="url" id="url" value="" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp;Volver</button>
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-check-circle"></i>&nbsp;Sí, eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>