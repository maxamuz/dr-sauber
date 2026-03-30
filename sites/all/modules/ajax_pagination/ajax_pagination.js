/**
 * @file
 *
 * Handles AJAX Pagination.
 */

(function ($) {
  Drupal.ajax.prototype.commands.scrollTop = function (ajax, response, status) {
    // Largely based on the views Scroll Top code
    var offset = $(response.selector).offset();
    var scrollTarget = response.selector;
    while ($(scrollTarget).scrollTop() == 0 && $(scrollTarget).parent()) {
      scrollTarget = $(scrollTarget).parent();
    }
    // Only scroll upward
    if (offset.top - 20 < $(scrollTarget).scrollTop()) {
      $(scrollTarget).animate({scrollTop: (offset.top - 20)}, 500);
    }
  };
})(jQuery);
