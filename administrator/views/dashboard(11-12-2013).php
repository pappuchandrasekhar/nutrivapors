<?php 

include('includes/session.php');

include('includes/pageaccess.php');

$countusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='senior' or roletype='level1' ");

$countRegisterdusers=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_ADMIN,'user_id'," roletype='level2' ");

$countpages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_CONTENTPAGES,'page_id','');

$countimages=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_BANNERS,'id','');

$countproducts=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_STOREPRODUCTS,'spid','');

$countnewsevents=$userObj->getCountAllTablesDataCount(TPREFIX.TBL_NEWSEVENTS,'id','');

$recent=sitesettingsClass::gettenrecentActivitiesList(25);

?>

<div class="box">

    <div class="heading">

      <h1><img src="allfiles/home.png" alt=""> Dashboard</h1>

    </div>

    <div class="content"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top"><div class="overview" style="width:99%;">

          <table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">

		   <tr class="overview_heading">

    <td colspan="2"  align="left" valign="middle">Overview</td>

  </tr>

  <tr>

    <td  align="left" valign="middle"><label class="title">Last login</label></td>

    <td align="left" valign="middle"><?php echo date("l dS F Y, H:i:s A", $_SESSION['lastlogin']);?></td>

  </tr>

  <tr>

    <td align="left" valign="middle"><label class="title">Total admin users</label> </td>

    <td align="left" valign="middle"><?php echo $countusers;?></td>

  </tr>

  <tr>

    <td align="left" valign="middle"><label class="title">Total Registered users</label> </td>

    <td align="left" valign="middle"><?php echo $countRegisterdusers;?></td>

  </tr>

  <tr>

    <td align="left" valign="middle"><label class="title">Total Pages</label> </td>

    <td align="left" valign="middle"><?php echo $countpages;?></td>

  </tr>

  <?php /*?><tr>

    <td align="left" valign="middle"><label class="title">Total Banners</label> </td>

    <td align="left" valign="middle"><?php echo $countimages;?></td>

  </tr><?php */?>

  <tr>

    <td align="left" valign="middle"><label class="title">Total News</label> </td>

    <td align="left" valign="middle"><?php echo $countnewsevents;?></td>

  </tr>

  <tr>

    <td align="left" valign="middle"><label class="title">Total Products</label> </td>

    <td align="left" valign="middle"><?php echo $countproducts;?></td>

  </tr>

</table>

</div></td>

    <td rowspan="3" align="left" valign="top">

	<div class="overview" style="margin-left:10px;width:98%;">

	<table width="100%" border="0" cellspacing="2" cellpadding="2">

	<tr class="overview_heading">

	<td colspan="2"  align="left" valign="middle">Recent Activites / Errors</td>

	</tr>

	<tr>

	<td align="left" valign="top"></td>

	<td align="left" valign="top">

	<div style="width:560px;height:300px;overflow:auto; float:left;position:inherit;">

	<table style="width:538px;" border="0" cellspacing="2" cellpadding="2" align="left">

	<?php foreach($recent as $recentact)

	{

	if($recentact->type=="g")

	$tdstyle="class='greenerror'";

	else

	$tdstyle="class='rederror'";

	?>

	<tr>

	<td align="left" height="20" valign="top" <?php echo $tdstyle;?>><?php echo $recentact->matter?> </td>

	</tr>

	<?php 

	}

	?>

	</table>

	</div>

	</td>

	</tr>

	</table>

	</div>	

	  </td>

  </tr>

  <tr>

    <td valign="top" align="left">&nbsp;</td>

  </tr>

  <tr>

    <td width="50%" align="left" valign="top">

	<div class="overview" style="width:99%;">

          <table width="100%" border="0" align="left" cellpadding="2" cellspacing="2">

		   <tr class="overview_heading">

    <td colspan="2"  align="left" valign="middle">Panel shortcuts</td>

  </tr>

  <tr>

    <td  align="left" valign="middle" colspan="2">

	<div id="shortcuts" style="width:570px;">

	<ul>

	<li><a href="index.php?option=com_sitesettings"><img src="allfiles/settings.jpeg" alt="Settings"><span>Settings</span></a></li>

	<li><a href="index.php?option=com_dbbackup"><img src="allfiles/dbbackup.jpg" alt="DB Backup"><span>DB Backup</span></a></li>

	<li><a href="index.php?option=com_adminlist"><img src="allfiles/users.jpg" alt="Admin Users"><span>Admin Users</span></a></li>

	<li><a href="index.php?option=com_memberlist"><img src="allfiles/users.jpg" alt="Admin Users"><span>Front Users</span></a></li>

	<li><a href="index.php?option=com_pagelist"><img src="allfiles/pages.jpeg" alt="Pages"><span>Pages</span></a></li>

	<li><a href="index.php?option=com_bannerslist"><img src="allfiles/gallery.jpg" alt="Banners"><span>Backgrounds</span></a></li>

	<!--<li><a href="index.php?option=com_articlepost"><img src="allfiles/articles.jpg" alt="Articles"><span>Articles</span></a></li>

	<li><a href="index.php?option=com_blogpost"><img src="allfiles/blogimage.jpg" alt="Blog"><span>Blog</span></a></li>

	<li><a href="index.php?option=com_forumtopics"><img src="allfiles/forum.jpg" alt="Forum"><span>Forum</span></a></li>-->

	<li><a href="index.php?option=com_storeproducts"><img src="allfiles/store.jpg" alt="Store"><span>Store</span></a></li>

	<li><a href="index.php?option=com_subscribers"><img src="allfiles/newsletter.jpg" alt="Newsletter"><span>Newsletter</span></a></li>

	<li><a href="index.php?option=com_newseventslist"><img src="allfiles/newsevents.jpeg" alt="News"><span>News</span></a></li>

	</ul>

	</div>	</td>

  </tr>

</table>

</div></td>

    </tr>

</table>



    </div>

  </div>