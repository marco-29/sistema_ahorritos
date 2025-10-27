<?php $this->load->view('site/modals/comprobante_pago/ver_archivo'); ?>
<div class="app-content content center-layout">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos ">
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
                            <li class="breadcrumb-item active"><?php echo $pagina_titulo; ?></li>
                            <?php foreach ($pagos_list as $key => $pago_row) :  ?>
                                <?php if ($key + 1 > 0) : ?>
                                    <li class="">&nbsp;&nbsp;&nbsp;&nbsp;<small><em><span name="mensaje_proceso_venta" id="mensaje_proceso_venta" class="info"></span></em></small></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>

            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group float-md-right mr-1 mb-1">
                        <div id="buttons"></div>
                    </div>

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <button type="button" class="btn btn-outline-secondary btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</button>
                            <div class="dropdown-menu">
                                <?php echo $menu_servicios; ?>
                            </div>
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
                                <h4 class="card-title">Registro de <?php echo $pagina_titulo; ?></h4>
                            </div>

                            <!-- <div class="row mt-2 mb-2">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"><i class="ft-filter"></i> Seleccionar cliente</label>
                                        <div class="col-12">
                                            <select id="mes_a_consultar" name="mes_a_consultar" class="select2 form-control">

                                                <option value="" <?php echo set_select('relleno_sanitario', '', set_value('relleno_sanitario') ? false : '' == $this->session->flashdata('relleno_sanitario')); ?>>Seleccione un cliente…</option>
                                                <?php foreach ($clientes as $cliente_row) : ?>
                                                    <option value="<?php echo $cliente_row->identificador; ?>" <?php echo set_select('relleno_sanitario', $cliente_row->identificador, set_value('relleno_sanitario') ? false : $cliente_row->identificador == $this->session->flashdata('relleno_sanitario')); ?>><?php echo trim($cliente_row->nombre); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"><i class="ft-filter"></i> Año fiscal</label>
                                        <div class="col-10">
                                            <select id="mes_a_consultar" name="mes_a_consultar" class="select2 form-control">

                                                <?php foreach ($periodo_mensual_list as $periodo_mensual_row) : ?>
                                                    <?php
                                                    $date = DateTime::createFromFormat("Y-m", $periodo_mensual_row->format("Y-m"));
                                                    ?>
                                                    <option value="<?php echo $periodo_mensual_row->format("Y"); ?>" <?php echo set_select('mes_a_consultar', $periodo_mensual_row->format("Y"), set_value('mes_a_consultar') ? false : $periodo_mensual_row->format("Y") == date('Y')); ?>><?php echo ucfirst(strftime("%Y", $date->getTimestamp())); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"><i class="ft-filter"></i> Mes</label>
                                        <div class="col-10">
                                            <select id="mes_a_consultar" name="mes_a_consultar" class="select2 form-control">

                                                <?php foreach ($periodo_mensual_list as $periodo_mensual_row) : ?>
                                                    <?php
                                                    $date = DateTime::createFromFormat("Y-m", $periodo_mensual_row->format("Y-m"));
                                                    ?>
                                                    <option value="<?php echo $periodo_mensual_row->format("Y-m"); ?>" <?php echo set_select('mes_a_consultar', $periodo_mensual_row->format("Y-m"), set_value('mes_a_consultar') ? false : $periodo_mensual_row->format("Y-m") == date('Y-m')); ?>><?php echo ucfirst(strftime("%B", $date->getTimestamp())); ?></option>
                                                <?php endforeach; ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"> Total a pagar</label>
                                        <div class="col-9">
                                            <h1 style="color: skyblue;"><span>$80,000.00</span></h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"> Pagado</label>
                                        <div class="col-9">
                                            <h1 style="color: skyblue;"><b>$0</b></h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="col-12"> Saldo</label>
                                        <div class="col-9">
                                            <h1 style="color: skyblue;"><b>$4,500.00</b></h1>
                                        </div>
                                    </div>
                                </div>

                            </div-->

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="row match-height mb-2 font-medium-2">
                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Total pagos calendarizado:</td>
                                                        <td class="text-right">
                                                            <b><span name="precio_venta" id="precio_venta"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. pagos:</td>
                                                        <td class="text-right">
                                                            <b><span name="no_pagos" id="no_pagos"></span></b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Total pagos pagados:</td>
                                                        <td class="text-right">
                                                            <b><span name="pagado" id="pagado"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total pagos por validar:</td>
                                                        <td class="text-right">
                                                            <b><span name="por_validar" id="por_validar"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total pagos por cobrar:</td>
                                                        <td class="text-right">
                                                            <b><span name="por_cobrar" id="por_cobrar"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total pagos vencido:</td>
                                                        <td class="text-right">
                                                            <b><span name="vencido" id="vencido"></span></b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Inmueble</th>
                                                <th>Identificador proceso de venta</th>
                                                <th>Fecha programada</th>
                                                <th>Fecha pago</th>
                                                <th>Concepto</th>
                                                <th>Monto</th>
                                                <th>Comprobante de pago</th>
                                                <th>Comprobante de pago para expediente</th>
                                                <th>Estatus pago</th>
                                                <th>Estatus sistema</th>
                                                <th>Fecha registro</th>
                                                <th>Fecha actualización</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>
        </div>

    </div>
</div>