<?php

/*
* Initialize theme settings
*/

$theme_key = 'seeblue201409';
if ( is_null( theme_get_setting( 'theme_initialized', $theme_key ) ) )
{
  //global $theme_key;
  /*
  * The default values for the theme variables. Make sure $defaults exactly
  * matches the $defaults in the theme-settings.php file.
  */

  $defaults = array(             // <-- change this array
    'background_logo_path'  => drupal_get_path('theme', $theme_key) . theme_get_setting('background_logo_path', $theme_key),
    'site_description' => " ",
    'front_logo' => seeblue201409_save_file( drupal_get_path('theme', $theme_key) . theme_get_setting("front_logo", $theme_key)),
    'interior_logo' => seeblue201409_save_file(drupal_get_path('theme', $theme_key) . theme_get_setting("interior_logo", $theme_key)),
    'theme_initialized' => true
  );

  // Get default theme settings.
  $settings = variable_get(str_replace('/', '_', 'theme_'. $theme_key .'_settings'), array());

  // Don't save the toggle_node_info_ variables.
  if (module_exists('node'))
  {
    //NOTE: node_get_types() is renamed to node_type_get_types() in Drupal 7
    foreach (node_type_get_types() as $type => $name)
    {
      unset($settings['toggle_node_info_' . $type]);
    }
  }

  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );

  // Force refresh of Drupal internals.
  //theme_get_setting('', TRUE);

  //Reset the theme_get_setting static cache, so initialized defaults are immediately rendered.
  drupal_static_reset('theme_get_setting');


}

/**
 *
 *	Preprocess each image used in the template.
 *
 *	@param &$variables - object containing the data used to build the markup for each image inserted into the document
 *
 *	@author Miles Briggs
 *
 */
function seeblue201409_preprocess_image(&$variables)
{
  $directories = array('slideshow', 'teaser_thumb', 'page_header');

  foreach ($directories as $d)
  {
    // if the image has the any image style defined in $directories applied to it, remove the height and width attributes to make it responsive
    if (strpos($variables['path'], $d) > 0)
    {
      unset($variables['height']);
      unset($variables['width']);
    }
  }
}

/**
 *
 *	Preprocess function for views.
 *
 *	@param &$variables - object containing the data used to build the markup for a view
 *
 *	@author Miles Briggs
 */
function seeblue201409_preprocess_views_view(&$variables)
{
  // if we have a slideshow view, add the appropriate scripts and stylesheets
  if ($variables['view']->human_name == "slideshow_output")
  {
    drupal_add_css(path_to_theme() . '/css/flexslider.css');
//    drupal_add_js('sites/all/themes/seeblue/js/responsiveslides.min.js');
  }
}

/**
 *
 *	Preprocess function for page.
 *
 *	@param &$variables - object containing the data used to build the markup for the page content
 *
 *	@author Miles Briggs
 *
 */
function seeblue201409_preprocess_page(&$variables)
{
  /**
   *	By default, drupal's main menu will only render as a single level, i.e., all child links are ignored.
   *	Because of that, we have to explicitly tell drupal we want the entire depth of the menu.
   */
  $main_menu_tree = menu_tree_all_data('main-menu');						//get the raw values for the entire menu object
  $variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);	//build a renderable array out of the menu data and store as a variable we can use in our page template
//	print_r($variables);
//	$variables['page']['content_header']['system_main-menu'] = $variables['page']['sidebar_first']['system_main-menu'];
}



/**
 *	Theme hook for drupal forms.
 *
 *	@author Miles Briggs
 *
 */
function seeblue201409_form_alter(&$form, &$form_state, $form_id)
{
  if ($form_id == 'search_block_form')		//hook the search form to modify some attributes
  {
    //add a placeholder for the search form text field (not included by default)
	$form['search_block_form']['#attributes']['placeholder'] = theme_get_setting('search_placeholder');//"Search this site";

	//change the submit field to use an image rather than a button
	$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/img/search-iconbg.png');
  }

}


/**
*Private theme function to create a file record
*/
function seeblue201409_save_file($uri)
{
  global $user;
  $uri = drupal_get_path('theme',$GLOBALS['theme']) . $uri;
  $filename = end((explode('/', $uri)));

  $file = new stdClass;
  $file->uid = $user->uid;
  $file->filename = $filename;
  $file->uri = $uri;
  $file->filemime = file_get_mimetype($uri);
  $file->filesize = filesize($uri);
  $file->status = 1;
  file_save($file);
  file_usage_add($file, $GLOBALS['theme'], 'user', '1');
  return $file->fid;
}
