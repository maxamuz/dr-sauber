<?php
/**
 * @file
 * Zen theme's implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
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
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $secondary_menu_heading: The title of the menu used by the secondary links.
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
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 * - $page['bottom']: Items to appear at the bottom of the page below the footer.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see zen_preprocess_page()
 * @see template_process()
 */
?>

   <div class="header-box">
   <div class="header">
   
   <?php if ($logo): ?>
      <a class="logo" href="<?php print $front_page; ?>" title="Очистка сухим льдом промышленного оборудования" rel="home"><img src="<?php print $logo; ?>" alt="Очистка сухим льдом промышленного оборудования" /></a>
   <?php endif; ?>	
   <div class="menu">
   <?php
      $menu = menu_tree('menu-top-menu');
      echo render($menu);
   ?>
   </div>
    <div class="phones">
   <?php
      $block = module_invoke('block', 'block_view', 1);
      print render($block['content']);
   ?>   
   <div class="form-callback">
	  <?php
      $block = module_invoke('block', 'block_view', 21);
      print render($block['content']);
      ?>   
	  </div>
    </div>	  
	  <div class="clr"></div>
	  
	  <div class="top-menu">
  <?php
     //$menu = menu_tree('main-menu');
    // echo render($menu);
   ?>
   </div>
	  
   </div>
   </div>
   
<?php
  if (drupal_is_front_page()) { ?>
  <div class="slider-box"> 
    	  <div id="slider" class="nivoSlider">
        <a href="/content/elektroenergetika" id="x0"><img src="/sites/all/themes/sitemade/img/slide1.jpg" alt="" title="Электроэнергетика" /></a> 
        <a href="/content/metallurgiya" id="x1"><img src="/sites/all/themes/sitemade/img/slide2.jpg" alt="" title="Металлургия" /></a> 
		<a href="/content/pechatnoe-proizvodstvo" id="x2"><img src="/sites/all/themes/sitemade/img/slide3.jpg" alt="" title="печатное производство" /></a> 
		<a href="/content/pishchevaya-promyshlennost" id="x3"><img src="/sites/all/themes/sitemade/img/slide4-1.jpg" alt="" title="пищевая промышленность" /></a> 
		<a href="/content/proizvodstvo-izdeliy-iz-plastmass" id="x4"><img src="/sites/all/themes/sitemade/img/slide8.jpg" alt="" title="изделия из пластика" /></a> 
		<a href="/content/remontnye-raboty" id="x5"><img src="/sites/all/themes/sitemade/img/slide6.jpg" alt="" title="Производство и ремонт" /></a> 
		<a href="/content/proizvodstvo-avtomobilnyh-shin-i-rti" id="x6"><img src="/sites/all/themes/sitemade/img/slide7.jpg" alt="" title="шины" /></a> 
		<a href="/content/avto-avia-zhd-i-sudostroenie" id="x7"><img src="/sites/all/themes/sitemade/img/slide8.jpg" alt="" title="транспорт" /></a> 
		<a href="/himicheskaya-promyshlennost" id="x8"><img src="/sites/all/themes/sitemade/img/slide9.jpg" alt="" title="химия" /></a> 
	  </div>
	  <script type="text/javascript">
          $(window).load(function() {
               $('#slider').nivoSlider({
    effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
    slices: 15,                     // For slice animations
    boxCols: 8,                     // For box animations
    boxRows: 4,                     // For box animations
    animSpeed: 0,                 // Slide transition speed
    pauseTime: 3000,                // How long each slide will show
    startSlide: 0,                  // Set starting Slide (0 index)
    directionNav: false,             // Next & Prev navigation
    controlNav: true,               // 1,2,3... navigation
    controlNavThumbs: false,        // Use thumbnails for Control Nav
    pauseOnHover: true,             // Stop animation while hovering
    manualAdvance: false,           // Force manual transitions    
    randomStart: false,             // Start on a random slide   
});
          
		  
		  });

		
</script> 
</div>
  <?php }else{ ?>  
  <div class="no-slider-box"> <?php print $breadcrumb; ?></div>
  <?php } ?>
   
  
   <div class="content-box <?php if (drupal_is_front_page()) { ?><?php }else{ ?>add-bg<?php } ?> ">
      <div class="content">
	  <?php print render($page['highlighted']); ?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if ($title): ?>
        <h1 class="title" id="page-title"><?php print $title; ?></h1>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if ($tabs = render($tabs)): ?>
        <div class="tabs"><?php print $tabs; ?></div>
      <?php endif; ?>
      <?php print render($page['help']); ?>
      <?php if ($action_links): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>
      <?php print $feed_icons; ?>
	  <div style="clear:both;"></div>
	  </div>	 

   </div>


 <div class="footer-box">
      <div class="footer">
	  <div class="block1 block">
		    <?php
$block = block_load('block', '2');
$render_block = _block_get_renderable_array(_block_render_blocks(array($block)));
$output = drupal_render($render_block);
print $output;
?>
			<div class="clr"></div>
		 </div>
	  
	  <div class="block2 block">
	     <?php
$block = block_load('views', 'news-block');
$render_block = _block_get_renderable_array(_block_render_blocks(array($block)));
$output = drupal_render($render_block);
print $output;
?>
<div class="clr"></div>
	  </div>
	  <div class="block3 block">
	     <h2>Поиск по сайту</h2>
		 
<?php
$block = module_invoke('search', 'block_view');
print render($block['content']);
?>
  <div class="footerphone"> 
 <h2>Наши представительства:</h2>
<p><div class="phoneright">+7 (499) 501-00-01</div>Москва </p>
<p><div class="phoneright">+7 (911) 111-13-33</div>Санкт-Петербург </p>
<p><div class="phoneright">+7 (8442) 50-15-79</div>Волгоград </p>
<p><div class="phoneright">+7 (8452) 46-28-68</div>Саратов </p>
<p></p>
<p><div class="phoneright"><a href="mailto:info@dr-sauber.ru">info@dr-sauber.ru</a></div>E-mail: </p>
</div>
		 
		 <img src="/sites/all/themes/sitemade/img/logo-footer.jpg" class="logo-footer" width="120px" height="58px" alt="Очистка сухим льдом" title="Очистка сухим льдом"/>
		 <div class="clr"></div>
		 <div class="copy">©2015 Dr. Sauber.<br /> чистка сухим льдом
</div>
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 947291903;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script><script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script><noscript>
<div style="display:inline;">
<img height="0" width="0" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/947291903/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
		
	  </div>	 
	  <div class="clr"></div>

	  




	  
	  </div>
   </div>
    <?php /*if ($page['navigation'] || $main_menu): ?>
      <div id="navigation"><div class="section clearfix">

       

        <?php print render($page['navigation']); ?>

      </div></div><!-- /.section, /#navigation -->
    <?php endif; ?>

    <?php print render($page['sidebar_first']); ?>

    <?php print render($page['sidebar_second']); ?>

  </div></div><!-- /#main, /#main-wrapper -->

  <?php print render($page['footer']); ?>

</div></div><!-- /#page, /#page-wrapper -->

<div class="push"></div>
<div class="bottom-page">
  <div class="bottom-left"></div>
  <div class="bottom-right"></div>
	<div class="bottom-inner">
		<?php print render($page['bottom']); ?>
	</div>
</div>*/ ?>
