/**
* Provide the HTML to create the modal dialog.
*/
(function ($) {
Drupal.theme.prototype.sauber_search = function (left, top, width) {
	var html = '';
	html += '<div id="ctools-modal" class="popups-box">';
	html += '  <div class="ctools-modal-content ctools-modal-ajax-search-content">';
	html += '    <span class="popups-close"><a class="close" href="#">x</a></span>';
	html += '    <div class="modal-scroll"><div id="modal-content" class="modal-content popups-body"></div></div>';
	html += '  </div>';
	html += '</div>';
	return html;
}
})(jQuery);