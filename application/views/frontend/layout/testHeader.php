<!DOCTYPE html>
<html>
<head>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
span.menu-custom-drp.dropdown-toggle {
    float: right;
}
.dropdown, .dropup {
    float: right;
    position: relative;
}
.dropdown-menu {    
    margin: 18px 21px 3px -227px;
    padding: 0px;
}
ul.dropdown-menu.list-custom {
    width: 250px;
    height: auto;        
    background-color: #c7ffec;
}
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
p.title-name {
    font-size: 13px;
    display: block;
    text-align: center;
    padding: 8px;
    font-weight: 600;
    background-color: beige;
}
.list-custom li {
    display: contents;
}
.dropdown-menu.list-custom {
    width: 250px;
    background-color: #e2e4f1;
}
.row.cutom-rw {
    width: 91%;
}
p.unread {
    font-size: 11px;
    padding: 10px;
}
button.btn.btn-default.allready {
    padding: 2px 8px;
    font-size: 12px;
}
img.image-icon {
    width: 35px;
    height: 35px;
    border-radius: 50px;
}

p.first-line {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 0px;
}
p.help-text {
    font-size: 12px;
    margin-bottom: 0;
}
p.buuton-last {
    float: right;
    color: #2cb3ad;
    cursor: pointer;
    font-size: 11px;
    font-weight: 600;
}
.row.cutom-rw2 {
    padding: 7px 0px;
    background-color: #fff;
    margin: 10px;
    cursor: pointer;
}
.row.cutom-rw3 {
    padding: 7px 0px;
    background-color: #fff;
    margin: 0px 10px;
    border: 1px solid #f1f1f1;
}
p.today-seperator {
    font-size: 12px;
    margin: 10px;
}
p.all-notification {
    font-size: 12px;
    display: block;
    text-align: center;
    padding: 15px;
    margin-bottom: 0px;
    cursor: pointer;
    color: #1690a0;
}
</style>
</head>
<body>

<ul>
  <li><a href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </li>
</ul>

<div class="profile-image-section dropdown">
  <span class="menu-custom-drp dropdown-toggle" data-toggle="dropdown">Click Here<img src="{{profile_image}}" class="profile-image"></span>  
    <div class="dropdown-menu list-custom">
      <p class="title-name">Notification</p>      
      <div class="row cutom-rw"> 
        <div class="col-md-6"> 
          <p class="unread">{{dataObject.length > 0 ? dataObject.length : 'No'}} Unread </p>
        </div>
        <div class="col-md-6"> 
          <button type="button" class="btn btn-default allready" ng-click="notifyReaded('','all')">Mark all as read</button>  
        </div>        
      </div>
      <a ng-click="notifyReaded(item.id,'single')">
        <div class="row cutom-rw2" ng-repeat="item in dataObject"> 
          <div class="col-md-2"> 
            <img src="https://picsum.photos/536/354" class="image-icon" alt="Girl in a jacket">
          </div>
          <div class="col-md-10"> 
            <p class="first-line">{{item.description}} </p>
            <p class="help-text">{{item.email}}</p>
            <p class="buuton-last"> <span class="yes-text"><a ng-click="notifyReaded(item.id,'single')">Yes</a> </span> <span class="change-now">Change it now</span></p>
          </div>        
        </div>
      </a>
      <p class="today-seperator">Today</p>
      <div class="row cutom-rw3"> 
        <div class="col-md-2"> 
          <img src="https://picsum.photos/536/354" class="image-icon" alt="Girl in a jacket">
        </div>
        <div class="col-md-10"> 
          <p class="first-line">this is you email</p>
          <p class="help-text">test@gmail.com</p>          
        </div>        
      </div>
      <div class="row cutom-rw3"> 
        <div class="col-md-2"> 
          <img src="https://picsum.photos/536/354" class="image-icon" alt="Girl in a jacket">
        </div>
        <div class="col-md-10"> 
          <p class="first-line">this is you email</p>
          <p class="help-text">test@gmail.com</p>          
        </div>        
      </div>
      <div class="row cutom-rw3"> 
        <div class="col-md-2"> 
          <img src="https://picsum.photos/536/354" class="image-icon" alt="Girl in a jacket">
        </div>
        <div class="col-md-10"> 
          <p class="first-line">this is you email</p>
          <p class="help-text">test@gmail.com</p>          
        </div>        
      </div>
      <p class="all-notification">Show all notification</p>
    </div>  
</div>

</body>
</html>
