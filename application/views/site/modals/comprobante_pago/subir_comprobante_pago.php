<!-- Modal -->
<div class="modal fade text-left" name="modal_subir_comprobante_pago" id="modal_subir_comprobante_pago" tabindex="-1" role="dialog" aria-labelledby="modal_subir_comprobante_pago" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Subir comprobante de pago</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_comprobante_pago" enctype="multipart/form-data" action="<?php echo site_url('site/inmuebles/cargar_comprobante_pago'); ?>">
                <div class="modal-body">
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="comprobante">Cargar comprobante</label>
                            <input type="file" class="custom-file-input" name="comprobante" id="comprobante" placeholder="Seleccione el comprobante" value="<?php echo set_value('comprobante') == false ? $this->session->flashdata('comprobante') : set_value('comprobante'); ?>" required>
                            <input type="hidden" class="form-control" name="pago_identificador" id="pago_identificador" value="<?php echo $identificador; ?>" readonly>
                            <div class="invalid-feedback">
                                Se requiere un comprobante de pago válido.
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-outline-grey" data-dismiss="modal"><i class="fa fa-times-circle"></i>&nbsp;Atrás</button>
                    <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-check-circle"></i>&nbsp;Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>