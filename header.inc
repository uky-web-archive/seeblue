<?php

$description = theme_get_setting("site_description");




$fid = theme_get_setting('front_logo');
$file = file_load($fid);
$o = file_create_url($file->uri);

?>
<style type="text/css">
	#header-inner .wrap-inner {
		background: #3671b6 url(<?php print file_create_url(theme_get_setting('background_logo_path')); ?>) left center no-repeat;
		background-size: contain;
	}
</style>
<header id="header">
	<div id="header-inner">
		<div class="wrap-inner section cf"> 
			<!-- start logo -->
			<h1 class="alignleft" id="logo">
			<a title="KENTUCKY" href="/"><img title="KENTUCKY" alt="<?php echo theme_get_setting('front_logo_alt'); ?>" src="<?php print $o; ?>"></a>
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