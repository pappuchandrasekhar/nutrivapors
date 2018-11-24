<?php
echo 'hello';exit;
include "includes/header.php";
ini_set("display_errors",0);

//include("ups/ups-class.php");
echo $rate = $sitesettings->shippingamount;




?>

<li>
    <span style="float:left; width:300px; margin-top:-7px;">
        <input type="radio" name="shipmethod" class="shipmethcal" onClick="getrates(this.value);" value="UPS STANDARD (3-5 business days) <?php echo "$".$rate; ?>">
       <?php echo $sitesettings->shipping_method;?>
    </span>
    <span style="float:left; margin-left:50px; margin-top:-7px;">
        <?php
		if($rate){
			
            echo "$".$rate;		
		}
		else
		{
			echo "Sorry shipping not available";
		}
        ?>
    </span>
</li>

<?php /*?><li>
    <span style="float:left; width:300px; margin-top:-7px;">
        <input type="radio" name="shipmethod" class="shipmethcal" onClick="getrates(this.value);" value="UPS STANDARD (3-5 business days) <?php echo "$".$rate; ?>">
        UPS STANDARD (3-5 business days)
    </span>
    <span style="float:left; margin-left:50px; margin-top:-7px;">
        <?php
		if(is_numeric($rate)){
			
        	echo "$".$rate;
			
		}
		else
		{
			echo "Sorry shipping not available";
		}
        ?>
    </span>
</li>

<?php */?>