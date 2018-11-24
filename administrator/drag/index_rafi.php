<?php require("db.php"); ?>

<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.7.1.custom.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){ 
						   
	$(function() {
		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {
			var order = $(this).sortable("serialize") + '&action=updateRecordsListings'; 
			$.post("updateDB.php", order, function(theResponse){
				$("#contentRight").html(theResponse);
			}); 															 
		}								  
		});
	});

});	
</script>

	
		<div id="contentLeft">
			<ul>
				<?php
				$query  = "SELECT * FROM tb_testimonial ORDER BY display_order ASC";
				$result = mysql_query($query) or die(mysql_error());
				
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				?>
					<li id="recordsArray_<?php echo $row['id']; ?>"><?php echo  $row['title']; ?></li>
				<?php } ?>
			</ul>
		</div>	

