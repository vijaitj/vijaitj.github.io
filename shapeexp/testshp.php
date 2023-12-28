<!DOCTYPE html>
<html>
<head>
    <title>Shape Reconstruction Experiment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="skins/page.css" rel="stylesheet" />
    <!--<script src="jquery-3.2.1.min.js"></script>-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>
  <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="dist/sidenav.min.css" type="text/css">
    <style>#accordion { box-shadow:none; } p{margin:30px 0;}</style>
    <!-- 
<script>
    	
		$(function(){
			function getUrlParameter(name) {
			name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
			var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
			var results = regex.exec(location.search);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
			};
		
			if(getUrlParameter('case').length > 0 && getUrlParameter('user').length > 0 && getUrlParameter('set').length > 0)
			{
				var itmz =[1, 3, 6, 8, 10];
				$(".rig-img").each(function () {
					var cr_src = $(this).attr("src");
					var tmp = cr_src.split('/').splice(-2).join('/');
					var st = itmz[parseInt(getUrlParameter("set")) - 1];
   					$(this).attr("src", "ScreenCaptureStore/03_15_17_03_44_21_Set_"+ st.toString() + "_GD_" + getUrlParameter("user") + "_" + getUrlParameter("case") + "/" + tmp);
   				});
   			}

		});
	</script>
 -->
	
</head>
<body>
    <nav class="sidenav" data-sidenav data-sidenav-toggle="#sidenav-toggle">
    <div class="sidenav-brand">
      Menu
    </div>
    
<?php
$mn_usr = array("EP","VJ","ZG");
$mn_set = array("1","2","3","4","5");
$mn_case = array("Mono","Bino");
for($k = 0; $k < 2; $k++)
{
	if($k==0)
	{
		echo "<div class='sidenav-header'>Monocular";
		echo "<small>Results from the monocular experiment</small></div>";
	}
	else
	{
		echo "<div class='sidenav-header'>Binocular";
		echo "<small>Results from the binocular experiment</small></div>";
	}

	
	echo "<ul class='sidenav-menu'>";
	for($u_cnt = 0;$u_cnt < 3; $u_cnt++)
	{
		echo "<li>";
		echo "<a href='javascript:;' data-sidenav-dropdown-toggle class='active'>";
		echo "<span class='sidenav-link-icon'>";
		echo "<i class='material-icons'>assignment_ind</i>";
		echo "</span>";
		echo "<span class='sidenav-link-title'>User ".$mn_usr[$u_cnt]."</span>";
		echo"<span class='sidenav-dropdown-icon show' data-sidenav-dropdown-icon>";
		echo "<i class='material-icons'>arrow_drop_down</i>";
		echo "</span>";
		echo "<span class='sidenav-dropdown-icon' data-sidenav-dropdown-icon>";
		echo "<i class='material-icons'>arrow_drop_up</i>";
		echo "</span>";
		echo "</a>";
		echo "<ul class='sidenav-dropdown' data-sidenav-dropdown>";
		for($s_cnt = 0;$s_cnt < 5; $s_cnt++)
		{
			echo "<li><a href='testshp.php?case=".$mn_case[$k]."&user=".$mn_usr[$u_cnt]."&set=".$mn_set[$s_cnt]."'>";
			echo "<span class='sidenav-link-icon'>";
			echo "<i class='material-icons'>payment</i>";
			echo "</span>Set".$mn_set[$s_cnt]."</a></li>";
		}
		echo "</ul></li>";
	}
}


?>
  </nav>
<header>
  <a href="javascript:;" class="toggle" id="sidenav-toggle">
    <i class="material-icons">menu</i>
    <div class="mtext">Menu</div>
  </a>
  </header>
    <div id="content">
    	<ul id="rig">
    
    <?php
    
    if(strlen($_GET['case']) > 0 and strlen($_GET['user']) > 0 and strlen($_GET['set']) > 0)
    {
    	$itmz = array(1, 3, 6, 8, 10);
    	$usr = $_GET['user'];
    	$case = $_GET['case'];
    	$set = $itmz[intval($_GET['set']) - 1];	
    }
    else
    {
    	$usr = "VJ";
		$case = "Bino";
		$set = "3";
    }
    for ($cnt = 1; $cnt <= 18; $cnt++) 
    {
		$filename = "MetricDataStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$cnt."/metrics.txt";
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$elmz = explode(",", $lines[0]);
		//echo $elmz[0];
		echo "<li>";
		echo "<a class='rig-cell' href='test.php?user=".$usr."&case=".$case."&set=".$set."&shape=".$cnt."'>";
		echo "<img class='rig-img' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$cnt."/UserView_c.gif'>";
		echo "<span class='rig-overlay'></span>";
		echo "<span class='rig-text'>Click to choose this object <br> <br> Asymmetry: ".number_format((float)$elmz[0], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[1], 3, '.', '')."</span>";
		echo "</a></li>";
    }
	
	?>
        
</ul>
	</div>
	<div class="footer"></div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="dist/sidenav.min.js"></script>
<script>$('[data-sidenav]').sidenav();</script>
</body>
</html>
