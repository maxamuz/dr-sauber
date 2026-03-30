// (function ($) {
//   'use strict';

//   Drupal.behaviors.myWebformValidationSimple = {
//     attach: function (context, settings) {
//       // Ищем кнопку отправки *внутри* контекста
//       // Это работает как при начальной загрузке, так и при AJAX-обновлениях
//       var $submitBtn = $('input[type="submit"].webform-submit.form-submit', context);
//       // Попробуем также найти по ID, если класс не сработает
//       if ($submitBtn.length === 0) {
//           $submitBtn = $('#edit-webform-ajax-submit-173', context);
//       }

//       // Проверим, найдена ли кнопка в текущем контексте
//       if ($submitBtn.length > 0) {
//         console.log('Drupal.behaviors: Кнопка отправки найдена в контексте.');

//         // Проверим, привязан ли обработчик уже к этой кнопке, чтобы избежать дублирования
//         if (!$submitBtn.data('myClickHandlerAttached')) {
//           // Найдём форму, в которой находится кнопка
//           var $form = $submitBtn.closest('form.webform-client-form');
//           if ($form.length > 0) {
//             console.log('Drupal.behaviors: Найдена родительская форма.');

//             // Вешаем обработчик на клик по кнопке
//             $submitBtn.on('click', function(e) {
//               console.log('Drupal.behaviors: Клик по кнопке отправки.');

//               // Найдите вашу радио-кнопку. Машинное имя: soglasie_na_obrabotku_dannyh
//               var $radioInput = $form.find('input[name="submitted[soglasie_na_obrabotku_dannyh]"]:checked');
//               // Найдите родительский элемент компонента, к которому будем добавлять класс
//               var $componentContainer = $form.find('.webform-component--soglasie-na-obrabotku-dannyh');

//               console.log('Drupal.behaviors: Отмеченных радио-кнопок: ', $radioInput.length);

//               if ($radioInput.length === 0) { // Если радио-кнопка НЕ отмечена
//                 console.log('Drupal.behaviors: Радио-кнопка не отмечена. Добавляем класс my-custom-error-style.');
//                 $componentContainer.addClass('my-custom-error-style');
//               } else { // Если отмечена
//                 console.log('Drupal.behaviors: Радио-кнопка отмечена. Удаляем класс my-custom-error-style.');
//                 $componentContainer.removeClass('my-custom-error-style');
//               }
//             });

//             // Помечаем кнопку как обработанную
//             $submitBtn.data('myClickHandlerAttached', true);
//           } else {
//             console.error('Drupal.behaviors: Не удалось найти родительскую форму для кнопки.');
//           }
//         } else {
//           console.log('Drupal.behaviors: Обработчик клика для кнопки уже был привязан.');
//         }
//       } else {
//         // Кнопка не найдена в текущем контексте
//         // Это нормально, если context - это другой элемент DOM без кнопки
//         // console.log('Drupal.behaviors: Кнопка отправки не найдена в текущем контексте.');
//         // Закомментим, чтобы не засорять консоль
//       }
//     }
//   };

// })(jQuery);