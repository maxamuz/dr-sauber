(function ($) {
  'use strict';

  Drupal.behaviors.cookieConsent = {
    attach: function (context, settings) {
      // Проверяем, было ли уже дано согласие на куки
      if (!getCookie('cookie_consent_given')) {
        // Если согласия нет, показываем модальное окно
        var $modal = $('#cookie-consent-modal', context);
        if ($modal.length > 0) {
          $modal.show(); // Показываем окно
          console.log('Модальное окно cookie показано.');
        } else {
          console.warn('Элемент #cookie-consent-modal не найден в DOM.');
        }
      } else {
        console.log('Согласие на cookie уже получено. Окно не показывается.');
      }

      // Обработчик клика по кнопке "Принять"
      $('#accept-cookies-btn', context).once('cookie-consent-attach').on('click', function() {
        // Устанавливаем куки на 1 год (или другой срок по вашему выбору)
        var expirationDate = new Date();
        expirationDate.setFullYear(expirationDate.getFullYear() + 1);
        // Куки по умолчанию будет доступна для всего сайта (path=/)
        document.cookie = "cookie_consent_given=1; expires=" + expirationDate.toUTCString() + "; path=/; SameSite=Lax";

        // Скрываем модальное окно
        var $modal = $('#cookie-consent-modal');
        if ($modal.length > 0) {
          $modal.hide();
          console.log('Согласие на cookie получено. Окно скрыто.');
        }

        // Здесь можно добавить инициализацию Яндекс.Метрики, если она не была запущена до согласия
        // if (typeof yaCounterXXXXXX !== 'undefined') {
        //   // yaCounterXXXXXX - замените на ваш ID счетчика
        //   // Метрика обычно инициализируется в head, но если вы отложили её,
        //   // можно вызвать её функции здесь.
        // }
      });
    }
  };

  // Вспомогательная функция для получения значения куки по имени
  function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }

})(jQuery);