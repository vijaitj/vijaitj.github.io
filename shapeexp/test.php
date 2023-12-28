<!DOCTYPE html>
<html>
<head>
    <title>Shape Reconstruction Experiment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="skins/page.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css">
  	<link rel='stylesheet' href='http://fonts.googleapis.com/icon?family=Material+Icons' type='text/css'>
  	<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel="stylesheet" type="text/css">
  	<link rel="stylesheet" href="dist/sidenav.min.css" type="text/css">
	
    <style>#accordion { box-shadow:none; } p{margin:30px 0;}</style>	
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
    
		<?php
	
		if(strlen($_GET['case']) > 0 and strlen($_GET['user']) > 0 and strlen($_GET['set']) > 0)
		{
			$itmz = array(1, 3, 6, 8, 10);
			$usr = $_GET['user'];
			$case = $_GET['case'];
			$shape = $_GET['shape'];
			$set = $_GET['set'];
		}
		else{
			$usr = "VJ";
			$case = "Bino";
			$shape = "1";
			$set = "3";
		}
	
		$filename = "MetricDataStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/metrics.txt";
		$lines = file($filename, FILE_IGNORE_NEW_LINES);
		$elmz = explode(",", $lines[0]);
		//echo $elmz[0];
		echo "<div class='view-img'>";
		echo "<ul>";
	
		echo "<li>";
		echo "<div class='col1top'><img  src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/UserView_c.gif''> </div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "User View <br> <br>User Shape vs Model Shape: ".number_format((float)$elmz[9], 3, '.', '')."<br>Real Shape vs Model Shape: ".number_format((float)$elmz[10], 3, '.', '')."<br>Real Shape vs User Shape: ".number_format((float)$elmz[11], 3, '.', '');
		echo "</div>";
		echo "</li>";
	
		echo "<li>";
		echo "<div class='col1top' style='display:none'><img  id ='anim1' class ='preload' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/Real.gif'> </div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "Real Object <br> <br>Asymmetry: ".number_format((float)$elmz[0], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[1], 3, '.', '')." <br> Modified Compactness: ".number_format((float)$elmz[2], 3, '.', '');
		echo "</div>";
		echo "</li>";
		if(rand(0, 1) == 0){
		echo "<li>";
		echo "<div class='col1top'><img  id ='anim2' class ='preload' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/User.gif'></div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "User Reconstructed Object <br> <br>Asymmetry: ".number_format((float)$elmz[3], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[4], 3, '.', '')." <br> Modified Compactness: ".number_format((float)$elmz[5], 3, '.', '');
		echo "</div>";
		echo "</li>";
	
		echo "<li>";
		echo "<div class='col1top'><img  id ='anim3' class ='preload' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/Model.gif'></div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "Model Reconstructed Object <br> <br>Asymmetry: ".number_format((float)$elmz[6], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[7], 3, '.', '')." <br> Modified Compactness: ".number_format((float)$elmz[8], 3, '.', '');
		echo "</div>";
		echo "</li>";
		}
		else{
		echo "<li>";
		echo "<div class='col1top'><img  id ='anim3' class ='preload' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/Model.gif'></div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "Model Reconstructed Object <br> <br>Asymmetry: ".number_format((float)$elmz[6], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[7], 3, '.', '')." <br> Modified Compactness: ".number_format((float)$elmz[8], 3, '.', '');
		echo "</div>";
		echo "</li>";
		
		echo "<li>";
		echo "<div class='col1top'><img  id ='anim2' class ='preload' src='ScreenCaptureStore/03_15_17_03_44_21_Set_".$set."_GD_".$usr."_".$case."/".$shape."/User.gif'></div>";
		echo "<div class='col1bot' style='display:none'>";
		echo "User Reconstructed Object <br> <br>Asymmetry: ".number_format((float)$elmz[3], 3, '.', '')." <br> Compactness: ".number_format((float)$elmz[4], 3, '.', '')." <br> Modified Compactness: ".number_format((float)$elmz[5], 3, '.', '');
		echo "</div>";
		echo "</li>";		
		}
	
		echo "</ul>";
		echo "</div>";
	
		?>
        
		</ul>
	</div>
	<div><input type="button" value="Show Info" id="ShowButton" ></div>
	<div class="footer"></div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="dist/sidenav.min.js"></script>
	<script type="text/javascript" src="js/vendor/imagesloaded.pkgd.js"></script>
	<script type="text/javascript" src="js/freezeframe.js"></script>
	<script>$('[data-sidenav]').sidenav();</script>
	
	<script>
		$(window).on('load',function() {
			var tmp = $('#anim3').attr('src');
			//$('#anim3').attr('src','');
			$('#anim3').attr('src',tmp);
			
			tmp = $('#anim2').attr('src');
			//$('#anim2').attr('src','');
			$('#anim2').attr('src',tmp);
			
			tmp = $('#anim1').attr('src');
			//$('#anim1').attr('src','');
			$('#anim1').attr('src',tmp);
			});
		$(function(){	
			// $("#anim1").on('load', function(){
// 				var a1 = new freezeframe("#anim1");
// 				a1.trigger();
// 				a1.release();
// 			});
// 			$("#anim2").on('load', function(){
// 				var a2 = new freezeframe("#anim2");
// 				a2.trigger();
// 				a2.release();
// 			});
// 			$("#anim3").on('load', function(){
// 				var a3 = new freezeframe("#anim3");
// 				a3.trigger();
// 				a3.release();
// 			});
// 			var imgz = new freezeframe('.preload');
			// var images = $(".view-img img");
// 			var loadedImgNum = 0;
// 			images.on('load', function(){
// 			  loadedImgNum += 1;
// 			  if (loadedImgNum == images.length) {
// 				$('.preload').attr('src', function(i,a){
// 				$(this).attr('src','').attr('src',a);
//  				});
// 			  }
// 			});
				$('#ShowButton').click(function(){
				   $('.col1bot').css('display','block');
				    $('.col1top').css('display','block');
				    var tmp = $('#anim3').attr('src');
					//$('#anim3').attr('src','');
					$('#anim3').attr('src',tmp);
			
					tmp = $('#anim2').attr('src');
					//$('#anim2').attr('src','');
					$('#anim2').attr('src',tmp);
			
					tmp = $('#anim1').attr('src');
					//$('#anim1').attr('src','');
					$('#anim1').attr('src',tmp);
				});
				
		});
	</script>
</body>
</html>
