<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>

        <?php 
            wp_enqueue_style('wp-admin');
            wp_enqueue_style('ie');
            wp_enqueue_style('media');
            wp_enqueue_style('media-views');
            wp_enqueue_style('media-frame');
            wp_enqueue_style('mediaelement');
            wp_enqueue_style('wp-mediaelement');
            wp_enqueue_style('buttons');
            wp_print_styles();
        ?>
</head>
  <body ng-app="keymediaApp">
    <!--[if lt IE 9]>
      <script src="bower_components/es5-shim/es5-shim.js"></script>
      <script src="bower_components/json3/lib/json3.min.js"></script>
    <![endif]-->

    <div class="container" ng-view=""></div>

    <script src="/wordpress/wp-content/plugins/keymedia/web/app/bower_components/angular/angular.js"></script>

        <!-- FIXME: Absolute URLs, enqueue scripts using wp queue-->
        <!-- build:js({.tmp,app}) scripts/scripts.js -->
        <script src="/wordpress/wp-content/plugins/keymedia/web/app/scripts/app.js"></script>
        <script src="/wordpress/wp-content/plugins/keymedia/web/app/scripts/controllers/main.js"></script>
        <!-- endbuild -->
</body>
</html>
