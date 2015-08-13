<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <?php
        echo $this->Html->charset();
        echo $this->Html->meta('http-equiv', null, array('http-equiv' => 'X-UA-Compatible', 'content' => 'IE=edge,chrome=1'));
        ?>
        <title><?php echo $title_for_layout; ?></title>
        
        <?php
		echo $this->Html->meta('icon');
		echo $this->Html->meta('description', null, array('name' => 'description', 'content' => ''));
		echo $this->Html->meta('viewport', null, array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
		
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-theme.min');
        echo $this->Html->css('main');
        
        echo $this->Html->script('vendor/modernizr-2.6.2-respond-1.1.0.min');
        
        echo $this->fetch('meta');
		echo $this->fetch('css');
        ?>
        
    </head>
    <body>
        <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
        <!-- Top Navigation -->
        <?php echo $this->element('topnav'); ?>
        
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <?php //echo $this->element('jumbotron'); ?>
        
        <br /><br />
        
        <div class="container">
            
            <?php echo $this->Session->flash(); ?>
            
            <?php echo $this->fetch('content'); ?>
            
            <!-- Example row of columns -->
            <?php //echo $this->fetch('cols'); ?>
            
            <hr>
            
            <?php echo $this->element('footer'); ?>
        </div> <!-- /container -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
        
        <?php
        echo $this->Html->script('vendor/bootstrap.min');
        echo $this->Html->script('main');
        echo $this->fetch('script');
        
        echo $this->element('ga');
        ?>
    </body>
</html>
