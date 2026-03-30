<?php

/**
 * Implements hook_preprocess_page().
 */
function sauber_preprocess_page(&$variables){
  $variables['top_description'] = '';
  $variables['background_url'] = '';
  $variables['video'] = '';
  $variables['video_class'] = '';
  $style = 'top_image_width_870';

  //$default_node = node_load('67');
  $field = field_info_field('field_top_image');
  $default_file = file_load($field['settings']['default_image']);
  $variables['background_url'] = file_create_url($default_file->uri);
  
  if((arg(0) == 'node' ||  arg(0) == 'tech') && is_numeric(arg(1))){
  	$node = node_load(arg(1));
  	$description_items = field_get_items('node', $node, 'field_top_image_description');
  	$variables['top_description'] = ($description_items[0]['value'] != '') ? $description_items[0]['value'] : '';

  	$image_items = field_get_items('node', $node, 'field_top_image');
  	$image_uri = $image_items[0]['uri'];
    if ($node->type == 'product' || $node->type == 'device') {
      $style = 'top_image_width_870_light';
    }

  	$derivative_uri = image_style_path($style, $image_uri);
  	$success = file_exists($derivative_uri) || image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);
  	if ($success) {
      $background_url = file_create_url($derivative_uri);
      $variables['background_url'] = $background_url;
    }
    if($node->type == 'page'){
      if(isset($node->field_top_video[LANGUAGE_NONE][0])){
        $video_url = file_create_url($node->field_top_video[LANGUAGE_NONE][0]['uri']);
        $variables['video'] = '<video width="870" autoplay loop src="'.$video_url.'"></video>';
        $variables['video_class'] = 'background-video';
      }
    }
    //drupal_add_js('http://www.youtube.com/player_api', 'external');
  }
  else if(arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))){
    $term = taxonomy_term_load(arg(2));
    $image_items = field_get_items('taxonomy_term', $term, 'field_top_image');
    $image_uri = $image_items[0]['uri'];
    $derivative_uri = image_style_path($style, $image_uri);
    $success = file_exists($derivative_uri) || image_style_create_derivative(image_style_load($style), $image_uri, $derivative_uri);

    if ($success) {
      $background_url = file_create_url($derivative_uri);
      $variables['background_url'] = $background_url;
    } 
  }
  else{
    
  }

  if (!empty($variables['node']) && $variables['node']->type == 'technology') {
    $breadcrumbs = array();
    $breadcrumbs[] = l(t('Home'), '<front>'); 
    $breadcrumbs[] = l('Промышленный клининг', 'node/106'); 
    $breadcrumbs[] = $variables['node']->title;
    drupal_set_breadcrumb($breadcrumbs);
  }

  //
  if (!empty($variables['node']) && $variables['node']->type == 'page') {
    $tech_descs = db_select('field_data_field_technology_desc', 'f')->fields('f', array('field_technology_desc_nid', 'entity_id'))
          ->condition('f.bundle', 'technology')->condition('deleted', 0)->execute()->fetchAllKeyed();
    $nid = $variables['node']->nid;
    if (in_array($nid, array_keys($tech_descs))) {
      $parent_node = node_load($tech_descs[$nid]);
      $breadcrumbs = array();
      $breadcrumbs[] = l(t('Home'), '<front>'); 
      $breadcrumbs[] = l('Промышленный клининг', 'node/106'); 
      $breadcrumbs[] = l($parent_node->title, 'node/'.$parent_node->nid); 
      $breadcrumbs[] = $variables['node']->title;
      drupal_set_breadcrumb($breadcrumbs);
    }
  }
  
  if (!empty($variables['node']) && ($variables['node']->type == 'product' || $variables['node']->type == 'device' )) {
    $node = $variables['node'];
    // крошки
    $breadcrumbs = array();
    $breadcrumbs[] = l(t('Home'), '<front>'); 
    $breadcrumbs[] = l('Оборудование и материалы', 'oborudovanie-i-materialy'); 
    $nw = entity_metadata_wrapper('node', $node->nid); //dsm($nw->field_device_category->value());
    //Build breadcrumb based on the hierarchy of the term.
    $breadcrumb = array();
    
    if ($node->type == 'product') {
      $current = (object) array(
        'tid' => $nw->field_product_type[0]->value()->tid,
      );      
      $breadcrumb[] = l($nw->field_product_type[0]->value()->name, 'taxonomy/term/'.$nw->field_product_type[0]->value()->tid);
     
    } else {
      $current = (object) array(
        'tid' => $nw->field_device_category->value()->tid,
      );
      $breadcrumb[] = l($nw->field_device_category->value()->name, 'taxonomy/term/'.$nw->field_device_category->value()->tid);
     
    }

    while ($parents = taxonomy_get_parents($current->tid)) { 
      $current = array_shift($parents);
      $breadcrumb[] = l($current->name, 'taxonomy/term/' . $current->tid);
    }    
    
    $breadcrumbs = array_merge($breadcrumbs, array_reverse($breadcrumb));
    $breadcrumbs[] = $node->title;
    drupal_set_breadcrumb($breadcrumbs);
  }
  //если это мобильное устройство, то
  if(preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|bo‌​ost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
    $variables['is_mobile'] = TRUE;
  }
  else{
    $variables['is_mobile'] = FALSE;
  }

  // главное меню
  if (isset($variables['main_menu'])) {

    $menu_name = variable_get('menu_main_links_source', '');

    if ($menu_name) {
      $main_menu_tree = menu_tree($menu_name);
      $main_menu_tree['#attributes'] = array(
        'id' => 'main-menu-links',
        'class' => array('links', 'clearfix'),
      );
      //main-menu-links
      $variables['main_menu'] = render($main_menu_tree);
    } else {
       $variables['main_menu'] = FALSE;
    }
  }
  else {
    $variables['main_menu'] = FALSE;
  }
   drupal_add_js(drupal_get_path('theme', 'sauber') . '/js/cookie_consent.js', array('group' => JS_THEME, 'weight' => 99)); 
}


