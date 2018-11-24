<?php
 include("includes/header.php");
 
 
 //echo ($_SESSION['frnt_usname']);
 //include('model/cart.class.php');
$cartobj= new cartClass();
 
 
 if($_POST['submit']=="Login")
{
	//echo "login"; exit;
	
	//print_r($_POST);exit;
	
 $bannerObj->loginchecking($_POST);
}
//print_r($_SESSION['address']);exit;
 
 $getuserdata=$bannerObj->getuserdata($_SESSION['frnt_mid']);
	//print_r($getuserdata);
	if($_SESSION['frnt_mid']!='')
	{	
	
	   	$uquery="select * from tb_users_info where user_id='".$_SESSION['frnt_mid']."'";	  
		$ugetdat=$callConfig->getRow($uquery);
		
	  $uquery="select * from tb_state where id='".$ugetdat->state."'";	  
		$statedat=$callConfig->getRow($uquery);
	
		$uquery="select * from tb_city where id='".$ugetdat->city."'";	  
		$citydat=$callConfig->getRow($uquery); 
		
		$uquery="select * from tb_countries where id='".$ugetdat->country."'";	  
		$countrydat=$callConfig->getRow($uquery);
		
		$bquery="select * from tb_user_billingaddress where user_id='".$_SESSION['frnt_mid']."'";
		$userbilldata=$callConfig->getRow($bquery);	
	}
	else
	{
		$guestbill="select * from tb_guestubillingaddress order by id DESC LIMIT 0,1";
		$ugetdat=$callConfig->getRow($guestbill);
		//print_r($ugetdat);
	}
	
	//$cartproducts=cartClass::getindcart();
	 $_SESSION['CART_TEMP_RANDOM'];
	$cartproducts=$cartobj->getindcart();
	//print_r($cartproducts); 
	$discountchance=cartClass::couponEntryChance();

 if(isset($_POST['paypal_paying']))
{
//echo "hai"; exit;
	$cartobj->insertenquirytest($_POST);
}
 
?>
<style>
.checkleft_btn input[type="date"] {
border: 1px solid #b0b0b0;
padding: 8px;
width: 95%;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
margin-top: 5px;
}


</style>
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
   <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>-->
    <script src="http://www.codecomplete4u.com/wp-content/MyPlugins/jquery.ui.core.js" type="text/javascript"></script>
    <script src="http://www.codecomplete4u.com/wp-content/MyPlugins/jquery.ui.widget.js" type="text/javascript"></script>
    <script src="http://www.codecomplete4u.com/wp-content/MyPlugins/jquery.ui.datepicker.js" type="text/javascript"></script>
    <script type="text/javascript">

$(document).ready(function(){
	
		$("#flip0").click(function(){
			//alert("d");
	$("#div0").slideToggle("slow");
	$(".clekedform").not("#div0").slideUp('slow');
	});
	
	
	
	<?php if($_SESSION['frnt_mid']=="") {    ?>
	$('#submit_button').click(function() {
		//alert("dd");
		if($('#checktype2').is(':checked')){
			
			<?php $_SESSION['checkout']="checkout";?>
		window.location.href = 'register.php';
		
		//window.location.href = '<?php echo SITEURL; ?>/register';
		
		}
		else if($('#checktype1').is(':checked')){
		
		var bdate = $("#b_date").val();
	
			var d = new Date();
			var month = d.getMonth()+1;
			var day = d.getDate();
	
		var output = d.getFullYear() + '-' +
			((''+month).length<2 ? '0' : '') + month + '-' +
			((''+day).length<2 ? '0' : '') + day;


		   days = days_between(output, bdate);
		   compareDate();
        /*var dayDiff = Math.ceil((output - bdate) / (1000 * 60 * 60 * 24));*/
		
		
		function days_between(output, bdate)
		 {

            // The number of milliseconds in one day
            var ONE_DAY = 1000 * 60 * 60 * 24;
            date1 = new Date(output);
            date2 = new Date(bdate);
            // Convert both dates to milliseconds
            var date1_ms = date1.getTime();
            var date2_ms = date2.getTime();
            // Calculate the difference in milliseconds
            var difference_ms = Math.abs(date1_ms - date2_ms);
            // Convert back to days and return
            return Math.round(difference_ms / ONE_DAY);

          }
        function compareDate() {
            var str2 = output;
            var str4 = bdate;
            var ONE_DAY = 1000 * 60 * 60 * 24;
            var dt2 = parseInt(str2.substring(0, 2), 10);
            var mon2 = parseInt(str2.substring(3, 5), 10);
            var yr2 = parseInt(str2.substring(6, 10), 10);
            var dt4 = parseInt(str4.substring(0, 2), 10);
            var mon4 = parseInt(str4.substring(3, 5), 10);
            var yr4 = parseInt(str4.substring(6, 10), 10);
            var date2 = new Date(yr2, mon2 - 1, dt2);
            var date4 = new Date(yr4, mon4 - 1, dt4);
            var date2_ms = date2.getTime();
            var date4_ms = date4.getTime();
            var difference_ms = Math.abs(date2_ms - date4_ms)
            var y = Math.round(difference_ms / ONE_DAY)
          

        }
		//alert(days);
		 var age = days;
		//alert(age);
         if( age >= 6570 )
		 {
		    $("#div0").slideUp('slow');
			$("#div1").slideDown('slow');
            //document.write("<b>Qualifies for driving</b>");
		 }
        else
		{
            alert("You must be 18 years or older to purchase from this website"); exit;
           // document.write("<b>Does not qualify for driving</b>");
        }
		
		
			
			
		}
		
		
		
		else{
			document.getElementById("errordiv").innerHTML="Please Checkout as Guest or Register *";
			return false;
		}
	});
	
	$('#login_button').click(function() {
		
	
	if($("#email").val()==""){$("#valemail").html("*Please enter Email!"); $("#email").focus(); return false;}else{if(IsEmail1($("#email").val())==false){$("#valemail").html("*Enter valid email!"); $("#email").focus(); return false; }else{$("#valemail").html("");}}
	if($("#password").val()==""){$("#valpassword").html("*Please enter Password!"); $("#password").focus(); return false;}else{$("#valpassword").html("");}
	
if($("#password").val()!="" && $("#email").val()!="" )	{

//alert("sf");
<?php
 $_SESSION['login']="login";?>
 document.loginform.submit();	
}
	});
	
	<?php } else { ?>
	$("#div0").remove();
	$("#div1").slideDown('slow');
	
	

	<?php }?>
	
	
	
		
	function IsEmail1(email) {
	//alert(email);
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
   	return false;
	}else{
   		return true;
	}
}
	});
	</script>
    
    
   <script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
    webshims.setOptions('forms-ext', {types: 'date'});
webshims.polyfill('forms forms-ext');
</script>
    
 
<script type="text/javascript">
function checkaddrs(val){
 var element=document.getElementById('color');
 if(val=='pick a color'||val=='others')
   element.style.display='block';
 else  
   element.style.display='none';
}
function ubadd(s){
		$("#newsbill").slideUp();
		$("#address option:first").attr('selected','selected');
}

