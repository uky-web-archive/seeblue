<?php

/**
 *
 *  @function seeblue_form_system_theme_settings_alter - implements a hook for the seeblue theme settings - adds additional fields and rearranges existing fields for consistency
 *
 *  @param &$form - array that contains all the data necessary to generate the theme settings form. Passed by reference.
 *  @param $form_state - array that describes the current state of the form (e.g., any edits, updates, deletions, etc...)
 *
 *  @author Miles Briggs
 *
 */
function seeblue_form_system_theme_settings_alter(&$form, $form_state)
{
	
  

  
  // The "appearance" dialog is not necessarily called from this theme, so path_to_theme does not work.  
  $theme_path = drupal_get_path('theme', 'seeblue');  
  $file_path = $GLOBALS['base_path'] . $theme_path; 
  
  unset($form['theme_settings']);
	
	//change the title and description of the existing logo field
	$form['logo']['#title'] = t('Header settings');
	$form['logo']['#description'] = t('Use these fields to customize the header of your theme.');

	//grab the logo path and upload fields so we can unset some fields and add them back afterwards
	$lp = $form['logo']['settings']['logo_path'];
	$lu = $form['logo']['settings']['logo_upload'];

	//unset the conditional fields for providing a default logo - not necessary for this theme
	unset($form['logo']['default_logo']);
	unset($form['logo']['settings']);

	//add the logo upload and path fields back into the updated form object
	// $form['logo']['logo_path'] = $lp;
	// $form['logo']['logo_upload'] = $lu;
  




  //create an additional field for the site description
  $form['logo']['site_description'] = array(
    '#type'        => 'textarea',
    '#title'      => t('Header text'),
    '#default_value'  => theme_get_setting('site_description'),
    '#description'    => t("This field contains the description text that will be rendered in the header of the site."),
    '#weight'      => -20
  );




	//go ahead and generate the path for the default background logo as specified in seeblue.info
	$logo_path = theme_get_setting('background_logo_path');
    
    if (file_uri_scheme($logo_path) == 'public')
    {
    	$logo_path = file_uri_target($logo_path);
    }

    //create a field for the background logo path
	$form['logo']['background_logo_path'] = array(
			'#type'				=> 'hidden',
			'#default_value'	=> theme_get_setting('background_logo_path'),
			'#value'			=> theme_get_setting('background_logo_path')
	);

  
  $form['logo']['background_logo_select'] = array(
      '#type'        => 'select',
      '#title'      => t('Header Background'),
      '#options'      => array(
        $file_path . '/img/header-bg.png' => t('UK Logo'),
        $file_path . '/img/header-bg-2.png' => t('Main Building'),
		$file_path . '/img/hbg/seeblue.png' => t('SeeBlue Logo'),
		$file_path . '/img/hbg/seeblue-tile.png' => t('SeeBlue Tile'),
		$file_path . '/img/hbg/uk-tile' => t('UK Tile'),
      ),
      '#default_value'  => theme_get_setting('background_logo_select')
  );


  $form['logo']['header_background_image'] = array(
    '#type' 				=> 'managed_file',
    '#title'				=> t('Image to use on background of homepage.'),
    '#required'				=> FALSE,
    '#upload_location'		=> file_default_scheme() . '://theme/logos/',
    '#description'			=> t('If you would rather use a custom image instead of the pre-defined list of options above, use this field to upload one. If there is an image in this field it will overwrite the predefined options. Images must be 970 x 170 pixels.'),
    '#default_value'		=> theme_get_setting('header_background_image'),
    '#upload_validators'	=> array(
      'file_validate_extensions'		=> array('gif png jpg jpeg'),
    ),

  );
  
    $form['logo']['front_logo'] = array(
        '#type' 				=> 'managed_file',
        '#title'				=> t('Logo to use on homepage'),
        '#required'				=> FALSE,
        '#upload_location'		=> file_default_scheme() . '://theme/logos/',
		'#description'			=> t('This field will hold the image to be used as the logo on the homepage.'),
        '#default_value'		=> theme_get_setting('front_logo'),
        '#upload_validators'	=> array(
            'file_validate_extensions'		=> array('gif png jpg jpeg'),
        ),

    );

	$form['logo']['front_logo_alt'] = array(
		'#type'					=> 'textfield',
		'#title'				=> t('Alt text to use for homepage logo'),
		'#default_value'		=> theme_get_setting('front_logo_alt'),
		'#description'			=> t('Alt text to use for homepage logo. Necessary for search engines, screen readers, and accessibility.'),
		'#size'					=> 60,
		'#maxlength'			=> 256
	);



    $form['logo']['interior_logo'] = array(
        '#type' 				=> 'managed_file',
        '#title'				=> t('Logo to use on interior pages'),
        '#required'				=> FALSE,
        '#upload_location'		=> file_default_scheme() . '://theme/logos/',
        '#default_value'		=> theme_get_setting('interior_logo'),
		'#description'			=> t('This field will hold the image to be used as the logo on interior pages.'),
        '#upload_validators'	=> array(
            'file_validate_extensions'		=> array('gif png jpg jpeg'),
        ),

    );
	
	$form['logo']['interior_logo_alt'] = array(
		'#type'					=> 'textfield',
		'#title'				=> t('Alt text to use for logo'),
		'#default_value'		=> theme_get_setting('interior_logo_alt'),
		'#description'			=> t('Alt text to use for interior logo. Necessary for search engines, screen readers, and accessibility.'),
		'#size'					=> 60,
		'#maxlength'			=> 256
	);
  
  
  $form['logo']['use_horizontal_menu'] = array(
      '#type'        => 'checkbox',
      '#title'      => t("Use horizontal menu"),
      '#default_value'  => '0'
  );
  
  $form['logo']['use_horizontal_menu'] = array(
      '#type'        => 'select',
      '#title'      => t('Use Horizontal Menu'),
      '#options'      => array(
        '1' => t('Yes'),
        '0' => t('No'),
      ),
      '#default_value'  => theme_get_setting('use_horizontal_menu')
  );
  
  
  
  
  //create a text field to store the search form placeholder text
  $form['search_settings']['search_placeholder'] = array(
      '#type'        => 'textfield',
      '#title'      => t('Search form placeholder'),
      '#default_value'  => theme_get_setting('search_placeholder'),
      '#size'        => 60,
      '#maxlength'    => 128,
      '#required'     => FALSE,
      '#description'    => t('Placeholder in text field of search form.'),
  );
  
  
  
  $form['typo_settings']['header_menu_font_size'] = array(
      '#type' => 'select',
      '#title' => t('Header Menu Font Size'),
       '#description' => t('Font Size to be used in main menu in Header region'),
      '#default_value' => theme_get_setting('header_menu_font_size'),
      '#options' => array(
      '11' => t('11'),
      '12' => t('12'),
      '13' => t('13'),
      '14' => t('14 (default)'),
      '15' => t('15'),
    '16' => t('16'),
    '17' => t('17'),
    '18' => t('18'),
    '19' => t('19'),
    '20' => t('20'),
    '21' => t('21'),
    '22' => t('22'),  
    '23' => t('23'),  
    '24' => t('24'),  
    ),
  );
  
  
  $form['typo_settings']['sidebar_menu_font_size'] = array(
      '#type' => 'select',
      '#title' => t('Sidebar Menu Font Size'),
       '#description' => t('Font Size to be used in main menu in Sidebar region'),
      '#default_value' => theme_get_setting('sidebar_menu_font_size'),
      '#options' => array(
      '11' => t('11'),
      '12' => t('12'),
      '13' => t('13'),
      '14' => t('14'),
      '15' => t('15'),
    '16' => t('16 (default)'),
    '17' => t('17'),
    '18' => t('18'),
    '19' => t('19'),
    '20' => t('20'),
    '21' => t('21'),
    '22' => t('22'),  
    '23' => t('23'),  
    '24' => t('24'),  
    ),
  );
  
  
  $form['theme_settings_tab']['typo_settings']['site_font_size'] = array(
    '#type' => 'select',
    '#title' => t('Sitewide text\'s font size'),
    '#description' => t('Font Size to be used site wide'),
    '#default_value' => theme_get_setting('site_font_size'),
    '#options' => array(
    '10' => t('10'),
    '11' => t('11'),
    '12' => t('12'),
    '13' => t('13'),
    '14' => t('14 (default)'),
    '15' => t('15'),
    '16' => t('16'),
    '17' => t('17'),
    '18' => t('18'),
    '19' => t('19'),
    '20' => t('20'),
    ),
  );


  //add a submit handler for the theme settings form
  $form['#submit'][] = 'seeblue_settings_submit';

}



