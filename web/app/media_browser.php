<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <?php 
            wp_enqueue_script('keymedia-angular', plugins_url('bower_components/angular/angular.js', __FILE__));
            wp_enqueue_script('keymedia-app', plugins_url('scripts/app.js', __FILE__));
            wp_enqueue_script('keymedia-main-ctrl', plugins_url('scripts/controllers/main.js', __FILE__));
            wp_print_scripts();
        ?>
</body>
</html>
