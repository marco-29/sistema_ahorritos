<div class="app-content content center-layout">
    <div class="content-wrapper">



        <div class="row">
            <div class="col-12">
                <div class="card card-vista-titulos ">
                    <h3 class="text-white"><strong><?php echo $pagina_titulo; ?></strong></h3>
                </div>
            </div>
        </div>

        <div class="content-header row px-2 mb-1">

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
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <!-- <a class="btn btn-outline-secondary" href="<?php //echo site_url('site/inmuebles/agregar'); 
                                                                            ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</a> -->
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

                                    <div name="reporte_desarrollos" id="reporte_desarrollos">
                                    </div>

                                    <table name="table" id="table" class="table display nowrap table-striped table-bordered scroll-horizontal table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Identificador</th>
                                                <th>Desarrollo</th>
                                                <th>Inmueble</th>
                                                <th>Tamaño total m<sup>2</sup></th>
                                                <th>Precio lista</th>
                                                <th>Precio venta</th>
                                                <th>Apartado</th>
                                                <th>Enganche</th>
                                                <th>Pagado</th>
                                                <th>No. pagos</th>
                                                <th>Frecuencia</th>
                                                <th>Fecha inicio</th>
                                                <th>Estatus del proceso de venta</th>
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