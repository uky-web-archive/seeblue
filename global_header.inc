<?php
  $drupalpath = path_to_theme(); 
  
	try { 
		$data = json_decode(file_get_contents($drupalpath . "/top_nav.json"));
		
		if(!$data || !$data->global_links || !$data->meta_links) {
			$data = json_decode('{ "global_links" : [], "meta_links" : [] }');
			throw new Exception('JSON did not contain both global and meta links arrays. check top_nav.json file.'); 
		}
	}
	catch (Exception $e) {
		$data = json_decode('{ "global_links" : [], "meta_links" : [] }'); 

		drupal_set_message("A problem was detected with the top navigation json file. Please check top_nav.json at the root of this theme that it exists and it is a valid JSON format.",'error'); 
	}
	
?>
<style type="text/css">

#content p {
	font-size: <?php print theme_get_setting("site_font_size"); ?>px;
}

.block-menu .menu li a {
	font-size: <?php print theme_get_setting("sidebar_menu_font_size"); ?>px;
}

#content-header .block-menu > div > ul.menu > li > a {
	font-size: <?php print theme_get_setting("header_menu_font_size"); ?>px;
}

</style>
<div class="wrap-inner cf"> <a class="menulink alignleft" href="javascript:void(0);" title="Menu"><span>Menu</span><img src="<?php echo $apath; ?>/img/menulink-bg.png" alt="Menu" title="Menu" /></a>
  <ul class="topRightLink alignleft">
    <?php
      foreach ($data->global_links as $l)
      {
        $link = '<li>';
        $link .= '<a href="' . $l->href . '" title="' . $l->title . '">' . $l->text . '</a>';
        $link .= '</li>';
        echo $link;
      }
    ?>
  </ul>
  <form class="searchform alignright">
    <fieldset>
      <label class="alignleft">
        <input type="text" placeholder="search uky.edu"/>
      </label>
      <button class="alignleft" type="button">Search</button>
    </fieldset>
  </form>
  <ul class="top-link alignright">
    <?php
      foreach ($data->meta_links as $l)
      {
        $link = '<li>';
        $link .= '<a href="' . $l->href . '" title="' . $l->title . '">' . $l->text . '</a>';
        $link .= '</li>';
        echo $link;
      }
    ?>
  </ul>
</div>

<?php



?>
