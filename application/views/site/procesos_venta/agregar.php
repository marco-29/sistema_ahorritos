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
                            <li class="breadcrumb-item"><a href="<?php echo site_url('site/clientes'); ?>">Clientes</a></li>
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <!-- Outline button group with icons and text. -->
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-outline-grey btn-outline-lighten-1 btn-min-width mr-1" href="<?php echo site_url($ir_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="content-body">
            <section id="section">

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title"><?php echo $pagina_subtitulo; ?></h4>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <?php echo form_open(uri_string(), array('class' => 'needs-validation p-2', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                    <div class="row match-height">

                                        <div class="col-md-6 order-md-2 mb-4">
                                            <div name="detalles_inmueble" id="detalles_inmueble"></div>
                                        </div>

                                        <div class="col-md-6 order-md-1">

                                            <div class="row">

                                                <?php if (empty($identificador)) : ?>
                                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label class="col-lg-12 required-field" for="identificador">Inmueble</label>
                                                                <div class="col-lg-12">
                                                                    <select id="identificador" name="identificador" class="form-control select2 custom-select" required>
                                                                        <option value="" <?php echo set_select('identificador', '', set_value('identificador') ? false : '' == $this->session->flashdata('identificador')); ?>>Seleccione un inmueble…</option>
                                                                        <?php $flag_optgroup = false;  ?>
                                                                        <?php foreach ($inmuebles_list as $inmueble_key => $inmueble_value) : ?>
                                                                            <?php if ($inmueble_value->tipo_inmueble != 'desarrollo') : ?>
                                                                                <option value="<?php echo $inmueble_value->identificador; ?>" <?php echo set_select('identificador', $inmueble_value->identificador, set_value('identificador') ? false : $inmueble_value->identificador == $this->session->flashdata('identificador')); ?>><?php echo trim(mb_strtoupper($inmueble_value->nombre)) . (!empty($inmueble_value->identificador) ? ' | ' . $inmueble_value->identificador : ''); ?></option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                        </optgroup>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Se requiere un inmueble válido.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <input type="hidden" class="form-control" name="identificador" id="identificador" value="<?php echo $identificador; ?>" readonly>
                                                <?php endif; ?>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="cliente_identificador">Cliente</label>
                                                            <div class="col-lg-12">
                                                                <select id="cliente_identificador" name="cliente_identificador" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('cliente_identificador', '', set_value('cliente_identificador') ? false : '' == $this->session->flashdata('cliente_identificador')); ?>>Seleccione un cliente…</option>
                                                                    <?php foreach ($clientes_list as $cliente_key => $cliente_value) : ?>
                                                                        <option value="<?php echo $cliente_value->identificador; ?>" <?php echo set_select('cliente_identificador', $cliente_value->identificador, set_value('cliente_identificador') ? false : $cliente_value->identificador == $this->session->flashdata('cliente_identificador')); ?>><?php echo trim(mb_strtoupper($cliente_value->nombre . ' ' . $cliente_value->apellido_paterno . ' ' . $cliente_value->apellido_materno) . (!empty($cliente_value->correo_electronico) ? ' | ' . $cliente_value->correo_electronico : '') . (!empty($cliente_value->telefono) ? ' | ' . $cliente_value->telefono : '') . (!empty($cliente_value->rfc) ? mb_strtoupper(' | ' . $cliente_value->rfc) : '')); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un cliente válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="pago_caja">Pago de caja</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" step="0.01" class="form-control" name="pago_caja" id="pago_caja" placeholder="Pago de caja" value="<?php echo set_value('pago_caja') == false ? ($this->session->flashdata('pago_caja') ? $this->session->flashdata('pago_caja') : 0) : set_value('pago_caja'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un pago de caja válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="precio_venta">Precio de venta</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" step="0.01" class="form-control" name="precio_venta" id="precio_venta" placeholder="Precio de venta" value="<?php echo set_value('precio_venta') == false ? ($this->session->flashdata('precio_venta') ? $this->session->flashdata('precio_venta') : 0) : set_value('precio_venta'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un precio de venta válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="apartado">Apartado</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" step="0.01" class="form-control" name="apartado" id="apartado" placeholder="Apartado" value="<?php echo set_value('apartado') == false ? ($this->session->flashdata('apartado') ? $this->session->flashdata('apartado') : 100000) : set_value('apartado'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un apartado válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12" for="enganche">Enganche <small class="text-muted">(35% opcional)</small></label>
                                                            <div class="col-lg-12">
                                                                <input type="number" step="0.01" class="form-control" name="enganche" id="enganche" placeholder="Enganche" value="<?php echo set_value('enganche') == false ? ($this->session->flashdata('enganche') ? $this->session->flashdata('enganche') : 0) : set_value('enganche'); ?>">
                                                                <div class="invalid-feedback">
                                                                    Se requiere un enganche válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="saldo">Saldo</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" step="0.01" class="form-control" name="saldo" id="saldo" placeholder="Saldo" value="<?php echo set_value('saldo') == false ? ($this->session->flashdata('saldo') ? $this->session->flashdata('saldo') : 0) : set_value('saldo'); ?>" required readonly>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un saldo válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="no_pagos">No. pagos <small class="text-muted">(Semanal y único dejar 1)</small></label>
                                                            <div class="col-lg-12">
                                                                <input type="number" min="1" class="form-control" name="no_pagos" id="no_pagos" placeholder="No. pagos" value="<?php echo set_value('no_pagos') == false ? ($this->session->flashdata('no_pagos') ? $this->session->flashdata('no_pagos') : 36) : set_value('no_pagos'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere un no. pagos válido.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="cantidad_pago">Cantidad por pago</label>
                                                            <div class="col-lg-12">
                                                                <input type="number" min="1" class="form-control" name="cantidad_pago" id="cantidad_pago" placeholder="Cantidad por pago" value="<?php echo set_value('cantidad_pago') == false ? ($this->session->flashdata('cantidad_pago') ? $this->session->flashdata('cantidad_pago') : 0) : set_value('cantidad_pago'); ?>" required readonly>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una cantidad por pago válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="frecuencia">Frecuencia</label>
                                                            <div class="col-lg-12">
                                                                <select id="frecuencia" name="frecuencia" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('frecuencia', '', set_value('frecuencia') ? false : '' == $this->session->flashdata('frecuencia')); ?>>Seleccione una frecuencia…</option>
                                                                    <?php foreach (select_frecuencia() as $frecuencia_key => $frecuencia_value) : ?>
                                                                        <option value="<?php echo $frecuencia_value->valor; ?>" <?php echo $frecuencia_value->activo == false ? '' : 'selected'; ?> <?php echo set_select('frecuencia', $frecuencia_value->valor, set_value('frecuencia') ? false : $frecuencia_value->valor == $this->session->flashdata('frecuencia')); ?>><?php echo trim(mb_strtoupper($frecuencia_value->nombre)); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una frecuencia válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="dia_pago">Día de pago</label>
                                                            <div class="col-lg-12">
                                                                <select id="dia_pago" name="dia_pago" class="form-control select2 custom-select" required>
                                                                    <option value="" <?php echo set_select('dia_pago', '', set_value('dia_pago') ? false : '' == $this->session->flashdata('dia_pago')); ?>>Seleccione una día de pago…</option>
                                                                    <option value="1" selected <?php echo set_select('dia_pago', '1', set_value('dia_pago') ? false : '1' == $this->session->flashdata('dia_pago')); ?>>1</option>
                                                                    <option value="2" <?php echo set_select('dia_pago', '2', set_value('dia_pago') ? false : '2' == $this->session->flashdata('dia_pago')); ?>>2</option>
                                                                    <option value="3" <?php echo set_select('dia_pago', '3', set_value('dia_pago') ? false : '3' == $this->session->flashdata('dia_pago')); ?>>3</option>
                                                                    <option value="4" <?php echo set_select('dia_pago', '4', set_value('dia_pago') ? false : '4' == $this->session->flashdata('dia_pago')); ?>>4</option>
                                                                    <option value="5" <?php echo set_select('dia_pago', '5', set_value('dia_pago') ? false : '5' == $this->session->flashdata('dia_pago')); ?>>5</option>
                                                                    <option value="6" <?php echo set_select('dia_pago', '6', set_value('dia_pago') ? false : '6' == $this->session->flashdata('dia_pago')); ?>>6</option>
                                                                    <option value="7" <?php echo set_select('dia_pago', '7', set_value('dia_pago') ? false : '7' == $this->session->flashdata('dia_pago')); ?>>7</option>
                                                                    <option value="8" <?php echo set_select('dia_pago', '8', set_value('dia_pago') ? false : '8' == $this->session->flashdata('dia_pago')); ?>>8</option>
                                                                    <option value="9" <?php echo set_select('dia_pago', '9', set_value('dia_pago') ? false : '9' == $this->session->flashdata('dia_pago')); ?>>9</option>
                                                                    <option value="10" <?php echo set_select('dia_pago', '10', set_value('dia_pago') ? false : '10' == $this->session->flashdata('dia_pago')); ?>>10</option>
                                                                    <option value="11" <?php echo set_select('dia_pago', '11', set_value('dia_pago') ? false : '11' == $this->session->flashdata('dia_pago')); ?>>11</option>
                                                                    <option value="12" <?php echo set_select('dia_pago', '12', set_value('dia_pago') ? false : '12' == $this->session->flashdata('dia_pago')); ?>>12</option>
                                                                    <option value="13" <?php echo set_select('dia_pago', '13', set_value('dia_pago') ? false : '13' == $this->session->flashdata('dia_pago')); ?>>13</option>
                                                                    <option value="14" <?php echo set_select('dia_pago', '14', set_value('dia_pago') ? false : '14' == $this->session->flashdata('dia_pago')); ?>>14</option>
                                                                    <option value="15" <?php echo set_select('dia_pago', '15', set_value('dia_pago') ? false : '15' == $this->session->flashdata('dia_pago')); ?>>15</option>
                                                                    <option value="16" <?php echo set_select('dia_pago', '16', set_value('dia_pago') ? false : '16' == $this->session->flashdata('dia_pago')); ?>>16</option>
                                                                    <option value="17" <?php echo set_select('dia_pago', '17', set_value('dia_pago') ? false : '17' == $this->session->flashdata('dia_pago')); ?>>17</option>
                                                                    <option value="18" <?php echo set_select('dia_pago', '18', set_value('dia_pago') ? false : '18' == $this->session->flashdata('dia_pago')); ?>>18</option>
                                                                    <option value="19" <?php echo set_select('dia_pago', '19', set_value('dia_pago') ? false : '19' == $this->session->flashdata('dia_pago')); ?>>19</option>
                                                                    <option value="20" <?php echo set_select('dia_pago', '20', set_value('dia_pago') ? false : '20' == $this->session->flashdata('dia_pago')); ?>>20</option>
                                                                    <option value="21" <?php echo set_select('dia_pago', '21', set_value('dia_pago') ? false : '21' == $this->session->flashdata('dia_pago')); ?>>21</option>
                                                                    <option value="22" <?php echo set_select('dia_pago', '22', set_value('dia_pago') ? false : '22' == $this->session->flashdata('dia_pago')); ?>>22</option>
                                                                    <option value="23" <?php echo set_select('dia_pago', '23', set_value('dia_pago') ? false : '23' == $this->session->flashdata('dia_pago')); ?>>23</option>
                                                                    <option value="24" <?php echo set_select('dia_pago', '24', set_value('dia_pago') ? false : '24' == $this->session->flashdata('dia_pago')); ?>>24</option>
                                                                    <option value="25" <?php echo set_select('dia_pago', '25', set_value('dia_pago') ? false : '25' == $this->session->flashdata('dia_pago')); ?>>25</option>
                                                                    <option value="26" <?php echo set_select('dia_pago', '26', set_value('dia_pago') ? false : '26' == $this->session->flashdata('dia_pago')); ?>>26</option>
                                                                    <option value="27" <?php echo set_select('dia_pago', '27', set_value('dia_pago') ? false : '27' == $this->session->flashdata('dia_pago')); ?>>27</option>
                                                                    <option value="28" <?php echo set_select('dia_pago', '28', set_value('dia_pago') ? false : '28' == $this->session->flashdata('dia_pago')); ?>>28</option>
                                                                </select>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una día de pago válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12 required-field" for="fecha_inicio">Fecha inicio del plan de pagos</label>
                                                            <div class="col-lg-12">
                                                                <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha inicio del plan de pagos" value="<?php echo set_value('fecha_inicio') == false ? ($this->session->flashdata('fecha_inicio') ? $this->session->flashdata('fecha_inicio') : date('Y-m-d')) : set_value('fecha_inicio'); ?>" required>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una fecha inicio del plan de pagos válida.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12 mt-2 mb-2">
                                                    <h4 class="text-bold-800 grey darken-2">Nota</h4>
                                                </div>

                                                <div class="col-xl-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <label class="col-lg-12">Nota</label>
                                                            <div class="col-lg-12">
                                                                <textarea class="form-control" name="nota" id="nota" rows="8" maxlength="500" placeholder="Nota"><?php echo set_value('nota') == false ? $this->session->flashdata('nota') : set_value('nota'); ?></textarea>
                                                                <div class="invalid-feedback">
                                                                    Se requiere una nota válido.
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 media-right float-right text-right">
                                                                <small class="text-muted" name="nota-count" id="nota-count">0/500</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <hr>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <!--div class="form-group float-md-left">
												        </div-->
                                            <div class="form-group float-md-right">
                                                <a class="btn btn-outline-grey btn-outline-lighten-1 btn-min-width mr-1" href="<?php echo site_url($regresar_a); ?>"><i class="fa fa-arrow-circle-left"></i>&nbsp;Volver</a>
                                                <button type="submit" class="btn btn-outline-secondary btn-min-width mr-1"><i class="fa fa-check-circle"></i>&nbsp;Guardar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php echo form_close(); ?>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>
</div>