/**
 * Hide Author and date from search result pages.
 */



function sauber_preprocess_search_result(&$vars) {
  //delete user + date
  $vars['info'] = "";

  //delete user
  $vars['info'] = $vars['info_split']['date'];

  //delete date
  //$vars['info'] = $vars['info_split']['author'];
}


/**
 * Implements hook_preprocess_node().
 */
function sauber_preprocess_node(&$variables){
  $node_type_suggestion_key = array_search('node__' . $variables['type'], $variables['theme_hook_suggestions']);
  if ($node_type_suggestion_key !== FALSE) {
    $node_view_mode_suggestion = 'node__' . $variables['type'] . '__' . $variables['view_mode'];
    array_splice($variables['theme_hook_suggestions'], $node_type_suggestion_key + 1, 0, array($node_view_mode_suggestion));
  }

  //dsm($variables);
  if ($variables['type'] == 'product' || $variables['type'] == 'device'){
    
    drupal_add_library('slick', 'slick');
    drupal_add_js(path_to_theme() . '/js/product-slick.js');

    $variables['product_gallery'] = '';
    $product_gallery = '';
    $first_images = array();
    $second_images = array();
    $node_wrapper = entity_metadata_wrapper('node', $variables['nid']);
    //dsm($node_wrapper->field_product_image->value());
    //if(isset($variables['field_product_image']) && isset($variables['field_product_image'][LANGUAGE_NONE])){
    if ($node_wrapper->field_product_image->value()) {
      foreach ($node_wrapper->field_product_image->value() as $key => $image) { 
        $first_image_url = image_style_url("width_330_height_250", $image['uri']);
        $first_images[] = '<div class="gallery-first-item"><img src="'.$first_image_url.'" /></div>';

        $second_image_url = image_style_url("product_thumbnail", $image['uri']);
        $second_images[] = '<div class="gallery-second-item"><img src="'.$second_image_url.'" /></div>';

      }
      if(sizeof($second_images) > 1){
        $product_gallery = '
          <div class="first-images">'.implode('', $first_images).'</div>
          <div class="second-images">'.implode('', $second_images).'</div>
        ';
      }
      else{
        $product_gallery = '
          <div class="first-images">'.implode('', $first_images).'</div>
        ';
      }

      $variables['product_gallery'] = $product_gallery;

      $variables['medals'] = '';

      if($variables['view_mode'] == 'full'){
        if(isset($variables['field_product_medal'][0]['taxonomy_term'])){
          foreach ($variables['field_product_medal'] as $key => $medal) {
            $term = $medal['taxonomy_term'];
            $term_view = taxonomy_term_view($term);
            $variables['medals'] .= render($term_view['field_pruduct_medal_image']);
          }
        }
      }      
    }
  }  

  if ($variables['type'] == 'technology') {

    $breadcrumbs = array();
    $breadcrumbs[] = l(t('Home'), '<front>'); 
    $breadcrumbs[] = l('Промышленный клининг', 'node/106'); 
    $breadcrumbs[] = $variables['title'];
    drupal_set_breadcrumb($breadcrumbs);

  	$variables['content']['links']['node']['#links']['node-readmore']['title'] = "Читать подробнее";
  }
  
}

/**
 * Implements hook_theme().
 */
// function sauber_theme($existing, $type, $theme, $path) {
//   return array(
//     'menu_link__menu_devices_and_mats' => array(
//       'render element' => 'element',
//     ),
//   );
// }

/**
 *
 */
/*function sauber_menu_link__menu_devices_and_mats(array $variables) { dsm($variables);
  $element = $variables['element'];
  $sub_menu = $output = '';  

  if (!empty($element['#item_type']) && $element['#item_type'] == 'contacts') {
    return '<li>'.$element['#markup'].'</li>';
  }
  
  if(!empty($element['#below_render'])) {
    $sub_menu = '<div class="sub-menu-wrapper">'.$element['#below_render'].'</div>';
    $element['#localized_options']['#attributes']['html'] = TRUE;
    $element['#title'] .= '<span></span>';
  }
  
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);  

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";

}*/

/**
 * Preprocess function for theme_menu_link().
 */
/*function sauber_preprocess_menu_link(&$vars) { dsm($vars);
  $element = &$vars['element'];
  if ($element['#original_link']['menu_name'] == 'menu-devices-and-mats') {
    dsm($vars);
    if(!empty($element['#below_render'])) {
      $element['#title'] .= '<span></span>';
      $element['#localized_options']['attributes']['html'] = TRUE;
    }
  }
}*/


/**
 * Preprocess function for theme('media_youtube_video').
 */
function sauber_preprocess_media_youtube_video(&$variables) {
  
  if (!empty($variables['options']['attributes']['title']) && $variables['options']['attributes']['title'] != '') {
    $variables['title'] = $variables['options']['attributes']['title'];
  }
}