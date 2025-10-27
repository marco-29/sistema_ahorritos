<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-12">
                                    <img src="<?php echo base_url('almacenamiento/site/recursos/banners/banner-inicio.jpg'); ?>" class="full-width-img card-header" alt="">
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 col-xs-12 px-1">
                                        <!-- <h3>Accesos directos:</h3> -->
                                    </div>
                                    <div class="col-8 col-xs-12 text-right">
                                        <!-- <a class="btn btn-info btn-glow btn-lg" href="<?php //echo site_url('site/procesos_venta'); 
                                                                                            ?>">Iniciar Procesos de venta</a> -->
                                                                                            
                                        <?php echo ($this->session->userdata('user_rol_identificador') != 'c1fce77c') ? '<a class="btn btn-info btn-glow btn-lg" href="'.site_url('site/desarrollos/agregar').'">Agregar Desarrollo</a>' : ''; ?>

                                        <a class="btn btn-info btn-glow btn-lg" href="<?php echo site_url('site/clientes/agregar'); ?>">Agregar Prospecto</a>
                                    </div>
                                </div>
                            </div>

                            <!-- inicia tablero indicadores
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-user-following font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 info float-right" name="total_clientes_prospectos" id="total_clientes_prospectos">0</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Prospectos registrados</span>
                                            </div>
                                        </div>
                                        <div class="clearfix my-1 text-right">
                                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes'); ?>">Ver Prospectos</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-user-following font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 info float-right" name="total_clientes_compradores" id="total_clientes_compradores">0</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Compradores registrados</span>
                                            </div>
                                        </div>
                                        <div class="clearfix my-1 text-right">
                                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/clientes'); ?>">Ver Compradores</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12 border-right-blue-grey border-right-lighten-5">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-direction font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 info float-right" name="total_inmuebles" id="total_inmuebles">0</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Inmuebles en inventario</span>
                                            </div>
                                        </div>
                                        <div class="clearfix my-1 text-right">
                                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/desarrollos'); ?>">Ver Inmuebles</a>
                                        </div>
                                    </div>
                                    termina card tablero indicadores
                                    inicia card tablero indicadores
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="pb-1">
                                            <div class="clearfix mb-1">
                                                <i class="icon-book-open font-large-1 blue-grey float-left mt-1"></i>
                                                <span class="font-large-2 text-bold-300 info float-right" name="total_inmuebles_en_proceso" id="total_inmuebles_en_proceso">0</span>
                                            </div>
                                            <div class="clearfix">
                                                <span class="text-muted">Inmuebles en proceso</span>
                                            </div>
                                        </div>
                                        <div class="clearfix my-1 text-right">
                                            <a class="btn btn-outline-secondary" href="<?php echo site_url('site/procesos_venta'); ?>">Ver Procesos de venta</a>
                                        </div>
                                    </div>
                                    termina card tablero indicadores

                                    termina card tablero indicadores
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>