/**
 *
 *  @function seeblue_settings_submit - submit handler for theme settings form
 *
 *  @param $form - object that contains all the data for the theme settings form
 *  @param $form_state - array that describes the current state of the form (e.g., any edits, updates, deletions, etc...). Passed by reference.
 *
 *  @author Miles Briggs
 */
function seeblue_settings_submit($form, &$form_state)
{
//	drupal_set_message(print_r($form_state, 1));
	
	$form_state['values']['background_logo_path'] = $form_state['values']['background_logo_select'];

 // die(var_dump($form_state['values']['front_logo']));

    if ($form_state['values']['interior_logo'] != 0)
    {
        $f = file_load($form_state['values']['interior_logo']);
        $f->status = FILE_STATUS_PERMANENT;
        file_save($f);
		file_usage_add($f, 'user', 'user', 0);

        variable_set('interior_logo', $f->uri);
    }
	
	if ($form_state['values']['front_logo'] != 0)
	{
        $f = file_load($form_state['values']['front_logo']);
        $f->status = FILE_STATUS_PERMANENT;
        file_save($f);
		file_usage_add($f, 'user', 'user', 0);

        variable_set('front_logo', $f->uri);
	}

  if ($form_state['values']['header_background_image'] != 0)
  {
    $f = file_load($form_state['values']['header_background_image']);
    $f->status = FILE_STATUS_PERMANENT;
    file_save($f);
    file_usage_add($f, 'user', 'user', 0);

    variable_set('header_background_image', $f->uri);

    drupal_set_message(file_validate_image_resolution($f, '970x170', '969x169'));
  }
  
}



