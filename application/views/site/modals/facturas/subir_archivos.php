<!-- Modal -->
<div class="modal fade text-left" name="modal_subir_archivos" id="modal_subir_archivos" tabindex="-1" role="dialog" aria-labelledby="modal_subir_archivos" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <label class="modal-title text-text-bold-600" id="myModalLabel33">Subir archivos</label>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row match-height mb-2 font-medium-2">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <table class="table table-borderless table-sm">
                        <tbody>
                            <tr>
                                <td>Identificador:</td>
                                <td class="text-right">
                                        <b><span name="identificador_factura" id="identificador_factura"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Desarrollo:</td>
                                <td class="text-right">
                                        <b><span name="desarrollo" id="desarrollo"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Inmueble:</td>
                                <td class="text-right">
                                        <b><span name="inmueble" id="inmueble"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Pago identificador:</td>
                                <td class="text-right">
                                    <b><span name="pago_identificador" id="pago_identificador"></span></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <table class="table table-borderless table-sm">
                        <tbody>
                            <tr>
                                <td>Concepto del pago:</td>
                                <td class="text-right">
                                        <b><span name="concepto" id="concepto"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre del cliente:</td>
                                <td class="text-right">
                                        <b><span name="cliente" id="cliente"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Monto:</td>
                                <td class="text-right">
                                        <b><span name="monto" id="monto"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>RFC:</td>
                                <td class="text-right">
                                        <b><span name="rfc" id="rfc"></span></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <table class="table table-borderless table-sm">
                        <tbody>
                            <tr>
                                <td>Codigo postal:</td>
                                <td class="text-right">
                                        <b><span name="codigo_postal" id="codigo_postal"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Regimen fiscal:</td>
                                <td class="text-right">
                                        <b><span name="regimen_fiscal" id="regimen_fiscal"></span></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Uso CFDI:</td>
                                <td class="text-right">
                                        <b><span name="cfdi" id="cfdi"></span></b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="post" id="form_archivos" enctype="multipart/form-data" action="<?php echo site_url('site/inmuebles/cargar_archivos'); ?>">
                <div class="modal-body">
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="archivo">Cargar archivo PDF</label>
                            <input type="file" class="custom-file-input" name="archivo" id="archivo" placeholder="Seleccione el archivo PDF" value="<?php echo set_value('archivo') == false ? $this->session->flashdata('archivo') : set_value('archivo'); ?>">
                            <input type="hidden" class="form-control" name="factura_identificador" id="factura_identificador" value="<?php echo $identificador; ?>" readonly>
                            <div class="invalid-feedback">
                                Se requiere un archivo válido.
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="archivo_2">Cargar archivo XML</label>
                            <input type="file" class="custom-file-input" name="archivo_2" id="archivo_2" placeholder="Seleccione el archivo XML" value="<?php echo set_value('archivo_2') == false ? $this->session->flashdata('archivo_2') : set_value('archivo_2'); ?>">
                            <input type="hidden" class="form-control" name="factura_identificador_2" id="factura_identificador_2" value="<?php echo $identificador; ?>" readonly>
                            <div class="invalid-feedback">
                                Se requiere un archivo XML válido.
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-body">
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <label class="custom-file-label" for="carpeta">Cargar carpeta zip</label>
                            <input type="file" class="custom-file-input" name="carpeta" id="carpeta" placeholder="Seleccione la carpeta zip" value="<?php echo set_value('carpeta') == false ? $this->session->flashdata('carpeta') : set_value('carpeta'); ?>">
                            <input type="hidden" class="form-control" name="factura_identificador_3" id="factura_identificador_3" value="<?php echo $identificador; ?>" readonly>
                            <div class="invalid-feedback">
                                Se requiere una carpeta válida.
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