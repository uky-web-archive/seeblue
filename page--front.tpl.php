<?php 
/**
 * @file
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 * @see html.tpl.php
 */
$apath = $base_path . drupal_get_path('theme', 'seeblue');



//flag for whether we print horizontal or vertical menu
$is_horizontal = theme_get_setting('use_horizontal_menu');

$menu = menu_navigation_links('main-menu');

?>

<div class="wrap-top">

  <?php include_once("global_header.inc"); ?>

</div>

<div class="mobile-menu">

  <?php print drupal_render(menu_tree_output(menu_tree_all_data('main-menu'))); ?>

</div>

<div id="page-wrapper">
  
  <div id="page">

    <!-- start header -->
    <?php include('header.inc'); ?>

    <?php print render($page['header']); ?>
    <!-- end header --> 

    <!-- start content -->
    <div id="main-wrapper">

      <?php if ($page['showcase']): ?>

        <?php print render($page['showcase']); ?>

      <?php endif; ?>

	<?php if ($page['content_header'] || $is_horizontal == 1): ?>

      <div id="content-header">
      
		<?php if ($is_horizontal == 1): ?>
        
          <div class="region">
          
          <div class="block-menu" id="block-system-main-menu">
          
            <div class="content">
        
    		  <?php print drupal_render(menu_tree_output(menu_tree_all_data('main-menu'))); ?>
              
            </div>
          
          </div>
          
          </div>
        
        <?php endif; ?>
      
      <?php print render($page['content_header']); ?>

      </div>

    <?php endif; ?>

      <div id="main" class="wrap-inner cf">

        <section id="content" class="widecolumn alignright">

          <div class="content-list cf">

	    <div class="block site-messages"><?php print $messages;?></div>

            <?php print render($tabs); ?>
            <?php print render($page['homepage_content']); ?>

          </div>

        </section>

        <?php if ($page['sidebar_first']): ?>
        <!-- start first sidebar -->
        <aside id="sidebar-first" class="sidebar alignleft">

          <nav id="main-menu" class="main-nav">
          
			<?php if ($is_horizontal == 0): ?>
            
            <div class="region">
              
              <div class="block-menu" id="block-system-main-menu">
              
                <div class="content">
            
                  <?php print drupal_render(menu_tree_output(menu_tree_all_data('main-menu'))); ?>
                  
                </div>
              
              </div>
              
            </div>
            
            <?php endif; ?>
          
            <?php print render($page['sidebar_first']); ?>
            
          </nav>

        </aside>
        <!-- end first sidebar -->
        <?php endif; ?>

        <?php if ($page['sidebar_second']): ?>
        <!-- start second sidebar -->
        <aside id="sidebar-second" class="sidebar alignleft">

          <div class="newsblock cf">

            <?php print render($page['sidebar_second']); ?>

          </div>

        </aside>
        <!-- end second sidebar -->
        <?php endif; ?>

      </div>

    </div>
    <!-- end content -->


    <!-- start footer --> 
    <footer id="footer-wrapper">

      <div class="section">

        <div id="footer" class="wrap-inner">

          <div class="footer-top cf">

            <?php if ($page['footer_first_column']): ?>

              <?php print render($page['footer_first_column']); ?>

            <?php endif; ?>

            <?php if ($page['footer_second_column']): ?>

              <?php print render($page['footer_second_column']); ?>

            <?php endif; ?>

            <?php if ($page['footer_third_column']): ?>

              <?php print render($page['footer_third_column']); ?>

            <?php endif; ?>

          </div>

          <div class="footer-bottom cf">

            <?php if ($page['footer']): ?>
            
              <div class="alignleft">

                <?php print render($page['footer']); ?>

              </div>

            <?php endif; ?>

            <?php if ($page['footer_social_media']): ?>
            
              <div class="alignright">

                <?php print render($page['footer_social_media']); ?>

              </div>

            <?php endif; ?>

          </div>

          <div class="copyright cf">

            <a class="foot-logo alignleft" href="#" title="KENTUCKY">
              <img src="<?php print $apath; ?>/img/foot-logo1.png" alt="University of Kentucky">
            </a>

            <a class="foot-logo seeblue alignleft" href="http://seeblue.com" title="see blue.">
              <img src="<?php print $apath; ?>/img/seeblue.png" alt="see blue.">
            </a>

            <?php

            $text_url = '';

            if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
              $text_url .= 'https://';
            }
            else {
              $text_url .= 'http://';
            }
            $text_url .= $_SERVER['SERVER_NAME'];
            $text_url .= $_SERVER['REQUEST_URI'];

            ?>

            <div class="copytext alignright">

              &copy; University of Kentucky | Lexington, Kentucky 40506 | (859) 257-9000 | An Equal Opportunity University | <a href="#" title="Mission statement">Mission Statement</a> | <a href="http://assistive.usablenet.com/tt/<?php echo $text_url; ?>" title="Text only">Text Only</a>

            </div>

          </div>

        </div>

      </div>

    </footer> 
    <!-- end footer -->

  </div>

</div>
