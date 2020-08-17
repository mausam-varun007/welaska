<!DOCTYPE html>
<html>
<head>
  <title>Welaska</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style2.css'); ?>">
  <script type="text/javascript">
     var Base_url = "<?=base_url()?>index.php/";   
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.6/angular.min.js"></script>      
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.22/angular-ui-router.min.js"></script>
  <script src="<?php echo base_url('assets/js/app.js');?>"></script>
</head>
<body ng-app="App">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 header">
        <div class="header">
            <a href="#default" class="logo" >WELASKA</a>
            <div class="header-right">
                <!-- <a class="active" href="#home">Blog</a>
                <a href="#contact">Add Your Business</a> -->
            </div>
        </div>
      </div>
      <ui-view></ui-view>
      <div class="footer">
        <div class="col-md-12 footer"  > 
          <div class="box-footer">
          <p class="footer-p">Welcome to Welaska, the step where you are getting information about nearby services. From here its our proudable responsibility to fulfil your requirement by giving informations, quotes and useful calls to you. Our service extends from providing address and contact details of business establishments around the country, to making orders and reservations for leisure, medical, financial, travel and domestic purposes. We enlist business information across varied sectors like Hotels, Restaurants, Auto Care, Home Decor, Personal and Pet Care, Fitness, Insurance, Real Estate, Sports, Schools, etc. from all over the country. Holding information right from major cities like Indore, Delhi, Bangalore, Jabalpur, Pune, Ahmedabad, and Chennai our reach stretches out to other smaller cities across the country too. We create a space for you to share your experiences through our 'Rate & Review' feature.<br><br>

        Online shopping / Security service / Sport coach / Sport goods / Wine shops / Wedding hall / Travel organizer / Transport / Training institute / Automobile / Restaurants / Language and class / Loan and Credit card / Modular kitchen / Movie theatre / On demand service / Packers and movers / Personal care / Pet care / Play school / Real estate / Fitness yoga / Foren exchange / Home decor / Hospital  / Hotels / House keeping and service / Industrial service / Insurance and advisors / Internet / Job consultancy / Jewellery shops / Doctors / Resorts/Cake Delivery Services/Skoda Car Dealers/Volkswagen Car Dealers/Orthopaedic Surgeons/Paying Guest Accommodations/Yoga Classes/Lounge Bars/Endocrinologists/Fashion Designers/Boutiques/Photographers/Urologist/Bike on rent/GRE Tutorials/GMAT tutorials/Criminal lawyers/Hotels/Ford Car Dealers/Broadband Internet Service Providers/Indian Restaurants/North Indian Restaurants/Punjabi Restaurants/Acting Classes/Tandoori Restaurants/General Physician/Interior Designers/Bajaj Motorcycle Dealers/Nissan Car Dealers/Cosmetic Surgeon/Broadband Service/Buffet Restaurants/Italian Restaurants/Restaurants/Car Repair & Service/Chinese Restaurants/Dermatologists/Car Hire/Audi Car Dealers/Packers and Movers/Yamaha Motorcycle Dealers/Hotel Management/Bridal Wear Retailers/Tiffin Services/Second Hand Car Dealers/Wedding Hall/Gynaecologist/Chevrolet Car Dealers/Banquet Halls/Hair Stylists/Home Loans/SAP Training Institutes/Dentists/ENT Doctors/AC Repair & Services/Caterers/Courier Services/Event Management Companies/Electricians/Plumbers<br><br>

        Bangalore / Indore / Delhi / Pune / Ahmedabad / Chennai / Jabalpur<br><br>

        Some more services like online appointment in hospitals, restaurants,  showrooms, saloons, shops and hospitals near me, petrol pump near me, gas station near me, grocery store near me, saloon near me, ATM near me, etc. is going to be started on welaska.
        With the vision ‘Well ask me anything’.</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
