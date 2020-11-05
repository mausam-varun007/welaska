<!DOCTYPE html>
<html>
<head>
  <!-- <script>
      if (location.href.indexOf("#!") > -1) 
        location.assign(location.href.replace(/\/?#!/, ""));      
  </script> -->
  <title>Welaska</title>
  <!-- <base href="<?php echo base_url('/') ?>" > -->
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" > -->
  <link data-require="bootstrap-css@*" data-semver="3.3.1" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://gitcdn.xyz/cdn/angular/bower-material/v1.1.26/angular-material.css">
  <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-toastr/1.7.0/angular-toastr.css">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/lightGallery.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/customeStyle.css'); ?>">
  <style type="text/css">
    .loading-spiners{
    background-color: white;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position: fixed;
    z-index: 999;
    overflow: hidden;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}
.loading-spiners .loading-section{
    position: absolute;
    top: 50%;
    width: 100%;
    padding: 0px 25px 0px;
    left: 50%;
    transform: translate(-50%, -50%);
}
.loading-spiner-hide{
    display: none;
}
.loading-spiner-show{
    display: block;
}
.loading-spiners img {
    position: absolute;
    left: 44%;
    top: 20%;
}

  </style>
  <script type="text/javascript">
     var Base_url = "<?=base_url()?>index.php/";   
     var Base_Url = "<?=base_url()?>";   
  </script>    
    <!-- Angular Material requires Angular.js Libraries -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular-messages.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.12/angular-material.min.js"></script> -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular-animate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.0/angular-sanitize.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular-route.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular-messages.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/md5.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/svg-assets-cache.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-toastr/1.7.0/angular-toastr.tpls.js"></script>

    <script src="https://gitcdn.xyz/cdn/angular/bower-material/v1.1.26/angular-material.js"></script>
    


    <!-- Angular Material Library -->

    <!-- <script src="<?php echo base_url('assets/js/lazy-scroll.js'); ?>"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.22/angular-ui-router.min.js"></script>
    <script src="<?=base_url()?>assets/js/lightGallery.js"></script>
    <script data-require="ui-bootstrap@*" data-semver="0.13.0" src="https://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.13.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/social-sharing.directive.js');?>" ></script> 
    <script type="text/javascript" src="<?php echo base_url('assets/js/google-map.directive.js');?>" ></script> 
    
  <script src="<?php echo base_url('assets/js/app.js');?>"></script>

</head>
<body ng-app="App">
  <div class="container">
    <div class="row">      
      <ui-view></ui-view>      
    </div>
  </div>
</div>
  <div id="loader-for-page"  class="loading-spiners"><img src="<?=base_url()?>assets/img/loading_bouncing.gif" /> </div>     
</body>
</html>