$(document).ready(function(e) {


$("#fname").keyup(function(){if($("#fname").val()==""){$("#valfname").html("*Please enter First name!"); $("#fname").focus(); return false;}else{$("#valfname").html("");}});
$("#lname").keyup(function(){if($("#lname").val()==""){$("#vallname").html("*Please enter Last name!"); $("#lname").focus(); return false;}else{$("#vallname").html("");}});
$("#bemail").keyup(function(){if($("#bemail").val()==""){$("#valbemail").html("*Please enter Email!"); $("#bemail").focus(); return false;}else{if(IsEmail($("#bemail").val())==false){$("#valbemail").html("*Enter valid email!"); $("#bemail").focus(); return false; }else{$("#valbemail").html("");}}});
$("#addr1").keyup(function(){if($("#addr1").val()==""){$("#valaddr1").html("*Please enter address!"); $("#addr1").focus(); return false;}else{$("#valaddr1").html("");}});
$("#city").keyup(function(){if($("#city").val()==""){$("#valcity").html("*Please enter city!"); $("#city").focus(); return false;}else{$("#valcity").html("");}});


$("#country").change(function(){if($("#country").val()==""){$("#valcountry").html("*Please enter country!"); $("#country").focus(); return false;}else{$("#valcountry").html("");}});

$("#zip").keyup(function(){if($("#zip").val()==""){$("#valzip").html("*Please enter zip!"); $("#zip").focus(); return false;}else{if($.isNumeric($("#zip").val())==false){ $("#valzip").html("Enter valid zip code"); return false; }else{ $("#valzip").html("");}}});	

$("#date").keyup(function(){if($("#date").val()==""){$("#date").html("*Please enter Date!"); $("#date").focus(); return false;}else{$("#valdate").html("");}});

$("#state").keyup(function(){if($("#state").val()==""){$("#valstate").html("*Please enter state!"); $("#state").focus(); return false;}	else{$("#valstate").html("");}});
$("#telephone").keyup(function(){if($("#telephone").val()==""){$("#valtelephone").html("*Please enter telephone!"); $("#telephone").focus(); return false;}else{if($.isNumeric($("#telephone").val())==false){ $("#valtelephone").html("Enter valid number"); return false; }else{ $("#valtelephone").html("");}}});

$("#sfname").keyup(function(){if($("#sfname").val()==""){$("#svalfname").html("*Please enter First name!"); $("#sfname").focus(); return false;}else{$("#svalfname").html("");}});
$("#slname").keyup(function(){if($("#slname").val()==""){$("#svallname").html("*Please enter Last name!"); $("#slname").focus(); return false;}else{$("#svallname").html("");}});
$("#semail").keyup(function(){if($("#semail").val()==""){$("#svalbemail").html("*Please enter Email!"); $("#semail").focus(); return false;}else{if(IsEmail($("#semail").val())==false){$("#svalbemail").html("*Enter valid email!"); $("#semail").focus(); return false; }else{$("#svalbemail").html("");}}});
$("#saddr1").keyup(function(){if($("#saddr1").val()==""){$("#svaladdr1").html("*Please enter address!"); $("#saddr1").focus(); return false;}else{$("#svaladdr1").html("");}});
$("#scity").keyup(function(){if($("#scity").val()==""){$("#svalcity").html("*Please enter city!"); $("#scity").focus(); return false;}else{$("#svalcity").html("");}});
$("#scountry").change(function(){if($("#scountry").val()==""){$("#svalcountry").html("*Please enter country!"); $("#scountry").focus(); return false;}else{$("#svalcountry").html("");}});
$("#szip").keyup(function(){if($("#szip").val()==""){$("#svalzip").html("*Please enter zip!"); $("#szip").focus(); return false;}else{if($.isNumeric($("#szip").val())==false){ $("#svalzip").html("Enter valid zip code"); return false; }else{ $("#svalzip").html("");}}});

$("#sdate").keyup(function(){if($("#sdate").val()==""){$("#sdate").html("*Please enter Date!"); $("#sdate").focus(); return false;}else{$("#svaldate").html("");}});

$("#sstate").keyup(function(){if($("#sstate").val()==""){$("#svalstate").html("*Please enter state!"); $("#sstate").focus(); return false;}	else{$("#svalstate").html("");}});
$("#stelephone").keyup(function(){if($("#stelephone").val()==""){$("#svaltelephone").html("*Please enter telephone!"); $("#stelephone").focus(); return false;}else{ if($.isNumeric($("#stelephone").val())==false){ $("#svaltelephone").html("Enter valid number"); return false; }else{ $("#svaltelephone").html("");}}});


function IsEmail(email) {
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
   	return false;
	}else{
   		return true;
	}
}
	
var a=true
	,b=c=d=e=false
	,bck	="#9AC542"			//background color of headings
    ,text	="#FFF"		//text color of headings
	,stime	=300			//time out for sliding
	,btime	=1000			//time out for button
	,backimg="url(images/processing.gif) no-repeat"		//button background
	,bwid	="105px"		//button width
	,bhit	="23px"		//button height
	,bordr	="0px"		//button border
	,btitle	="Continue"	//button title
	,abwid	=""			//after clicking width
	,abhit	= ""			//after clicking height
	,abordr	= ""		//after clicking border
	,abacolr= "#9AC542"	//after clicking background color
	,atitle	= "Continue"//title after clicking
	,atcol	= "#FFF"		//text color after clicking
	,tax	=0
	,ajaxurl = "updateaddress.php"
 ,ajaxsurl = "updatesaddress.php"
,ajaxvalues = '?first_name=<?php echo stripslashes($ugetdat->firstname); ?>&&last_name=<?php echo stripslashes($ugetdat->lastname); ?>&&address=<?php echo stripslashes(preg_replace("/\s+/","",$ugetdat->address)); ?>&&city=<?php echo stripslashes($citydat->city_name); ?>&&state=<?php echo stripslashes($statedat->state_name); ?>&&zip_code=<?php echo stripslashes($ugetdat->zipcode); ?>&&cmpny=<?php echo stripslashes($ugetdat->cmpny); ?>&&telephone=<?php echo stripslashes($ugetdat->telephone); ?>&&fax=<?php echo stripslashes($ugetdat->fax); ?>&&country=<?php echo stripslashes($ugetdat->country); ?>';
 var billaddelmts = '<ul class="billlis"><li><?php echo ucfirst(stripslashes($ugetdat->firstname))."&emsp;".ucfirst(stripslashes($ugetdat->lastname))."</li><li>".ucfirst(stripslashes(preg_replace("/\s+/","",$ugetdat->address)))."</li><li>".ucfirst(stripslashes($citydat->city_name))."</li><li>".ucfirst(stripslashes($statedat->state_name))."&emsp;".ucfirst(stripslashes($ugetdat->zipcode))."</li><li>".ucfirst(stripslashes($ugetdat->fax))."</li><li>".ucfirst(stripslashes($ugetdat->companyname))."</li><li>".ucfirst(stripslashes($ugetdat->telephone))."</li><li>".ucfirst(stripslashes($ugetdat->country))."</li></ul>";?>';
$(".valchk").css({color:"#FF0000"});
$("#bilinfo").css({height:"42px"});
	
$("#but1").click(function(){
	
	//print_r($post);
	
	//alert($("#billaddress").val());
	if($("#billaddress").val()=="old")
	{
	alert('hai');
		var elmt = billaddelmts;
		$("#sdiv1").html(elmt);
		$.ajax({url:ajaxurl+ajaxvalues,success:function(result){ ;
		 }});
	}
	else
	{	
		
		if($("#fname").val()==""){$("#valfname").html("*Please enter First name!"); $("#fname").focus(); return false;}else{$("#valfname").html("");}
		if($("#lname").val()==""){$("#vallname").html("*Please enter Last name!"); $("#lname").focus(); return false;}else{$("#vallname").html("");}
		if($("#bemail").val()==""){$("#valbemail").html("*Please enter Email!"); $("#bemail").focus(); return false;}else{if(IsEmail($("#bemail").val())==false){$("#valbemail").html("*Enter valid email!"); $("#bemail").focus(); return false; }else{$("#valbemail").html("");}}
		
		if($("#city").val()==""){$("#valcity").html("*Please enter city!"); $("#city").focus(); return false;}else{$("#valcity").html("");}
		
		
		if($("#country").val()==""){$("#valcountry").html("*Please enter country!"); $("#country").focus(); return false;}else{$("#valcountry").html("");}
		if($("#zip").val()==""){$("#valzip").html("*Please enter zip!"); $("#zip").focus(); return false;}else{
			if($.isNumeric($("#zip").val())==false){ $("#valzip").html("Enter valid zip code"); return false; }else{ $("#valzip").html("");}}
			
			if($("#date").val()==""){$("#valdate").html("*Please enter date!"); $("#date").focus(); return false;}else{$("#valdate").html("");}
		if($("#state").val()==""){$("#valstate").html("*Please enter state!"); $("#state").focus(); return false;}else{$("#valstate").html("");}				
		if($("#telephone").val()==""){$("#valtelephone").html("*Please enter telephone!"); $("#telephone").focus(); return false;}else{if($.isNumeric($("#telephone").val())==false){ $("#valtelephone").html("Enter valid number"); return false; }else{ $("#valtelephone").html("");}}
		
		
		
		if($("#addr1").val()==""){$("#valaddr1").html("*Please enter address!"); $("#addr1").focus(); return false;}else{$("#valaddr1").html("");}
		
/* function validateAge ()($then, $min){$then = strtotime($then);$min = strtotime('+18 years', $then);echo $min; if(time() < $min)  { die('Not 18'); 
    }
}*/
	
		
		var elmt = '<ul class="billlis"><li>'+$("#fname").val()+'&emsp;'+$("#lname").val()+'</li><li>'+$("#bemail").val()+'</li><li>'+$("#addr1").val()+'</li><li>'+$("#city").val()+'</li><li>'+$("#state").val()+','+$("#zip").val()+'</li><li>'+$("#country").val()+'</li><li>'+$("#date").val()+'</li></ul>';
		//alert(elmt);
		$("#sdiv1").html(elmt);		
		$("#customer_first_name").val($("#fname").val());
		$("#customer_address1").val($("#addr1").val());
		$("#customer_last_name").val($("#lname").val());
		$("#customer_city").val($("#city").val());
		$("#customer_zip").val($("#zip").val());
		$("#customer_date").val($("#date").val());
		//alert(hi);
		$.ajax({url:"updateaddress.php?first_name="+$("#fname").val()+"&&last_name="+$("#lname").val()+"&&email="+$("#bemail").val()+"&&address="+$("#addr1").val()+"&&city="+$("#city").val()+"&&state="+$("#state").val()+"&&zip_code="+$("#zip").val()+"&&fax="+$("#fax").val()+"&&companyname="+$("#cmpny").val()+"&&telephone="+$("#telephone").val()+"&&country="+$("#country").val()+"&&date="+$("#date").val(),success:function(result){ ; 
		}});
	}
	if($("#shipto").prop('checked'))
	{	
	
		//$.ajax({url:"test.php",success:function(result){ /* Retrieve data from biiling table */ }});
		window.setTimeout(function(){$("#bilinfo").css({background:bck,color:text});$("#shipinfo").css({background:bck,color:text});$("#shipmeth").css({background:bck,color:text});$("#div3").slideDown();$("#sdiv1").slideDown();$("#sdiv2").slideDown();$("#div1").slideUp(); b=true;c=true; },stime);
		//alert($('#checktype1').is(':checked'));
		if($("#billaddress").val()=="new" || $('#checktype1').is(':checked'))
		{
			var elmt = '<ul class="billlis"><li>'+$("#fname").val()+'&emsp;'+$("#lname").val()+'</li><li>'+$("#bemail").val()+'</li><li>'+$("#addr1").val()+'</li><li>'+$("#city").val()+'</li><li>'+$("#state").val()+','+$("#zip").val()+'</li><li>'+$("#country").val()+'</li><li>'+$("#date").val()+'</li></ul>';
			//alert(elmt);
			$("#sdiv2").html(elmt);	
			$.ajax({url:"updatesaddress.php?first_name="+$("#fname").val()+"&&last_name="+$("#lname").val()+"&&email="+$("#bemail").val()+"&&address="+$("#addr1").val()+"&&city="+$("#city").val()+"&&telephone="+$("#telephone").val()+"&&state="+$("#state").val()+"&&zip_code="+$("#zip").val()+"&&fax="+$("#fax").val()+"&&companyname="+$("#companyname").val()+"&&country="+$("#country").val()+"&&date="+$("#date").val(),success:function(result){ //alert(result);
			 }});
			 
			 $("#sfname").val($("#fname").val());
			 $("#slname").val($("#lname").val());
			 $("#semail").val($("#bemail").val());
			 $("#saddr1").val($("#addr1").val());
			 $("#scity").val($("#city").val());
			 $("#sstate").val($("#state").val());
			 $("#szip").val($("#zip").val());
			 
			 $("#scmpny").val($("#cmpny").val());
			 $("#scountry").val($("#country").val());
			 $("#stelephone").val($("#telephone").val());
			 $("#sfax").val($("#fax").val());
			 			/* $("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
			 $.ajax({
				   //alert("hi");
				 url:"get_ship_rates.php?dest_zip="+$("#zip").val(),success:function(result){ 
		$("#ship_rates").html(result); 
		}});*/
		
		}
		else if($("#address").val()=="old")
		{
			$("#sstate").val('<?php echo stripslashes($statedat->state_name); ?>');
			var elmt = billaddelmts;
			$("#sdiv2").html(elmt);
			$.ajax({url:ajaxsurl+ajaxvalues,success:function(result){ //alert(result); 
			}});
		/*$("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
		$.ajax({url:"get_ship_rates.php?dest_zip=<?php //echo stripslashes($ugetdat->zipcode); ?>",success:function(result){ 
		$("#ship_rates").html(result); 
		}});*/
		}
	}
	else
	{
		
		$.ajax({url:"test.php",success:function(result){ /* Retrieve data from biiling table */	}});
		window.setTimeout(function(){$("#shipinfo").css({background:bck,color:text});$("#div2").slideDown();$("#sdiv1").slideDown();$("#div1").slideUp(); b=true; },stime);
	}
	$("#but1").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");		
	window.setTimeout(function(){$("#but1").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);},btime);	
	});
	
