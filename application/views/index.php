<html>
  <head>
    <script type="text/javascript">
       var Base_url = "<?=base_url()?>index.php/";   
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular.min.js"></script>      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.22/angular-ui-router.min.js"></script>
    <script src="<?php echo base_url('assets/js/app.js');?>"></script>
  </head>

  <body ng-app="App">
    <ui-view></ui-view>
  </body>
</html>