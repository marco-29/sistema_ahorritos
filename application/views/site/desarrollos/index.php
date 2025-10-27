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
                            <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Inicio</a></li>
                            <li class="breadcrumb-item active">Inmuebles</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="content-header-right col-md-6 col-12">

                <div class="media float-right">

                    <div class="form-group">
                        <div class="btn-group mr-1 mb-1">
                            <a class="btn btn-outline-secondary btn-min-width" href="<?php echo site_url('site/desarrollos/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar desarrollo&nbsp;<i class="fa fa-building-o"></i></a>
                            <!-- <a class="btn btn-outline-secondary btn-min-width" href="<?php echo site_url('site/inmuebles/agregar'); ?>"><i class="fa fa-plus-circle"></i>&nbsp;Agregar inmueble&nbsp;<i class="fa fa-home"></i></a> -->
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="content-body">
            <section id="basic-examples">

                <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                <div class="row">
                    <div class="col-12 mb-1">
                        <h4 class=""><?php echo $pagina_subtitulo; ?></h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mt-1">
                        <h4 class="text-muted">Desarrollos</h4>
                    </div>
                </div>

                <hr>

                <div class="row match-height mb-2" name="tipo_inmueble_desarrollos" id="tipo_inmueble_desarrollos"></div>

            </section>
        </div>
    </div>
</div>