$("#but2").click(function(){	
	if($("#address").val()=="old")
	{
		var elmt = billaddelmts;
		$("#sdiv2").html(elmt);
		$.ajax({url:ajaxsurl+ajaxvalues,success:function(result){ //alert(result); 
		}});
		$("#sstate").val('<?php echo stripslashes($statedat->state_name); ?>');
		/*$("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
		$.ajax({url:"get_ship_rates.php?dest_zip=<?php //echo stripslashes($ugetdat->zipcode); ?>",success:function(result){ 
		$("#ship_rates").html(result); 
		}});*/
	}
	else
	{

		if($("#sfname").val()==""){$("#svalfname").html("*Please enter First name!"); $("#sfname").focus(); return false;}else{$("#svalfname").html("");}
		if($("#slname").val()==""){$("#svallname").html("*Please enter Last name!"); $("#slname").focus(); return false;}else{$("#svallname").html("");}
		if($("#semail").val()==""){$("#svalbemail").html("*Please enter Email!"); $("#semail").focus(); return false;}else{if(IsEmail($("#semail").val())==false){$("#svalbemail").html("*Enter valid email!"); $("#semail").focus(); return false; }else{$("#svalbemail").html("");}}
		if($("#saddr1").val()==""){$("#svaladdr1").html("*Please enter address!"); $("#saddr1").focus(); return false;}else{$("#svaladdr1").html("");}
		if($("#scity").val()==""){$("#svalcity").html("*Please enter city!"); $("#scity").focus(); return false;}else{$("#svalcity").html("");}
		if($("#scountry").val()==""){$("#svalcountry").html("*Please enter country!"); $("#scountry").focus(); return false;}else{$("#svalcountry").html("");}
		if($("#szip").val()==""){$("#svalzip").html("*Please enter zip!"); $("#szip").focus(); return false;}else{
			if($.isNumeric($("#szip").val())==false){ $("#svalzip").html("Enter valid zip code"); return false; }else{ $("#svalzip").html("");}}
		if($("#sstate").val()==""){$("#svalstate").html("*Please enter state!");$("#sstate").focus();return false;}else{$("#svalstate").html("");}
		
		if($("#stelephone").val()==""){$("#svaltelephone").html("*Please enter telephone!"); $("#stelephone").focus(); return false;}else{ if($.isNumeric($("#stelephone").val())==false){ $("#svaltelephone").html("Enter valid number"); return false; }else{ $("#svaltelephone").html("");}}
		
		var elmt = '<ul class="billlis"><li>'+$("#sfname").val()+'&emsp;'+$("#slname").val()+'</li><li>'+$("#semail").val()+'</li><li>'+$("#saddr1").val()+'</li><li>'+$("#scity").val()+'</li><li>'+$("#sstate").val()+','+$("#szip").val()+'</li><li>'+$("#scountry").val()+'</li></ul>';
		$("#sdiv2").html(elmt);	
		//alert(hai); 
		$.ajax({url:"updatesaddress.php?first_name="+$("#sfname").val()+"&&last_name="+$("#slname").val()+"&&email="+$("#semail").val()+"&&address="+$("#saddr1").val()+"&&companyname="+$("#scmpny").val()+"&&city="+$("#scity").val()+"&&telephone="+$("#stelephone").val()+"&&state="+$("#sstate").val()+"&&fax="+$("#sfax").val()+"&&zip_code="+$("#szip").val()+"&&country="+$("#scountry").val(),success:function(result){ //alert(result); 
		}});
		
		/*$("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
		$.ajax({url:"get_ship_rates.php?dest_zip="+$("#szip").val(),success:function(result){ 
		$("#ship_rates").html(result); 
		}});*/
	}
	if($("#usebaddr").prop('checked')){
		if($("#billaddress").val()=="old")
		{
			var elmt =billaddelmts;
			$("#sdiv2").html(elmt);
			$.ajax({url:ajaxurl+ajaxvalues,success:function(result){ //alert(result);  
			}});
			$("#sstate").val('<?php echo stripslashes($statedat->state_name); ?>');
			//$("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
			/*$.ajax({url:"get_ship_rates.php?dest_zip=<?php echo stripslashes($ugetdat->zipcode); ?>",success:function(result){ 
		$("#ship_rates").html(result); 
		}});*/
		
		}
		else{
			var elmt = '<ul class="billlis"><li>'+$("#fname").val()+'&emsp;'+$("#lname").val()+'</li><li>'+$("#bemail").val()+'</li><li>'+$("#addr1").val()+'</li><li>'+$("#city").val()+'</li><li>'+$("#state").val()+','+$("#zip").val()+'</li><li>'+$("#country").val()+'</li></ul>';
			$("#sdiv2").html(elmt);	
			//alert(hi);
			$.ajax({url:"<?php echo SITEURL; ?>/updatesaddress.php?first_name="+$("#fname").val()+"&&last_name="+$("#lname").val()+"&&email="+$("#bemail").val()+"&&address="+$("#addr1").val()+"&&city="+$("#city").val()+"&&state="+$("#state").val()+"&&zip_code="+$("#zip").val()+"&&country="+$("#country").val(),success:function(result){ //alert(result); 
			}});
			
			$("#sfname").val($("#fname").val());
			$("#slname").val($("#lname").val());
			$("#semail").val($("#bemail").val());
			$("#saddr1").val($("#addr1").val());
			$("#scity").val($("#city").val());
			$("#sstate").val($("#state").val());
			$("#szip").val($("#zip").val());
			$("#scmpny").val($("#cmpny").val());
			$("#scountry").val($("#country").val());
			$("#stelephone").val($("#telephone").val());
			$("#sfax").val($("#fax").val());
			
			/*$("#ship_rates").html("<h2>Getting Shipping Details.....</h2>");
			$.ajax({url:"get_ship_rates.php?dest_zip="+$("#zip").val(),success:function(result){ 
		$("#ship_rates").html(result); 
		}});	*/		
		}
	}
	$("#but2").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");
	window.setTimeout(function(){$("#shipmeth").css({background:bck,color:text});$("#div3").slideDown();$("#sdiv2").slideDown();$("#div2").slideUp();c=true;},stime);
	window.setTimeout(function(){$("#but2").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);},btime);	
	});
	
