<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('styles/main.css', __FILE__); ?>">
        <title><?php echo _('Insert from KeyMedia'); ?></title>
        <?php
        wp_enqueue_style('wp-admin');
        wp_enqueue_style('ie');
        wp_enqueue_style('media');
        wp_enqueue_style('media-views');
        wp_enqueue_style('media-frame');
        wp_enqueue_style('buttons');
        wp_print_styles();
        ?>
    </head>
    <body ng-app="keymediaApp">
        <div class="container" ng-view=""></div>
        <script src="<?php echo plugins_url('bower_components/angularjs-file-upload/angular-file-upload-shim.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('bower_components/angular/angular.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('bower_components/angularjs-file-upload/angular-file-upload.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('scripts/app.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('scripts/controllers/main.js', __FILE__); ?>"></script>
    </body>
</html>
