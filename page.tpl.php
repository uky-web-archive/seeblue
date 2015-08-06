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

  /**
  * Boolean toggle for whether or not we should print the right sidebar. If either left sidebar is output, we'll ignore the right sidebar.
  */

$apath = base_path( ) . drupal_get_path('theme', variable_get('theme_default', NULL));

  $is_sidebar = FALSE;
  if ($page['sidebar_first'] || $page['sidebar_second'])
  {
    $is_sidebar = TRUE;
  }


  //
  $is_horizontal = theme_get_setting('use_horizontal_menu');

  $menu = menu_navigation_links('main-menu');

  ?>

  <div class="wrap-top" role="menubar">

    <?php include_once("global_header.inc"); ?>

  </div>

  <div class="mobile-menu"  role="navigation">
    <?php $main_menu =  menu_tree_output(menu_tree_page_data('main-menu')); ?>
    <?php print drupal_render($main_menu); ?>

  </div>

  <div id="page-wrapper">

    <div id="page">

      <!-- determine layout type -->
      <?php

        $layout = "single-column";
        if (!empty($page['sidebar_first']) || !empty($page['sidebar_second'])){
          $layout = "two-column";
        }

      ?>

      <!-- start content -->
      <div id="main-wrapper" class="<?php echo $layout; ?>">

      <?php if ($page['content_header'] || $is_horizontal == 1): ?>

        <div id="content-header">

        <?php if ($is_horizontal == 1): ?>

          <div class="region">

            <div class="block-menu" id="block-system-main-menu">

              <div class="content">

                <?php $main_menu =  menu_tree_output(menu_tree_page_data('main-menu')); ?>
                <?php print drupal_render($main_menu); ?>

              </div>

            </div>

          </div>

        <?php endif; ?>

        <?php print render($page['content_header']); ?>

        </div>

      <?php endif; ?>

        <?php
        $fid = theme_get_setting('interior_logo');
        $file = file_load($fid);
        $o = file_create_url($file->uri);
        ?>

        <div id="mobile-interior-logo" class="alignleft">

          <a href="<?php echo $front_page; ?>"><img src="<?php echo $o; ?>" alt="<?php echo $site_name; ?>" class="logo-interior"/></a>

        </div>

        <div id="main" class="wrap-inner cf">

          <div class="sidebar sidebar-left">
            <div  id="interior-logo">
              <a href="<?php echo $front_page; ?>"><img src="<?php echo $o; ?>" alt="<?php echo $site_name; ?>" class="logo-interior"/></a>
            </div>
            <?php if ($is_horizontal == 0): ?>

             <nav id="main-menu" class="main-nav" role="navigation">

               <div class="region">

                 <div class="block-menu" id="block-system-main-menu">

                   <div class="content">

                       <?php $tree_output = menu_tree_output(menu_tree_page_data('main-menu')); ?>
                       <?php print drupal_render($tree_output); ?>

                   </div>

                 </div>

               </div>

             </nav>
           <?php endif; ?>



          </div>

          <main role="main" id="content" class="widecolumn alignright">

            <div class="content-list cf">

              <div class="block site-messages"><?php print $messages;?></div>
                <?php print render($tabs); ?>
              <header>
                <?php print render($title_prefix); ?>
                  <?php if ($title): ?>
                    <h1 class="title page-header" id="page-title" role="heading">
                      <?php print $title; ?>
                    </h1>
                  <?php endif; ?>
                <?php print render($title_suffix); ?>
              </header>


              <?php print render($page['content']); ?>

            </div>
          </main>

          <aside role="complementary" class="sidebar sidebar-pull-left">
            <?php print render($page['sidebar_first']); ?>
            <?php print render($page['sidebar_second']); ?>
          </aside>

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
            <?php $apath = base_path( ) . drupal_get_path('theme', variable_get('theme_default', NULL)); ?>

            <a class="foot-logo alignleft" href="http://www.uky.edu" title="KENTUCKY">
              <img src="<?php print $apath; ?>/img/foot-logo1.png" alt="University of Kentucky">
            </a>

            <a class="foot-logo seeblue alignleft" href="http://seeblue.com" title="see blue.">
              <img src="<?php print $apath; ?>/img/seeblue.png" alt="see blue.">
            </a>

            <div role="contentinfo" class="copytext alignright">

              &copy; University of Kentucky | Lexington, Kentucky 40506 | (859) 257-9000 <br/> An Equal Opportunity University | <a href="http://www.uky.edu/Provost/strategic_planning/mission.htm" title="Mission statement">Mission Statement</a>

            </div>




          </div>

        </div>

      </footer>
      <!-- end footer -->

    </div>

  </div>