$("#but3").click(function(){	
	if(!$("input[name='shipmethod']:checked").val()){
		//alert('Please select shipping method!');
		return false;
	}
	else{
		var value = $("input[name='shipmethod']:checked").val();
		var n = value.lastIndexOf("$");
		var m = value.substr(n+1);	
		if(!$.isNumeric(m))
		{
			//alert('Sorry shipping not available!');
			return false;
		}
		else{		
			$("#shipr").html(m);	
			$("#shiprh").val(m);
			var data = '<ul class="billlis"><li>Shipping Method : '+value+'</li></ul>';
			$("#sdiv3").html(data);
			
			var ff = parseFloat($("#subtrh").val().replace(',', ''));
			
				/*comments*/			
			var ff = parseFloat($("#subtrh").val());
			
			var rr = parseFloat($("#subtrh").val());
			//alert(ff);
			if($("#disch").val()!='')
			{
				$("#dispdisc1").show();
				$("#dispdisc2").show();																				
				ff = ff - parseFloat($("#disch").val())
			} /*comments*/
			var gg = parseFloat($("#shiprh").val());
			var to = ff+gg;
			
			/*comments*/
			if($("#sstate").val()=="California"){
				$("#totbtaxh").val(parseFloat(to.toString()).toFixed(2));
				$("#totbtax").html(parseFloat(to.toString()).toFixed(2));
				$("#totbeftax").show();
				tax = ((20/100)*to);
				to = to + ((20/100)*to);
				to = parseFloat(to.toString()).toFixed(2);
			tax = parseFloat(tax.toString()).toFixed(2);
				$("#taxh").val(tax);
				$("#taxs").html(tax);
				$("#taxrow1").show();			
			}
			else
			{
				$("#taxh").val('');
				$("#taxs").html('');
				$("#taxrow1").hide();
				$("#totbtaxh").val('');
				$("#totbtax").html('');
				$("#totbeftax").hide();
			}   /*comments*/
			to = parseFloat(to.toString()).toFixed(2);		
			
			if(rr >= 100){
			
			$("#example_payment_amuont").val(rr);
			$("#tothp").val(rr);
		    $("#toth").val(rr);
			$("#total").html(rr);
			}
			else {
			
			$("#toth").val(to);
			$("#example_payment_amuont").val(to);		
			$("#tothp").val(to);	
			$("#total").html(to);
			}
		}
	}	
	$("#but3").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");
	window.setTimeout(function(){$("#orderrev").css({background:bck,color:text});$("#div4").slideDown();$("#sdiv3").slideDown();$("#div3").slideUp();d=true;},stime);
	window.setTimeout(function(){$("#but3").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);},btime);	
	});
	
$("#but4").click(function(){

	$("#but4").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");
	var ss=parseFloat($("#subtrh").val().toString()).toFixed(2);
	
	if(ss >= 100)
	{
	
		var data1 = '<ul class="billlis"><li><table><tr><td style="float:left; margin-left:15px;">Total </td><td>        :&emsp; </td><td></td><td align="right">$'+ss+'</td></tr>';
		$("#sdiv4").html(data1);	
	
	} else
	 {
	 
	var data1 = '<ul class="billlis"><li><table><tr><td style="float:left; margin-left:15px;">Total </td><td>:&emsp; </td><td></td><td align="right">$'+ss+'</td></tr>';
	
	if($("#disch").val()!=''){
	var dsvar = $("#disch").val();
	var shvar = $("#shiprh").val();
	data2 = data1+'<tr><td style="float:left; margin-left:15px;">Coupon </td><td> :&emsp;</td><td>-</td><td align="right">$'+parseFloat(dsvar.toString()).toFixed(2)+'</td></tr>';	}
	
	
	data = data2+'<tr><td style=" margin-left:2px;">Delivery & Processing </td><td> :&emsp;</td><td>+</td><td align="right">$'+parseFloat(shvar.toString()).toFixed(2)+'</td></tr>';
	
	if($("#sstate").val()=="California"){
	data = data+'<tr><td>Total Before Tax </td><td> : </td><td></td><td align="right">$'+$("#totbtaxh").val()+'</td></tr>';
	data = data+'<tr><td>(CA 9%) Tax </td><td> :&emsp;+</td><td></td><td align="right">$'+tax+'</td></tr>';	}
	data = data+'<tr><td style=" margin-left:2px;">Grand Total </td><td> : </td><td></td><td align="right">$'+$("#toth").val()+'</td></tr></table></li></ul>';
	
	$("#sdiv4").html(data);	
	}
	
	window.setTimeout(function(){$("#payinfo").css({background:bck,color:text});$("#div5").slideDown();$("#sdiv4").slideDown();$("#div4").slideUp();e=true;},stime);
	window.setTimeout(function(){$("#but4").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);},btime);
});
	
	
$("#bilinfo").click(function(){if(a==true){b=c=d=e=false;$("#div1").slideDown();$(".clekedform").not("#div1").slideUp();$(".billlisblog").slideUp();}});
$("#shipinfo").click(function(){if(b==true){c=d=e=false;$("#div2").slideDown();$(".clekedform").not("#div2").slideUp();
$(".billlisblog").not("#sdiv1").slideUp();}});
$("#shipmeth").click(function(){if(c==true){d=e=false;$("#div3").slideDown();$(".clekedform").not("#div3").slideUp();
$(".billlisblog").not("#sdiv1,#sdiv2").slideUp();}});
$("#orderrev").click(function(){if(d==true){e=false;$("#div4").slideDown();$(".clekedform").not("#div4").slideUp();
$(".billlisblog").not("#sdiv1,#sdiv2,#sdiv3").slideUp();}});
$("#payinfo").click(function(){if(e==true){$("#div5").slideDown();$(".clekedform").not("#div5").slideUp();}});
$("#address").change(function(){if($(this).val()=="new"){$("#newsbill").slideDown();$("#usebaddr").prop('checked',false);}else{$("#newsbill").slideUp();}});
$("#billaddress").change(function(){if($(this).val()=="new"){$("#newbill").slideDown();}else{$("#newbill").slideUp();}});
});
function getrates(rr){}
function payments(pays){if(pays=='creditcard'){$("#paydetails").slideDown();}else{$("#paydetails").slideUp();}}

