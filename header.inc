<?php

$description = theme_get_setting("site_description");

$fid = theme_get_setting('front_logo');
$file = file_load($fid);
$o = file_create_url($file->uri);
// If the filename contains the word tile, tile the background instead of centering it. 
$bgfile = theme_get_setting('background_logo_path');

if(strpos($bgfile,'-tile') !== false) {
	$whichheader = "";
	$background = "#3671b6 url(" . file_create_url($bgfile) . ") center center;";
	$bgsize = "auto;"; 
} else {
	$whichheader = "-inner .wrap-inner ";
	$background = "#3671b6 url(" . file_create_url($bgfile) . ") left center no-repeat;";
	$bgsize = "cover;"; 
}

$fp = variable_get('site_frontpage', 'node');
?>
<style type="text/css">
	#header { 
		background: #3671b6; 
	}
	#header<?php print $whichheader; ?> {
		background: <?php print $background; ?>;
		background-size: <?php print $bgsize; ?>;
	}
</style>
<header id="header">
	<div id="header-inner">
		<div class="wrap-inner section cf"> 
			<!-- start logo -->
			<h1 class="alignleft" id="logo">
			<a title="KENTUCKY" href="<?php echo $fp; ?>"><img title="KENTUCKY" alt="<?php echo theme_get_setting('front_logo_alt'); ?>" src="<?php print $o; ?>"></a>
			</h1>
			<!-- end logo -->
			<div class="head-right alignright">

				<div class="content">
					<p><?php print $description; ?></p>
				</div>

			</div>
		</div>
	</div>
</header>