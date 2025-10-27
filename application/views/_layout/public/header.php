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

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/vendors.css'); ?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/app.css'); ?>">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('app-assets/css/core/colors/palette-gradient.css'); ?>">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/web.css'); ?>">
    <!-- END Custom CSS-->

    <?php if (isset($styles) && is_array($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" type="text/css" href="<?php echo !$style['es_rel'] ? $style['href'] : base_url() . 'assets/css/' . $style['href']; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body class="horizontal-layout horizontal-menu horizontal-menu-padding 1-column menu-expanded bg-white" data-open="hover" data-menu="horizontal-menu" data-col="1-column">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-static-top">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"></li>
                    <li class="nav-item">
                        <a class="navbar-brand" href="<?php echo site_url(); ?>">
                            <img class="brand-logo" alt="robust admin logo" src="<?php echo base_url('almacenamiento/recursos/logos/icono.png'); ?>">
                            <h3 class="brand-text"><?php echo nombre_comercial(); ?></h3>
                        </a>
                    </li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="ft-menu font-large-1"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container">
                <div class="collapse navbar-collapse justify-content-end" id="navbar-mobile">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link nav-link-label black" href="<?php echo site_url(); ?>">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link mr-2 nav-link-label black" href="<?php echo site_url('login'); ?>">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->