</script>

       <!--clearfix-->
    <script type="text/javascript">
	function validateocode(){
	//alert('hai');
	 couponcodeval=document.getElementById('couponcode').value;
	 alert(couponcodeval);
	 if(couponcodeval==""){
		//alert("Please Enter Coupon Code");
		document.getElementById('date_list').innerHTML = 'Please Enter Coupon Code';
		document.getElementById('invalidcoupon').style.display="none";
		document.getElementById('couponcode').value="";		
		document.getElementById('couponcode').focus();
		return false;
		}
		else{
			document.getElementById('date_list').innerHTML = '';
		}
	   if(couponcodeval!="")
		{
		$.ajax({   
			type: "POST",
			url: "<?php echo SITEURL; ?>/checkcoupon.php",
			
			data:{coupon_code:$("#couponcode").val(),cart_amount:parseFloat($("#subtrh").val().replace(',','')),randomid:$("#cartrandomid").val()},
			success: function(msg) {
			//alert(msg);
				var obj = $.parseJSON(msg);
				//alert(obj.amount);
				if(obj.amount==0)
				{
					$("#invalidcoupon").show();
				}
			else
				{
					$("#invalidcoupon").hide();
					var ff = parseFloat($("#subtrh").val().replace(',',''));
					var p = parseFloat(obj.amount.toString()).toFixed(2);
					$("#disch").val(parseFloat(p.toString()).toFixed(2));
					$("#dispdisc1").show();
					$("#dispdisc2").show();																				
					$("#discp").html(parseFloat(p.toString()).toFixed(2));						
					$("#discount_coupon_div").hide();	
					$("#discount_coupon_div2").show();						

					$("#amountdis").html(parseFloat(p.toString()).toFixed(2));
					//var ff = parseFloat($("#subtrh").val());
					ff = ff - obj.amount;
					var gg = parseFloat($("#shiprh").val());
					var to = ff+gg;
					//alert(sstate);
					if($("#sstate").val()=="California"){
						$("#totbtaxh").val(parseFloat(to.toString()).toFixed(2));
						$("#totbtax").html(parseFloat(to.toString()).toFixed(2));
						$("#totbeftax").show();
						tax = ((20/100)*to);
						to = to + ((20/100)*to);
						to = parseFloat(to.toString()).toFixed(2);
						tax = parseFloat(tax.toString()).toFixed(2);
						$("#taxh").val(tax);
						$("#taxs").html(tax);
						$("#taxrow1").show();
					}
					else
					{
						$("#taxh").val('');	$("#taxs").html(''); $("#taxrow1").hide(); $("#totbtaxh").val(''); $("#totbtax").html(''); $("#totbeftax").hide();
					}
					to = parseFloat(to.toString()).toFixed(2);		
					$("#toth").val(to);
					$("#example_payment_amuont").val(to);
					$("#tothp").val(to);
					$("#total").html(to);					
				}
			}
		});		
		}
		return false;
	}
	
</script>
<div class="clearfix">
</div>
<!--End clearfix-->

     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="images/aboutarow_03.png" alt=""></li>
                 <li><a href="#">Checkout</a></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
   
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <div class="concomimg">
              
                <div class="checkout_left">

                    <div class="first_method" id="flip0">
                         <span>1.</span> Checkout Method
                    </div><!--first_method-->
                    <?php //echo $_SESSION['frnt_mid'];  ?>
                    <?php if($_SESSION['frnt_mid']=="") {?>   
                    <div class="checkout_method" id="div0">
                    
                       <div class="check_left">
                        
                         <h4>CHECKOUT AS A GUEST OR REGISTER</h4>
                         <div class="checkleft_para1">Register with us for future convenience:</div><!--checkleft_para-->
                         <div class="radio_btn">
                         <input type="radio" name="checktype" id="checktype1" class="chktype" value="guest" onClick="guest()"> <span >Checkout as Guest </span>
                         <div id="guest" class="checkleft_btn" style="display:none">
                        <div class="checkleft_text">Birth Date <span>*</span> </div> <input type="date" name="b_date" id="b_date" >
                          
                         </div>
                         </div><!--radio_btn-->
                         <div class="radio_btn"><input type="radio" name="checktype" id="checktype2" class="chktype" value="register">&nbsp;Register</div><!--radio_btn-->
                         
                         <h4>REGISTER AND SAVE TIME!</h4>
                         
                         <div class="checkleft_para">Register with us for future convenience:</div><!--checkleft_para-->
                         <div class="checkleft_para2">Fast and easy check out</div><!--checkleft_para-->
                         <div class="checkleft_para">Easy access to your order history and status</div><!--checkleft_para-->
                         
                         <div class="continue_btn">
                            <input type="submit" value="Continue" id="submit_button" />
                        </div><!--continue_btn-->
                         
                       
                       </div><!--check_left-->
                      <form method="post" name="loginform" id="loginform">
                       
                       <div class="check_right">
          
                           <h4>LOGIN</h4>
                         <div class="checkleft_para2">Already registered?</div><!--checkleft_para-->
                         <div class="checkleft_para">Please log in below:</div><!--checkleft_para-->
                         
                         <div class="checkleft_text">Email Adress<span>*</span></div><!---checkleft_text--->
                         <div class="checkleft_btn"><input type="text" name="email" id="email"></div>
                         <div class="clear_fix"></div>
            <b id="valemail" class="valchk"></b><!---checkleft_btn--->
                         
                         <div class="checkleft_text">Password<span>*</span></div><!---checkleft_text--->
                         <div class="checkleft_btn"><input type="password" name="password" id="password"></div>
                         <div class="clear_fix"></div>
             <b id="valpassword" class="valchk"></b><!---checkleft_btn--->
                         
                         
                         <div class="forgot_pwd"><a href="#">Forgot Password?</a></div><!--forgot_pwd-->
                         <!--<a href="<?php echo SITEURL;?>/Forgetpassword">Forgot Password?</a>-->
                         <div class="submit_btn">
                          <input type="submit" value="Login" id="login_button" name="submit">
                         <div class="checkleft_para2"><span class="red">*</span>Required Fields</div><!--checkleft_para-->
                         
                         </div><!--submit_btn-->
                         
                       
                       </div><!--check_right-->
                        </form>
                       <div class="clear_fix"></div>
                    
                    </div><!--checkout_method-->
                    <?php  } ?>
                     <form name="checkout" id="checkout" method="post" >
  <input type="hidden" value="<?php echo $_SESSION['frnt_mid']; ?>" name="uid" id="uid" />
  
  <input type="hidden" id="user_name" name="user_name" value="<?php echo $ugetdat->firstname; ?> <?php echo $ugetdat->lastname; ?>" />
  <input type="hidden" name="paypal" value="paypal" />
  <input type="hidden" id="user_email" name="user_email" value="<?php echo $ugetdat->email; ?>" />
 

                    <div class="second_method" id="bilinfo" >
                         <a href="#"><span>2.</span> Billing Information</a>
                    </div><!--second_method-->
                    
                    <div class="checkout_method"  id="div1"  style="display:none;">
                    
                       <div class="check_left">
                       <div class="checkleft_text"> First Name <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"><input type="text" name="fname" id="fname" value="<?php echo $_SESSION['frnt_usname']; ?>" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text"> Last Name <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text" name="lname" id="lname" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_right-->

                       <div class="clear_fix"></div>
                    
                       <div class="check_left">
                       <div class="checkleft_text">Company</div><!--checkleft_text-->
                       <div class="checkleft_btn">    <input type="text" name="cmpny" id="cmpny" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text">Email Address<span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn">    <input type="text" name="email" value="<?php echo $_SESSION['frnt_memail']; ?>" st id="bemail" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>
                       
                       
                       <!--<div class="checkleft_text">Address <span>*</span></div>-->
                       <!--checkleft_text-->
                       <!--<div class="checkleft_btn1">
                        <textarea name="addr1" id="addr1" style="width:573px; height:60px; padding:0px; display:block;"></textarea>
                       </div>--><!--checkleft_btn1-->


                      <!-- <div class="checkleft_btn1">
                        <textarea></textarea>
                       </div>--><!--checkleft_btn1-->

                       <div class="check_left">
                       <div class="checkleft_text">City <span>*</span></div><!--checkleft_text-->
                       <div class="checkleft_btn">   <input type="text" name="city" id="city" value="<?php echo $_SESSION['city']; ?>" style='display:block;'/>
                       
                        </div>
                       <b id="valcity" class="valchk"></b>
                       <!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       
                       
                       <div class="check_right">
                       <div class="checkleft_text">Country <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <?php //$con="select * from tb_countries"; 
                   //$conres=mysql_query($con);?>
                            <select name="country" id="country" style="border: 1px solid #b0b0b0;
    border-radius: 5px;
    margin-top: 5px;
    padding: 8px;
    width: 95%; display:block;" >     
                   				   
             <option value="">Select Country</option>
			  <option value="USA">USA</option>
				  <?php /*?> <?php while($row=mysql_fetch_array($conres)){ ?>
                  <option value="<?php echo $row['countryname']?>"><?php echo $row['countryname']?></option>
                  <?php } ?><?php */?>
				  
				  
             </select></div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>
                       
                       
                         <div class="check_right">
                       <div class="checkleft_text"> Birth Date <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn">
                       
                        <input type="date" name="date"  id="date" style='display:block;'/> </div><!--checkleft_btn-->
                       </div>



                       <div class="check_left">
                       <div class="checkleft_text">Zip/Postal Code<span>*</span></div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text" name="zip" id="zip" style='display:block;' value="<?php echo $_SESSION['zip']; ?>"/> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_left">
                       <div class="checkleft_text">Telephone <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text" name="telephone" id="telephone" value="<?php echo $_SESSION['phone']; ?>" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       
                       <div class="check_left" style="margin-left:60px;">
                      <div class="checkleft_text">State/Province <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"><input type="text" name="state" id="state" style='display:block;' value="<?php echo $_SESSION['state']; ?>" /> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_left">
                       <div class="checkleft_text">Fax</div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text" name="fax" id="fax" style='display:block;'/> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>
                       
                       
                       
                       
                       <div class="checkleft_text">Address <span>*</span></div>
                       <!--checkleft_text-->
                       <div class="checkleft_btn1">
                        <textarea name="addr1" id="addr1"  style="width:573px; height:60px; padding:0px; display:block;"><?php echo $_SESSION['address'];?></textarea>
                       </div>
 <div class="clear_fix"></div>

                       <div class="checkleft_btn1"> <input type="radio" name="shipto" id="shipto" value="shipto" checked/> Ship to this address</div><!--checkleft_btn1-->
                       <div class="checkleft_btn1"> <input type="radio" name="shipto" id="shiptodiff" value="shiptodiff"/> Ship to different address</div><!--checkleft_btn1-->
                       
                         <div class="submit_btn">
                         <div class="checkleft_para2"><span class="red">*</span>Required Fields</div><!--checkleft_para-->
                         
                          <!--<input type="submit" value="Continue">-->
                          <input type="submit" id="but1" name="submit1" value="Continue"  >
                         
                         </div><!--submit_btn-->

                       <div class="clear_fix"></div>

                    </div><!--checkout_method-->
                    
                    
                    <div class="second_method"  id="shipinfo">
                         <a href="#"><span>3.</span> Shipping Information</a>
                    </div><!--first_method-->
                    
                    
                    <div class="checkout_method" id="div2" style="display:none;">
                    
                   
                    <?php if(($_SESSION['frnt_mid']=='')){
							$display = 'style="display:block;"';
						}else{
							$display = 'style="display:none;"';
							}
							?>
                   <div class="enter_mail">Enter a shipping address</div><!--enter_mail-->

                   <div class="shipping_text">First Name: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text" name="fname" value="<?php echo $_SESSION['frnt_usname']; ?>" id="sfname" style='display:block;'/>
                            <b id="svalfname" class="valchk"></b> </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Last Name: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text" name="lname" id="slname" style='display:block;'/>
                            <b id="svallname" class="valchk"></b> </div><!--shipping_btn-->
                      <div class="clear_fix"></div>       
                            
                   <div class="shipping_text">Email: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text" name="email"  
