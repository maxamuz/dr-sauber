<div id="container">
	<header>
    	<div id="open-menu"></div>
		<?php if ($logo): ?>
      		<a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        	<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></a>
    	<?php endif; ?>
        <a href="/ctmodal/nojs/search" class="ctools-use-modal ctools-modal-catalog-style search-link" id="mobile-search"></a>
		  <?php print render($page['header']); ?>
        <nav id="main-menu" class="navigation">
          <?php print $main_menu ?>
		    </nav> <!-- /#main-menu -->
	</header>
    <aside><?php print render($page['left']); ?></aside>
    <article>
      <?php if(!$is_front): ?> 
        <div id="top-bg" style="background: url(<?php print $background_url; ?>) no-repeat center center;" class="<?php print $video_class; ?>">
          <?php print $video; ?>      	
          <div class="content">
          	<?php if(!$is_front) { print $breadcrumb; } ?>
          	<h1 class="title" id="page-title"><?php print $title; ?></h1>
              <?php print $top_description; ?>
          </div>       
        </div>
      <?php else: ?>
        <?php if ($page['slider']) { print render($page['slider']); } ?>  
      <?php endif; ?>
      
      <?php print $messages; ?>
      <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?> 
	  <?php print render($page['help']); ?>
	  <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
      <?php print render($page['content']); ?>
	</article>		
</div>
<footer><?php print render($page['footer']); ?></footer>