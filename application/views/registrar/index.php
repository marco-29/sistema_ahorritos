<!DOCTYPE html>
<html class="loading" lang="es_MX" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <meta name="title" content="<?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?>">
    <meta name="description" content="<?php echo descripcion(); ?>">
    <meta name="keywords" content="<?php echo palabras_clave(); ?>">
    <meta name="author" content="<?php echo autor(); ?>">
    <meta name="language" content="es_MX">

    <meta property="og:image" content="<?php echo base_url('almacenamiento/recursos/logos/avatar-s-1.png'); ?>">
    <meta property="og:title" content="<?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?>">
    <meta property="og:description" content="<?php echo descripcion(); ?>">
    <meta property="article:author" content="<?php echo autor(); ?>">
    <meta property="og:locale" content="es_MX">
    <meta property="og:type" content="website">

    <title><?php echo isset($pagina_titulo) ? $pagina_titulo . " | " : ""; ?><?php echo titulo() ? titulo() : ""; ?></title>

    <link rel="apple-touch-icon" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('almacenamiento/recursos/logos/favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('almacenamiento/recursos/logos/favicon/favicon.ico'); ?>">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/vendors.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/vendors/css/forms/icheck/icheck.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/vendors/css/forms/icheck/custom.css'); ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/app.css'); ?>">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css"'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/core/colors/palette-gradient.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/pages/login-register.css'); ?>">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css'); ?>">
    <!-- END Custom CSS-->

    <?php if (isset($styles) && is_array($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" type="text/css" href="<?php echo !$style['es_rel'] ? $style['href'] : base_url() . 'assets/css/' . $style['href']; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<!-- ////////////////////////////////////////////////////////////////////////////-->

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column bg-full-screen-image menu-expanded blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">

    <div class="app-content container center-layout mt-2">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">

                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img class="img-fluid" src="<?php echo base_url('almacenamiento/recursos/logos/logo-horizontal.png'); ?>" width="50%" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Registrate</span>
                                    </h6>
                                </div>

                                <div class="card-content">

                                    <div class="card-body">
                                        <?php echo form_open(uri_string(), array('class' => 'form-horizontal needs-validation', 'id' => 'form', 'novalidate' => '', 'method' => 'post')); ?>

                                        <?php $this->load->view('_templates/mensajes_alerta.tpl.php'); ?>

                                        <?php if (validation_errors()) : ?>
                                            <div class="alert bg-danger alert-icon-left alert-dismissible mb-2 font-small-3" role="alert">
                                                <span class="alert-icon"><i class="fa fa-thumbs-o-down"></i></span>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo validation_errors(); ?>
                                            </div>
                                        <?php endif ?>

                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Correo electrónico o teléfono" value="<?php echo set_value('usuario') == false ? $this->session->flashdata('usuario') : set_value('usuario'); ?>" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toLowerCase()" required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>

                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" name="contrasenha" id="contrasenha" placeholder="Contraseña" value="" required>
                                            <div class="form-control-position">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </fieldset>

                                        <div class="form-group row">
                                            <div class="col-md-4 col-12 text-center text-sm-left">
                                            </div>
                                            <div class="col-md-8 col-12 float-sm-left text-center text-sm-right">
                                                <!--a href="<?php //echo site_url('login'); 
                                                            ?>" class="card-link">
                                                    ¿Olvidaste tu contraseña?
                                                </a-->
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-outline-success btn-block"><i class="ft-unlock"></i> Iniciar sesion</button>
                                        <a href="<?php echo site_url('registrar'); ?>" class="btn btn-outline-primary btn-block"><i class="ft-user"></i> Registrarse</a>

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

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="<?php echo base_url('app-assets/vendors/js/vendors.min.js'); ?>" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="<?php echo base_url('app-assets/vendors/js/ui/jquery.sticky.js'); ?>"></script>
    <script src="<?php echo base_url('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript'); ?>"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="<?php echo base_url('app-assets/js/core/app-menu.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('app-assets/js/core/app.js'); ?>" type="text/javascript"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?php echo base_url('app-assets/js/scripts/forms/form-login-register.js'); ?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

    <?php if (isset($scripts) && is_array($scripts)) : ?>
        <?php foreach ($scripts as $script) : ?>
            <script type="text/javascript" src="<?php echo !$script['es_rel'] ? $script['src'] : base_url() . 'assets/js/' . $script['src']; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>