value="<?php echo $_SESSION['frnt_memail']; ?>"  id="semail" style='display:block;'/>
                            <b id="svalbemail" class="valchk"></b> </div><!--shipping_btn-->

                   <div class="clear_fix"></div>
                   
                   <div class="shipping_text">Company: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text" name="cmpny" id="scmpny" style='display:block;'/></div><!--shipping_btn-->
                   <div class="clear_fix"></div>
                   
                   <div class="shipping_text">Address: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><textarea name="addr1" id="saddr1" style=" height:60px; padding:0px; display:block;">
				   
				   <?php echo $_SESSION['address']; ?>
				   </textarea>  <b id="svaladdr1" class="valchk"></b></div><!--shipping_btn-->
                   <div class="clear_fix"></div>
                   
                    <div class="shipping_text">City: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text" name="city"  
value="<?php echo $_SESSION['city']; ?>" id="scity" style='display:block;'/>
                    <b id="svalcity" class="valchk"></b></div><!--shipping_btn-->
                   <div class="clear_fix"></div>
                   
                    <div class="shipping_text">Country: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn">   <?php //$con="select * from tb_countries"; 
                    //$conres=mysql_query($con);?>
                            <select name="country" id="scountry" style="padding:5px; display:block;" >     
                   				   
             <option value="">Select Country</option>
			   <option value="USA">USA</option>
				   <?php /*?><?php while($row=mysql_fetch_array($conres)){ ?>
                  <option value="<?php echo $row['countryname']?>"><?php echo $row['countryname']?></option>
                  <?php } ?><?php */?>
             </select>
              <b id="svalcountry" class="valchk"></b>
             </div><!--shipping_btn-->
                   <div class="clear_fix"></div>
                   
                   <div class="shipping_text">Zip/Postal Code: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"> <input type="text" name="zip" id="szip" style='display:block;'/>
                    <b id="svalzip" class="valchk"></b></div><!--shipping_btn-->
                   <div class="clear_fix"></div>
					
                    
                   <div class="shipping_text">State/Province/Region: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn">

                  <input type="text" name="state" id="sstate"  style='display:block;'/>
                  				<input type="hidden" name="hid_sstate" id="hid_sstate" value="<?php echo stripslashes($statedat->state_name) ?>" style='display:block;'/>
                                 <b id="svalstate" class="valchk"></b>
                   </div><!--shipping_btn-->
                   <div class="clear_fix"></div>
                    
                   <div class="shipping_text">Telephone: </div><!--shipping_text-->
                   <div class="shipping_btn"> <input type="text" name="telephone" id="stelephone"  
