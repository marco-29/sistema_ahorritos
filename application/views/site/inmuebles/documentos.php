<?php $this->load->view('site/modals/archivos/ver_archivo'); ?>
<?php $this->load->view('site/modals/archivos/eliminar_archivo'); ?>

<div class="app-content content center-layout">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="content-header row px-1 my-1">
            <div class="content-header-left col-md-6 col-12">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/inicio'); ?>">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/desarrollos'); ?>">Desarrollos</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/desarrollos/ver/' . $desarrollo_row->inmueble_nodo_identificador); ?>"><?php echo ucfirst($desarrollo_row->nombre); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                            <li class="">&nbsp;&nbsp;&nbsp;&nbsp;<small><em><span name="mensaje_proceso_venta" id="mensaje_proceso_venta" class="info"></span></em></small></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                </div>
            </div>

        </div>
        <div class="content-detached content-right">
            <div class="content-body">

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">

                                    <?php echo form_open_multipart(site_url('site/inmuebles/cargar_documento_proceso_venta/' . $inmueble_row->identificador), array('class' => 'needs-validation', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                    <div class="row match-height">
                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                            <div class="row">

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="etapa">Etapa</label>
                                                            <div class="col-lg-12">
                                                                <select id="etapa" name="etapa" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('etapa', '', set_value('etapa') ? false : '' == $this->session->flashdata('etapa')); ?>>Seleccione una etapa…</option>
                                                                    <option value="contrato" <?php echo set_select('etapa', 'contrato', set_value('etapa') ? false : 'contrato' == $this->session->flashdata('etapa')); ?>>Contrato</option>
                                                                    <option value="actualización 1" <?php echo set_select('etapa', 'actualización 1', set_value('etapa') ? false : 'actualización 1' == $this->session->flashdata('etapa')); ?>>Actualización 1</option>
                                                                    <option value="actualización 2" <?php echo set_select('etapa', 'actualización 2', set_value('etapa') ? false : 'actualización 2' == $this->session->flashdata('etapa')); ?>>Actualización 2</option>
                                                                    <option value="actualización 3" <?php echo set_select('etapa', 'actualización 3', set_value('etapa') ? false : 'actualización 3' == $this->session->flashdata('etapa')); ?>>Actualización 3</option>
                                                                    <option value="actualización 4" <?php echo set_select('etapa', 'actualización 4', set_value('etapa') ? false : 'actualización 4' == $this->session->flashdata('etapa')); ?>>Actualización 4</option>
                                                                    <option value="actualización 5" <?php echo set_select('etapa', 'actualización 5', set_value('etapa') ? false : 'actualización 5' == $this->session->flashdata('etapa')); ?>>Actualización 5</option>
                                                                    <option value="actualización 6" <?php echo set_select('etapa', 'actualización 6', set_value('etapa') ? false : 'actualización 6' == $this->session->flashdata('etapa')); ?>>Actualización 6</option>
                                                                    <option value="actualización 7" <?php echo set_select('etapa', 'actualización 7', set_value('etapa') ? false : 'actualización 7' == $this->session->flashdata('etapa')); ?>>Actualización 7</option>
                                                                    <option value="actualización 8" <?php echo set_select('etapa', 'actualización 8', set_value('etapa') ? false : 'actualización 8' == $this->session->flashdata('etapa')); ?>>Actualización 8</option>
                                                                    <option value="actualización 9" <?php echo set_select('etapa', 'actualización 9', set_value('etapa') ? false : 'actualización 9' == $this->session->flashdata('etapa')); ?>>Actualización 9</option>
                                                                    <option value="actualización 10" <?php echo set_select('etapa', 'actualización 10', set_value('etapa') ? false : 'actualización 10' == $this->session->flashdata('etapa')); ?>>Actualización 10</option>
                                                                    <option value="escrituración" <?php echo set_select('etapa', 'escrituración', set_value('etapa') ? false : 'escrituración' == $this->session->flashdata('etapa')); ?>>Escrituración</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una etapa válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="tipo">Tipo de archivo</label>
                                                            <div class="col-lg-12">
                                                                <select id="tipo" name="tipo" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('tipo', '', set_value('tipo') ? false : '' == $this->session->flashdata('tipo')); ?>>Seleccione un tipo de archivo…</option>
                                                                    <option value="comprobante de domicilio" <?php echo set_select('tipo', 'comprobante de domicilio', set_value('tipo') ? false : 'comprobante de domicilio' == $this->session->flashdata('tipo')); ?>>Comprobante de domicilio</option>
                                                                    <option value="constancia de situación fiscal" <?php echo set_select('tipo', 'constancia de situación fiscal', set_value('tipo') ? false : 'constancia de situación fiscal' == $this->session->flashdata('tipo')); ?>>Constancia de situación fiscal</option>
                                                                    <option value="contrato firmado" <?php echo set_select('tipo', 'contrato firmado', set_value('tipo') ? false : 'contrato firmado' == $this->session->flashdata('tipo')); ?>>Contrato firmado</option>
                                                                    <option value="curp" <?php echo set_select('tipo', 'curp', set_value('tipo') ? false : 'curp' == $this->session->flashdata('tipo')); ?>>CURP</option>
                                                                    <option value="escritura" <?php echo set_select('tipo', 'escritura', set_value('tipo') ? false : 'escritura' == $this->session->flashdata('tipo')); ?>>Escritura</option>
                                                                    <option value="ine" <?php echo set_select('tipo', 'ine', set_value('tipo') ? false : 'ine' == $this->session->flashdata('tipo')); ?>>INE</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un tipo de archivo válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="pago_caja">Cargar archivo</label>
                                                            <div class="col-lg-12">
                                                                <fieldset class="form-group">
                                                                    <div class="custom-file">
                                                                        <label class="custom-file-label" for="archivo">Cargar archivo</label>
                                                                        <input type="file" class="custom-file-input" name="archivo" id="archivo" placeholder="Seleccione un archivo" value="<?php echo set_value('archivo') == false ? $this->session->flashdata('archivo') : set_value('archivo'); ?>" required>
                                                                        <div class="invalid-feedback">
                                                                            Se requiere un archivo válido.
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <hr>
                                                    <div class="form-group float-md-right">
                                                        <button type="submit" class="btn btn-outline-secondary btn-min-width"><i class="fa fa-check-circle"></i>&nbsp;Cargar</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>

                                    <div class="row match-height">

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Firma contrato</h4>
                                            <ul class="list-group mb-2">
                                                <?php if (!$contrato_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $contrato_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $contrato_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $contrato_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $contrato_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($contrato_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $contrato_comprobante_domicilio->identificador_origen . '/' . $contrato_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$contrato_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $contrato_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $contrato_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $contrato_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $contrato_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($contrato_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $contrato_constancia_ituacion_fiscal->identificador_origen . '/' . $contrato_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$contrato_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $contrato_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $contrato_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $contrato_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $contrato_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($contrato_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $contrato_curp->identificador_origen . '/' . $contrato_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$contrato_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $contrato_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $contrato_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $contrato_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $contrato_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($contrato_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $contrato_ine->identificador_origen . '/' . $contrato_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$contrato_contrato) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Contrato firmado
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $contrato_contrato->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $contrato_contrato->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $contrato_contrato->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $contrato_contrato->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($contrato_contrato->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $contrato_contrato->identificador_origen . '/' . $contrato_contrato->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Contrato firmado</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 1</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_1_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_1_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_1_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_1_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_1_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_1_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_1_comprobante_domicilio->identificador_origen . '/' . $actualizacion_1_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_1_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_1_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_1_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_1_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_1_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_1_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_1_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_1_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_1_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_1_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_1_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_1_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_1_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_1_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_1_curp->identificador_origen . '/' . $actualizacion_1_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_1_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_1_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_1_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_1_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_1_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_1_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_1_ine->identificador_origen . '/' . $actualizacion_1_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 2</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_2_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_2_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_2_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_2_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_2_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_2_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_2_comprobante_domicilio->identificador_origen . '/' . $actualizacion_2_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_2_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_2_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_2_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_2_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_2_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_2_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_2_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_2_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_2_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_2_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_2_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_2_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_2_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_2_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_2_curp->identificador_origen . '/' . $actualizacion_2_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_2_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_2_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_2_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_2_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_2_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_2_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_2_ine->identificador_origen . '/' . $actualizacion_2_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 3</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_3_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_3_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_3_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_3_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_3_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_3_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_3_comprobante_domicilio->identificador_origen . '/' . $actualizacion_3_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_3_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_3_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_3_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_3_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_3_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_3_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_3_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_3_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_3_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_3_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_3_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_3_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_3_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_3_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_3_curp->identificador_origen . '/' . $actualizacion_3_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_3_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_3_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_3_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_3_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_3_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_3_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_3_ine->identificador_origen . '/' . $actualizacion_3_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 4</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_4_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_4_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_4_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_4_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_4_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_4_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_4_comprobante_domicilio->identificador_origen . '/' . $actualizacion_4_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_4_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_4_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_4_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_4_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_4_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_4_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_4_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_4_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_4_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_4_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_4_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_4_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_4_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_4_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_4_curp->identificador_origen . '/' . $actualizacion_4_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_4_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_4_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_4_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_4_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_4_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_4_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_4_ine->identificador_origen . '/' . $actualizacion_4_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 5</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_5_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_5_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_5_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_5_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_5_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_5_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_5_comprobante_domicilio->identificador_origen . '/' . $actualizacion_5_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_5_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_5_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_5_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_5_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_5_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_5_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_5_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_5_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_5_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_5_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_5_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_5_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_5_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_5_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_5_curp->identificador_origen . '/' . $actualizacion_5_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_5_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_5_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_5_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_5_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_5_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_5_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_5_ine->identificador_origen . '/' . $actualizacion_5_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 6</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_6_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_6_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_6_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_6_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_6_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_6_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_6_comprobante_domicilio->identificador_origen . '/' . $actualizacion_6_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_6_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_6_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_6_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_6_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_6_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_6_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_6_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_6_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_6_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_6_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_6_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_6_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_6_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_6_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_6_curp->identificador_origen . '/' . $actualizacion_6_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_6_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_6_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_6_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_6_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_6_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_6_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_6_ine->identificador_origen . '/' . $actualizacion_6_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 7</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_7_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_7_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_7_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_7_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_7_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_7_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_7_comprobante_domicilio->identificador_origen . '/' . $actualizacion_7_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_7_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_7_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_7_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_7_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_7_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_7_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_7_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_7_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_7_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_7_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_7_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_7_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_7_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_7_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_7_curp->identificador_origen . '/' . $actualizacion_7_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_7_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_7_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_7_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_7_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_7_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_7_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_7_ine->identificador_origen . '/' . $actualizacion_7_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 8</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_8_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_8_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_8_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_8_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_8_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_8_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_8_comprobante_domicilio->identificador_origen . '/' . $actualizacion_8_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_8_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_8_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_8_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_8_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_8_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_8_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_8_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_8_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_8_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_8_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_8_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_8_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_8_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_8_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_8_curp->identificador_origen . '/' . $actualizacion_8_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_8_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_8_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_8_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_8_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_8_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_8_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_8_ine->identificador_origen . '/' . $actualizacion_8_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 9</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_9_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_9_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_9_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_9_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_9_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_9_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_9_comprobante_domicilio->identificador_origen . '/' . $actualizacion_9_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_9_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_9_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_9_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_9_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_9_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_9_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_9_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_9_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_9_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_9_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_9_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_9_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_9_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_9_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_9_curp->identificador_origen . '/' . $actualizacion_9_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_9_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_9_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_9_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_9_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_9_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_9_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_9_ine->identificador_origen . '/' . $actualizacion_9_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Actualización 10</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$actualizacion_10_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_10_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_10_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_10_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_10_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_10_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_10_comprobante_domicilio->identificador_origen . '/' . $actualizacion_10_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_10_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_10_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_10_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_10_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_10_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_10_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_10_constancia_ituacion_fiscal->identificador_origen . '/' . $actualizacion_10_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_10_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_10_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_10_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_10_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_10_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_10_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_10_curp->identificador_origen . '/' . $actualizacion_10_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$actualizacion_10_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $actualizacion_10_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $actualizacion_10_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $actualizacion_10_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $actualizacion_10_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($actualizacion_10_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $actualizacion_10_ine->identificador_origen . '/' . $actualizacion_10_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                        <div class="col-xl-12 col-md-12 col-sm-12">

                                            <h4 class="card-title">Escrituración</h4>

                                            <ul class="list-group mb-2">
                                                <?php if (!$escrituracion_comprobante_domicilio) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Comprobante de domicilio
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $escrituracion_comprobante_domicilio->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $escrituracion_comprobante_domicilio->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $escrituracion_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $escrituracion_comprobante_domicilio->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($escrituracion_comprobante_domicilio->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $escrituracion_comprobante_domicilio->identificador_origen . '/' . $escrituracion_comprobante_domicilio->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Comprobante de domicilio</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$escrituracion_constancia_ituacion_fiscal) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Constancia de situación fiscal
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $escrituracion_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $escrituracion_constancia_ituacion_fiscal->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $escrituracion_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $escrituracion_constancia_ituacion_fiscal->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($escrituracion_constancia_ituacion_fiscal->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $escrituracion_constancia_ituacion_fiscal->identificador_origen . '/' . $escrituracion_constancia_ituacion_fiscal->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Constancia de situación fiscal</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$escrituracion_curp) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        CURP
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $escrituracion_curp->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $escrituracion_curp->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $escrituracion_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $escrituracion_curp->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($escrituracion_curp->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $escrituracion_curp->identificador_origen . '/' . $escrituracion_curp->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;CURP</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$escrituracion_ine) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        INE
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $escrituracion_ine->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $escrituracion_ine->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $escrituracion_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $escrituracion_ine->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($escrituracion_ine->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $escrituracion_ine->identificador_origen . '/' . $escrituracion_ine->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;INE</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if (!$escrituracion_escritura) : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge badge-danger float-left mr-1">
                                                            Sin subir
                                                        </span>
                                                        <span class="float-right">
                                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Validar</button>
                                                            <button type="button" class="btn btn-danger btn-sm" disabled>Eliminar</button>
                                                        </span>
                                                        Escritura firmada
                                                    </li>
                                                <?php else : ?>
                                                    <li class="list-group-item">
                                                        <span class="badge <?php echo $escrituracion_escritura->estatus_validacion === 'si' ? 'badge-success' : 'badge-warning'; ?> float-left mr-1">
                                                            <?php echo $escrituracion_escritura->estatus_validacion === 'si' ? 'Validado' : 'Por validar'; ?>
                                                        </span>
                                                        <span class="float-right">
                                                            <a href="<?php echo site_url('site/inmuebles/cambiar_estatus_validacion_archivo/' . $escrituracion_escritura->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-secondary btn-sm">Validar</a>
                                                            <a href="<?php echo site_url('site/inmuebles/eliminar_archivo/' . $escrituracion_escritura->identificador . '/' . $inmueble_row->identificador); ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                                        </span>
                                                        <?php
                                                        $tipo_extension = pathinfo($escrituracion_escritura->archivo, PATHINFO_EXTENSION);

                                                        if (in_array($tipo_extension, array('pdf', 'doc', 'docx', 'xls'))) {
                                                            $tipo_extension = 'archivo';
                                                        } elseif (in_array($tipo_extension, array('jpg', 'png', 'jpeg'))) {
                                                            $tipo_extension = 'imagen';
                                                        }

                                                        echo '<a href="javascript:ver_archivo(\'' . site_url('almacenamiento/archivos/procesos_venta/' . $escrituracion_escritura->identificador_origen . '/' . $escrituracion_escritura->archivo) . '\',\'' . $tipo_extension . '\');"><i class="fa fa-file-o"></i>&nbsp;Escritura firmada</a>';
                                                        ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="sidebar-detached sidebar-left">
            <div class="sidebar">
                <div class="bug-list-sidebar-content">
                    <!-- Predefined Views -->
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo site_url('almacenamiento/site/recursos/inmuebles/portada-800x600.jpg'); ?>" class="img-fluid">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="my-3">
                                        <ul class="list-unstyled font-medium-2">
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/notas/' . $inmueble_row->identificador); ?>">1. Notas</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/plan_pagos/' . $inmueble_row->identificador); ?>">2. Plan de pagos</a></li>
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_cliente'); ?>">Datos del cliente</a></li-->
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/datos_inmueble'); ?>">Datos del inmueble</a></li-->
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/' . ($desarrollo_row->nombre == 'andeza' ? 'contrato' : ($desarrollo_row->nombre == 'portamar' ? 'contrato_portamar' : '')) . '/' . $inmueble_row->identificador); ?>">3. Contrato</a></li>
                                            <li><a class="" href="<?php echo site_url('site/inmuebles/facturacion/' . $inmueble_row->identificador); ?>">4. Facturación</a></li>
                                            <li><a class="active" href="<?php echo site_url('site/inmuebles/documentos/' . $inmueble_row->identificador); ?>"><b>5. Documentos</b></a></li>
                                            <!--li><a class="" href="<?php echo site_url('site/inmuebles/otros'); ?>">Otros</a></li-->
                                        </ul>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-12">
                                    <h4>Datos del inmueble:</h4><br>
                                    <p>Nombre del Inmueble<br>
                                        <b><?php echo strtoupper($inmueble_row->nombre); ?></b>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>Identificador<br><b><?php echo $inmueble_row->identificador; ?></b></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tipo de inmueble</b><br><?php echo ucfirst($inmueble_row->tipo_inmueble); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de construcción</b><br><?php echo $inmueble_row->tamanho_construccion . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño de la terraza</b><br><?php echo $inmueble_row->tamanho_terraza . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Tamaño del total</b><br><?php echo $inmueble_row->tamanho_total . "m<sup>2</sup>"; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Prototipo</b><br><?php echo $inmueble_row->prototipo; ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Modalidad</b><br><?php echo ucfirst($inmueble_row->modalidad); ?></p>
                                </div>
                                <div class="col-12">
                                    <p><b>Estatus del inmueble</b><br><?php echo ucfirst($inmueble_row->estatus); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Predefined Views -->
                </div>
            </div>
        </div>
    </div>
</div>