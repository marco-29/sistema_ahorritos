<!-- Modal -->
<div class="modal fade text-left" name="modal_agregar_cliente_a_entidad" id="modal_agregar_cliente_a_entidad" tabindex="-1" role="dialog" aria-labelledby="seccion_agregar_cliente_a_entidad" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="seccion_agregar_cliente_a_entidad">Agregar cliente a entidad</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="form_agregar_cliente_a_entidad" action="<?php echo site_url('site/entidades/guardar_agregar_cliente_a_entidad'); ?>">
                <div class="modal-body">
                    <label>Seleccione un cliente: </label>
                    <div class="form-group">
                        <select id="cliente_identificador" name="cliente_identificador" class="form-control select2 custom-select" required>
                            <option value="" <?php echo set_select('cliente_identificador', '', set_value('cliente_identificador') ? false : '' == $this->session->flashdata('cliente_identificador')); ?>>Seleccione un cliente…</option>
                            <?php foreach ($clientes_list->result() as $key => $cliente_row) : ?>
                                <option value="<?php echo $cliente_row->identificador; ?>" <?php echo set_select('cliente_identificador', $cliente_row->identificador, set_value('cliente_identificador') ? false : $cliente_row->identificador == $this->session->flashdata('cliente_identificador')); ?>><?php echo trim(ucwords($cliente_row->nombre . ' ' . $cliente_row->apellido_paterno . ' ' . $cliente_row->apellido_materno) . ' | ' . $cliente_row->correo_electronico . ' | ' . $cliente_row->rfc . ' | ' . $cliente_row->telefono); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" class="form-control" name="identificador" id="identificador" value="" readonly>
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