value="<?php echo $_SESSION['phone']; ?>" style='display:block;'/>
                            <b id="svaltelephone" class="valchk"></b></div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Fax: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"> <input type="text" name="fax" id="sfax"/></div><!--shipping_btn-->
                   <div class="clear_fix"></div>


                   <div class="shipping_text"> </div><!--shipping_text-->
                   <div class="shipping_btn"> <input type="checkbox" name="userbaddr" id="usebaddr" value="useb" onclick="ubadd(this.checked)" /> Use Billing Address
                   </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text"> </div><!--shipping_text-->
                   <div class="shipping_btn"><input type="submit" id="but2"  name="submit2" value="CONTINUE"></div><!--shipping_btn-->
                   <div class="clear_fix"></div>



               

                       <div class="clear_fix"></div>

                    </div><!--checkout_method-->

                    <div class="second_method"  id="shipmeth">
                         <a href="#"><span>4.</span> Shipping Method</a>
                    </div><!--first_method-->
					<div class="clekedform" id="div3" style="display:none; min-height:50px; padding-top:10px; ">
                     	<div  class="checkout_method" >
                            <ul class="infolis" id="ship_rates">
                            
                           <?php  $rate = $sitesettings->shippingamount; ?>


                        <!--  <input type="radio" name="shipmethod" class="shipmethcal" onClick="getrates(this.value);" value="<?php //echo $sitesettings->shipping_method; echo "$".$rate; ?>"> <?php // echo $sitesettings->shipping_method;?> <span style="float:right; margin-right:150px;"><?php //echo "$".$rate; ?> </span>-->
						  
						  
						  
						  <input type="radio" name="shipmethod" class="shipmethcal" onClick="getrates(this.value);" value="<?php echo "$".$_SESSION['shippingamount']; ?>"> <?php echo $sitesettings->shipping_method;?> <span style="float:right; margin-right:150px;"><?php echo "$".$_SESSION['shippingamount']; ?> </span>
						  
						  
						  
						  
						  
						  
                            </ul>
	                   
                        
                         <div class="continue_btn">
                            <input type="submit" id="but3" name="submit3" value="Continue"  >
                        </div>
                        
                        </div> 
                    </div>
                    
                    
                    <div class="second_method" id="orderrev">
                         <a href="#"><span>5.</span>Order Review </a>
                    </div><!--first_method-->
					<div class="clekedform" id="div4" style="display:none;" >
                    <table width="100%" style="border:1px solid #4e4e4e !important" class="exampleone">
                        <tr height="20">
                        	<th style="border-bottom:1px solid #000" width="28%" ><font style="float:left; margin-left:4px;">Product name</font></th>
                        	<th style="border-bottom:1px solid #000" width="22%">Price</th>
		                    <th style="border-bottom:1px solid #000" width="16%">Qty</th>
	                        <th style="border-bottom:1px solid #000" width="19%">Sub Total</th>
                        </tr>
                        <?php foreach($cartproducts as $prd){ 
						//print_r($prd);?>
                        <tr height="20">
                        	<td><font style="float:left; margin-left:4px;"><?php echo $prd->prod_name; ?></font></td>
	                        <td align="center">$<?php echo number_format($prd->indiv_price,2); ?></td>
	                        <td align="center"><?php echo $prd->quantity; ?></td>
	                        <td align="right">$<?php echo number_format($prd->total_price,2); ?></td>
                            <input type="hidden" name="user_type" value="normal" />
                            <input type="hidden" name="wuser_type" value="wholesale" />
                            <input type="hidden" name="prod_price[]" value="<?php echo $prd->total_price; ?>" />
                            <input type="hidden" name="prod_name[]" value="<?php echo $prd->prod_name; ?>" />
                            <input type="hidden" name="prod_id[]" value="<?php echo $prd->prod_id; ?>" />
                            <input type="hidden" name="prod_quantity[]" value="<?php echo $prd->quantity; ?>" />
                            <input type="hidden" name="provider_id[]" id="provider_id" value="<?php echo $prd->provider_id; ?>" />
                           
                        </tr>
                        <?php $totprc+=$prd->total_price;
                        $cc++;
                        }
                        ?>
                        <tr><td colspan="4" style="border:1px solid #000;"></td>
                        </tr>
                        <tr height="25">
                        	<td colspan="3" align="right">Total</td>
                        	<td align="right">$<?php echo number_format($totprc,2); ?>
                            <input type="hidden" id="subtrh" value="<?php echo number_format($totprc,2); ?>"></td>
                        </tr>
                        <?php if($totprc <= 100)
						{
						?>
                        <!--coupon-->
                        <tr height="25">
                        <?php if($prd->distype!=''){?>
                        	<td colspan="3" align="right">Promo Code:</td>
                        	<td align="right"> <?php
							$coupondiscountamount=$cartobj->discountCaliculation($prd->discountamount,$prd->distype,$totprc);							
							?>
							-&nbsp;$<b id="discp"  class="nmoney"><?php echo number_format($coupondiscountamount,2); ?></b>
                            <input type="hidden" id="disch" name="disch" value="<?php echo number_format($coupondiscountamount,2); ?>"></td>
                        <?php
                        }
                        else
                        {
                        ?>
                        	<td colspan="3" align="right" id="dispdisc1">Promo Code:</td>
                        	<td width="2%" align="right" id="dispdisc2" style="display:none;" >
							<?php echo "-&nbsp;"."$"; ?><b id="discp"  class="nmoney">0.00</b>
                            <input type="hidden" id="disch" name="disch" value="0.00" style="display:none;">
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                        <!--end coupon-->
                        <tr height="25">
                      <!--  <td colspan="3" align="right">Delivery & Processing</td>-->
						<td colspan="3" align="right">Shipping Amount</td>
                        	<td align="right">$<b id="shipr" class="nmoney"><?php echo $totprc; ?></b>
                            <input type="hidden" id="shiprh" value="" name="shiprh"></td>
                        </tr>
                        <tr height="25" id="totbeftax" style="display:none; border-top:2px solid #000;">
                        	<td colspan="3" align="right">Total Before Tax</td>
                        	<td align="right" style="border-top:2px solid #000;"><?php echo "&nbsp;"."$"; ?>
                            <b id="totbtax" class="money"></b>
                            <input type="hidden" id="totbtaxh" value="" name="totbtaxh"></td>
                        </tr>
                        <tr height="25" id="taxrow1" style="display:none;">
                        	<td colspan="3" align="right">(CA 9%) Tax</td>
                        	<td align="right"><?php echo "+&nbsp;"."$"; ?><b id="taxs" class="nmoney"></b>
                            <input type="hidden" id="taxh" value="" name="taxh"></td>
                        </tr>
                            <?php } ?>                  
                        <tr height="25">
                        	<td colspan="3" align="right" style="border-top: 2px solid rgb(0, 0, 0);">Grand Total</td>                        
                        	<td align="right" style="border-top:2px solid #000;">$<b id="total" class="money"></b>
                            <input type="hidden" id="toth" value="" name="toth"></td>
                        </tr> 
                        <!--coupon discount-->  
                    <tr>
                    	<?php ?><td colspan="2">
                    <?php if($prd->discount=='no'){?>
                       <div class="checkleft_btn1  " id="discount_coupon_di" >
                  <span style="color:#8fbf2d;" >  Promo Code</span>
                        <input type="text" name="couponcode" id="couponcode"   >
                        <input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
                       
                        <input type="button" value="Apply"  onclick="javascript:return validateocode()" style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px; border-radius: 3px; color:#FFF; cursor:pointer;"/>
                        
                        </div>
               
                    <?php 
					
					//echo $prd->distype;
					}
					else if($prd->distype!=''){?>
                    <div class="formtextsub" id="discount_coupon_di">
                        <span style="color:#8fbf2d;" >  Promo Code</span>
                       <input type="text" name="couponcode" id="couponcode"   class="textcoupon">
                        <input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
                       
                      <input type="button" value="Apply"   onclick="javascript:return validateocode()" style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px;  border-radius: 3px; color:#FFF; cursor:pointer;" />
                        <?php
						$coupondiscountamount = $cartobj->discountCaliculation($prd->discountamount,$prd->distype,$totprc);
						?>
                       <b>$</b><b id="amountdis"><?php echo number_format($coupondiscountamount,2);  ?></b>                        </div>                    	
                    <?php
                        }
                        else
                        {
                        ?>
                        <div class="formtextsub" id="discount_coupon_di">
                   <span style="color:#8fbf2d;" >  Promo Code</span>
                       <input type="text" name="couponcode" id="couponcode"   class="textcoupon">
                        <input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
                        
                     <input type="button" value="Apply"  onclick="javascript:return validateocode()"  style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px;  border-radius: 3px; color:#FFF; cursor:pointer;" />
                       
                        </div>
                    <?php } ?>      
                        </td> <?php ?>      
                        <!--end coupon discount-->                             
                        <td align="right">
						<div class="continue_btn"  align="right">
                            <input type="submit" id="but4" name="submit4" value="Continue"  >
                        </div>
						
                       <?php /*?> <input type="button" id="but4" name="submit4" value="Continue" style="float: right; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(243, 131, 7); position:relative; top:13px; margin-right:-148px;"  class="baccc"><?php */?>
                        </td>
                     </tr>
                    <tr>
                     	<td colspan="4">
                        	<div style="display:none; color:#FF0000; margin-left:78px;" id="invalidcoupon">Invalid Coupon</div>                            <div id="date_list" style="color:#FF0000; margin-left:48px;"></div>
                        </td>
                     </tr>
                     </table>
                     	
                     
                     </div>
                     
                     
                    <div class="second_method" id="payinfo">
						
                        <a href="#"><span>6.</span>Payment Information </a>
                    </div><!--first_method-->
                     <script>
					 	$(document).ready(function(){
							$("#cardtype1").click(function(){
								$("#paydetails").slideDown();
								$("#paypal_sub").hide();
								$("#cc_cvv2_number").attr("required","required");
								$("#customer_credit_card_number").attr("required","required");
								$("#checkout").attr("action","paypal_pro.php");
								
							});
							$("#cardtype2").click(function(){
								$("#paydetails").slideUp();
								$("#paypal_sub").show();
								$("#cc_cvv2_number").removeAttr("required");
								$("#customer_credit_card_number").removeAttr("required");
								$("#checkout").removeAttr("action");
								//$("#checkout").attr("action","<?php echo SITEURL; ?>/paypal.php?id=paypal_id");
							});
						});
					 </script>
                     <div class="clekedform" id="div5" style="display:none;">
					 <div  class="checkout_method" >
                     	<ul style="margin-bottom:54px;">
                        	<li style="position:relative; top:10px; margin-left:15px;">
                            	<?php /*?><input type="radio" name="cardtype" id="cardtype1" value="visa">Credit Cards<?php */?>
                              <!--  <img src="<?php echo SITEURL; ?>/images/cardsimg_14.jpg">-->
                                                        
                            	<input type="radio" name="cardtype" id="cardtype2" value="paypal">Paypal
                             <!--   <img src="<?php echo SITEURL; ?>/images/footer_cards_06.png">-->
                             
                             <div class="continue_btn">
                   <input type="submit" id="paypal_sub" name="paypal_paying"  value="Continue to paypal"  >
                                 </div>
                               <!-- <input type="submit" name="paypal_paying" id="paypal_sub" class="baccc" style=" float:right; position:relative; top:41px;" value="Continue to paypal">-->
                            </li>
                        </ul>
						</div>
                     	<ul class="infolis" id="paydetails" style="display:none;">
                        <li> <table class="second_step" style="float:left; margin-left:-21px;">
               			<input type="hidden" name="customer_first_name" id="customer_first_name" value="<?php echo $ugetdat->firstname; ?>"   readonly="readonly"/>
						<input type="hidden" name="customer_address1" id="customer_address1" value="<?php echo $ugetdat->address; ?>"  readonly="readonly"/>
						<input type="hidden" name="customer_last_name" id="customer_last_name" value="<?php echo $ugetdat->last_name; ?>"   readonly="readonly"/>
                       
                        
                        <input type="hidden" name="customer_city" id="customer_city" value="<?php echo $citydat->city_name; ?>"   readonly="readonly"/>
                        <input type="hidden" name="customer_zip" id="customer_zip" value="<?php echo $ugetdat->zip_code; ?>"   readonly="readonly"/>
                   
                    <tr>
                    	<td><span style="float: left; width: 97px; margin-left:-1px; position:relative; top:-12px;">Credit Card Type: </span></td>
                        <td></td>
                        <td>
                        	<span style="float: right; margin-right:93px; position:relative; top:-12px;">
                            <select name="customer_credit_card_type" id="customer_credit_card_type" style="height:28px;">
                            <option value=""></option>
                         		<option value="amex">American Express</option>
                                <option value="discover">Discover</option>
                            	<option value="mastercard">Master Card</option>
                                <option value="visa">Visa</option>
                            </select>
                            </span>
                        </td>
                    <tr>
                    	<td><span style="float: left; width: 97px; margin-left:-1px; position:relative; top:-9px;">Credit Card No : </span></td>
                        <td></td>
                        <td><input type="text" name="customer_credit_card_number" id="customer_credit_card_number" value=""  required="required"/></td>                         
                    </tr>                    
                	<tr>
                    	<td><span style="float: left; width: 97px; margin-left: -1px; position: relative; top: 10px;">Expiration Date : </span></td>
                        <td></td>
                        <td>
                        	<select name="cc_expiration_month" id="cc_expiration_month" style="width: 95px; position: relative; top: 10px; height:28px;">
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                                <option value="6">06</option>
                                <option value="7">07</option>
                                <option value="8">08</option>
                                <option value="9">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select name="cc_expiration_year" id="cc_expiration_year" style="width: 95px; margin-left: 10px; position: relative; top: 10px; height:28px;">
                            <?php $getyear=date("Y"); 
							for($i=$getyear; $i<=$getyear+20;$i++)
							{ ?>
                            	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                            </select>
                        </td>
						<select name="customer_country" id="customer_country" onchange="getstate(this.value)" style="display:none">
                            <option value="US">United States</option>
                            <option value="CA">Canada</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua And Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia And Herzegowina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, The Democratic Republic Of The</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote D'Ivoire</option>
                            <option value="HR">Croatia (Local Name: Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="TP">East Timor</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="FX">France, Metropolitan</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard And Mc Donald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran (Islamic Republic Of)</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>

                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic Of</option>
                            <option value="KR">Korea, Republic Of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">Macedonia, Former Yugoslav Republic Of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia</option>
                            <option value="MD">Moldova, Republic Of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts And Nevis</option>
                            <option value="LC">Saint Lucia</option>
                            <option value="VC">Saint Vincent And The Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome And Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia, South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre And Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard And Jan Mayen Islands</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic Of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad And Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks And Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis And Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="YU">Yugoslavia</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                    </select>
                        </td>
                    </tr>
                	<tr>
                    	<td><span style="float: left; width: 97px; margin-left:-1px; position: relative; top: 23px;">Security Code : </span></td>
                        <td></td>
                        <td><input type="text" name="cc_cvv2_number" id="cc_cvv2_number" value=""  required="required" style="position: relative; top: 23px;"/></td>
                    </tr>
                    <tr>
                        <!--<td><span style="float: left; width: 97px; margin-left:-1px; position: relative; top: 30px;">State : </span></td>-->
                        <td></td>
                        <td>
		                	<input type="hidden" name="customer_state" id="customer_state" value="840"  required="required" style="position: relative; top: 30px;"/>
                        </td>
                    </tr>
                    <tr>
                        <!--<td><span style="float: left; width: 97px; margin-left:-1px; position: relative; top: 40px;">Price : </span></td>-->
                        <td></td>
                        <td>
                        	<input type="hidden" name="example_payment_amuont" id="example_payment_amuont" value="" style="position:relative; top:40px;"/>
                        </td>
                    </tr>                    
                    <tr height="80">
                    	<td>&nbsp;</td>
                    	<td>
                        <input type="hidden" name="transid" id="transid" value="">
                    	<td>
                        <div id="transout" style="color:#F00; font-size:14px;">
                        </div></td>
                        <td>&nbsp;</td>
                    <td>
                        <div id="submitting">
                        	<input type="button" name="submit" value="Submit" id="last_sub" onClick="return payment();" class="baccc" style="margin-left:115px; position:relative; top:13px; float: right; color: rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(243, 131, 7);"/>
                            </div>
                        </td>
                    </tr>
                </table>
                       </li>
                        </ul>    
                        <div>
                        </div>
                     </div>
                    </form>  

                 </div><!--checkout_left-->

 
                <div class="checkout_right">
                <h5>   Your Checkout Progress</h5>
                
                   <div class="checkright_method"><a href="#">Billing Address</a>
                   </div>
                   <div class="billlisblog" id="sdiv1" style="display:none;padding:5px 0px 5px 20px">
                         <ul class="billlis">
                           <li>Sairam y</li>
                           <li>Vizag</li>
                           <li>Vizaag, Kenutiki, 55555</li>
                           <li>Unitedstates</li>
                           <li>Tel:999999</li>
                         </ul>
                       </div>
                   <!--checkright_method-->
                   <div class="checkright_method"><a href="#">Shipping Address</a>
                   </div>
                   <div class="billlisblog" id="sdiv2" style="display:none;padding:5px 0px 5px 20px">
                         <ul class="billlis">
                           <li>Sairam y</li>
                           <li>Vizag</li>
                           <li>Vizaag, Kenutiki, 55555</li>
                           <li>Unitedstates</li>
                           <li>Tel:999999</li>
                         </ul>
                       </div><!--checkright_method-->
                   <div class="checkright_method"><a href="#">Shipping Method</a>
                   </div>
                   <div class="billlisblog" id="sdiv3" style="display:none;padding:5px 0px 5px 20px">
                         <ul class="billlis">
                           <li>Sairam y</li>
                           <li>Vizag</li>
                           <li>Vizaag, Kenutiki, 55555</li>
                           <li>Unitedstates</li>
                           <li>T:999999</li>
                         </ul>
                    </div><!--checkright_method-->
                   <div class="checkright_method"><a href="#"> Order Review</a>
                   </div>
                   <div class="billlisblog" id="sdiv4" style="display:none; float: right; margin-right: 95px;padding:5px 0px 5px 20px">
                         <ul class="billlis">
                           <li>Sairam y</li>
                           <li>Vizag</li>
                           <li>Vizaag, Kenutiki, 55555</li>
                           <li>Unitedstates</li>
                           <li>T:999999</li>
                         </ul>
                    </div>
                   <!--checkright_method-->


                 </div><!--checkout_right-->
                   
               <div class="clear_fix"></div>
              
            </div><!--concomimg-->
         </div><!--site_container-->
       </div><!--innerpart-->
       
   
 
 
<script>
function payment(){
var a=true
	,b=c=d=e=false
	,bck="#9AC542"			//background color of headings
    ,text="#FFF"		//text color of headings
	,stime=300			//time out for sliding
	,btime=1000			//time out for button
	,backimg="url(<?php echo SITEURL; ?>/images/processing.gif) no-repeat"		//button background
	,bwid="105px"		//button width
	,bhit="23px"		//button height
	,bordr="0px"		//button border
	,btitle="Continue"	//button title
	,abwid=""			//after clicking width
	,abhit = ""			//after clicking height
	,abordr = ""		//after clicking border
	,abacolr= "#9AC542"	//after clicking background color
	,atitle = "Continue"//title after clicking
	,atcol = "#FFF";	//text color after clicking
		
	$("#last_sub").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");	
	$.ajax({url:"<?php echo SITEURL; ?>/paypal_check.php?customer_first_name="+$("#customer_first_name").val()
	+"&&customer_last_name="+$("#customer_last_name").val()
	+"&&customer_credit_card_type="+$("#customer_credit_card_type").val()
	+"&&customer_credit_card_number="+$("#customer_credit_card_number").val()
	+"&&cc_expiration_month="+$("#cc_expiration_month").val()
	+"&&cc_expiration_year="+$("#cc_expiration_year").val()
	+"&&cc_cvv2_number="+$("#cc_cvv2_number").val()
	+"&&customer_address1="+$("#customer_address1").val()
	+"&&customer_city="+$("#customer_city").val()
	+"&&customer_state="+$("#customer_state").val()
	+"&&customer_zip="+$("#customer_zip").val()
	+"&&customer_country="+$("#customer_country").val()
	+"&&example_payment_amuont="+$("#example_payment_amuont").val(),success:function(result){	
	if (result.indexOf("fail")>0){
		$("#transout").html("Transaction failed please check the details!");
		$("#last_sub").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);
	}
	else{
		$("#transid").val($.trim(result));
		$("#submitting").html('<input type="submit" name="submit" id="triggering" class="baccc" style="margin-left:115px; display:none; position:relative; top:13px;"/>');		
		$("#triggering").click();
	}	
	}});	
	
}
</script>
       <script>
	   function guest(){
		   $("#guest").css("display","block");
		   }
	   </script>
       
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php //include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  <?php include("includes/footer.php")?>