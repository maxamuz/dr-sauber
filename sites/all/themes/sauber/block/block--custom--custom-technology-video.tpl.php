<?php
/**
 * @file
 * Тема для блока custom_technology_video.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content. Это будет содержать поле field_technology_video.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through CSS.
 * - $title_prefix (array): An array containing additional output populated by modules,
 *   intended to be displayed in front of the main title tag that appears in the template.
 * - $title_suffix (array): An array containing additional output populated by modules,
 *   intended to be displayed after the main title tag that appears in the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same counter as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current viewer is a logged-in member.
 * - $is_admin: Flags true when the current viewer is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <h2<?php print $title_attributes; ?>><?php print $block->subject ?></h2>
  <?php endif;?>
  <?php print render($title_suffix); ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
    // Проверяем, что содержимое блока не пусто
    if ($content) {
      // Получаем текущий узел, чтобы получить его поля
      $node = menu_get_object();

      // Проверяем, что узел существует и у него есть нужное поле
      if ($node && isset($node->field_technology_video)) {
        // Получаем элементы поля
        $field_items = field_get_items('node', $node, 'field_technology_video');

        if ($field_items) {
          // Берём первый файл (предполагаем, что их может быть только один)
          $file_item = $field_items[0];
          $file = (object) $file_item;

          // Проверяем MIME-тип файла
          if ($file->filemime == 'video/mp4') { // Можно добавить другие типы, если нужно
            $file_url = file_create_url($file->uri);

            // Выводим HTML5 тег video
            print '<video controls muted width="100%" height="auto" preload="metadata">
                     <source src="' . check_url($file_url) . '" type="video/mp4">
                     Ваш браузер не поддерживает тег video.
                   </video>';
          } else {
            // Если файл не MP4, можно вывести стандартное сообщение или ничего
            // print "Формат видео не поддерживается.";
            // Или вывести оригинальное содержимое, если оно не MP4
            print $content;
          }
        } else {
          // Поле пустое или не содержит файлов
          // print "Видео не загружено.";
          print $content; // Выводим оригинальное содержимое, если поле пустое
        }
      } else {
        // Не удаётся получить узел или поле отсутствует на этом узле
        // print "Не удалось получить видео.";
        print $content; // Выводим оригинальное содержимое в случае ошибки
      }
    } else {
      // Если $content пуст (хотя обычно не бывает для блока с полем)
      print $content;
    }
    ?>
  </div>
</div>