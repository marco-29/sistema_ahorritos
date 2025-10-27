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
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">
                <div class="media float-right">
                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary btn-min-width" href="<?php echo site_url('site/como_se_entero/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar como se entero</a>
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

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <!-- <div class="row match-height mb-2 font-medium-2">
                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                            <table class="table table-borderless table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td>Total:</td>
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
                                                        <td>Pagado:</td>
                                                        <td class="text-right">
                                                            <b><span name="pagado" id="pagado"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Por validar:</td>
                                                        <td class="text-right">
                                                            <b><span name="por_validar" id="por_validar"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Por cobrar:</td>
                                                        <td class="text-right">
                                                            <b><span name="por_cobrar" id="por_cobrar"></span></b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vencido:</td>
                                                        <td class="text-right">
                                                            <b><span name="vencido" id="vencido"></span></b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> -->

                                    <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Nombre</th>
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