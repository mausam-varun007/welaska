<div class="row footer">
    	<div class="col-md-12" style="padding-left: 0px;padding-right: 0px;"> 
    		<div class="box-footer">
    		<p class="footer-text">Welcome to Welaska, the step where you are getting information about nearby services. From here its our proudable responsibility to fulfil your requirement by giving informations, quotes and useful calls to you. Our service extends from providing address and contact details of business establishments around the country, to making orders and reservations for leisure, medical, financial, travel and domestic purposes. We enlist business information across varied sectors like Hotels, Restaurants, Auto Care, Home Decor, Personal and Pet Care, Fitness, Insurance, Real Estate, Sports, Schools, etc. from all over the country. Holding information right from major cities like Indore, Delhi, Bangalore, Jabalpur, Pune, Ahmedabad, and Chennai our reach stretches out to other smaller cities across the country too. We create a space for you to share your experiences through our 'Rate & Review' feature.</p>

			<p class="footer-text"> Online shopping / Security service / Sport coach / Sport goods / Wine shops / Wedding hall / Travel organizer / Transport / Training institute / Automobile / Restaurants / Language and class / Loan and Credit card / Modular kitchen / Movie theatre / On demand service / Packers and movers / Personal care / Pet care / Play school / Real estate / Fitness yoga / Foren exchange / Home decor / Hospital  / Hotels / House keeping and service / Industrial service / Insurance and advisors / Internet / Job consultancy / Jewellery shops / Doctors / Resorts/Cake Delivery Services/Skoda Car Dealers/Volkswagen Car Dealers/Orthopaedic Surgeons/Paying Guest Accommodations/Yoga Classes/Lounge Bars/Endocrinologists/Fashion Designers/Boutiques/Photographers/Urologist/Bike on rent/GRE Tutorials/GMAT tutorials/Criminal lawyers/Hotels/Ford Car Dealers/Broadband Internet Service Providers/Indian Restaurants/North Indian Restaurants/Punjabi Restaurants/Acting Classes/Tandoori Restaurants/General Physician/Interior Designers/Bajaj Motorcycle Dealers/Nissan Car Dealers/Cosmetic Surgeon/Broadband Service/Buffet Restaurants/Italian Restaurants/Restaurants/Car Repair & Service/Chinese Restaurants/Dermatologists/Car Hire/Audi Car Dealers/Packers and Movers/Yamaha Motorcycle Dealers/Hotel Management/Bridal Wear Retailers/Tiffin Services/Second Hand Car Dealers/Wedding Hall/Gynaecologist/Chevrolet Car Dealers/Banquet Halls/Hair Stylists/Home Loans/SAP Training Institutes/Dentists/ENT Doctors/AC Repair & Services/Caterers/Courier Services/Event Management Companies/Electricians/Plumbers</p>

			<p class="footer-text"> Bangalore / Indore / Delhi / Pune / Ahmedabad / Chennai / Jabalpur </p>

			<p class="footer-text">Some more services like online appointment in hospitals, restaurants,  showrooms, saloons, shops and hospitals near me, petrol pump near me, gas station near me, grocery store near me, saloon near me, ATM near me, etc. is going to be started on welaska.
			With the vision ‘Well ask me anything’.</p>
			
    		</div>
    	</div>
    	
	  
	</div>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title">{{modalType}}</h4>
	      <h4 class="modal-title">Welaska</h4>
	    </div>
	    <div class="modal-body">	      	
	    	<div class="mobile-section" ng-show="!isVerificationActives">	    		
		      	<div class="form-group">		      
			      <input type="text" class="form-control custom-input" id="name" placeholder="Name" name="name" ng-model="listingObj.user_name">
			    </div>
			    <div class="form-group">		      
			      <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? false : (event.charCode >= 48 && event.charCode <= 57) || (event.charCode==46 || event.charCode==46)" class="form-control custom-input" id="mobile" placeholder="Mobile Number" ng-model="listingObj.mobile" name="mobile">
			    </div>
	    	</div>	    	
	    	<div class="verification-section" ng-show="isVerificationActives">	    		
	    		<p>Please enter your mobile verification code</p>
		      	<div class="form-group">		      
			      <input type="number" class="form-control custom-input" onKeyPress="if(this.value.length==6) return false;" id="verification_code" placeholder="Verification Code" ng-model="listingObj.verification_code" name="verification_code">
			    </div>			    
	    	</div>
	    </div>
	    <div class="modal-footer">
		    <div>
		    	<button class="btn btn-default otp-button" login-signup ng-click="SignupLogin()">{{!isVerificationActives ? 'Send OTP' : 'Verify'}}</button>
		    </div>	      
	    </div>
	  </div>
	  
	</div>
</div>