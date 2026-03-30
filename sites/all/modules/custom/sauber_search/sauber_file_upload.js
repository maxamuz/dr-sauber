(function ($) {
  Drupal.behaviors.autoUpload = {
    attach: function(context, settings) {
      var fakeFileUpload = document.createElement('div');
      fakeFileUpload.className = 'fakefile';
      fakeFileUpload.appendChild(document.createElement('input'));
      var image = document.createElement('img');
      image.src='/sites/all/themes/custom/helix/heliximages/upload.png';
      fakeFileUpload.appendChild(image);
      var x = document.getElementsByTagName('input');
      for (var i=0;i<x.length;i++) {
        if (x[i].type != 'file') continue;
        if (x[i].parentNode.className != 'image-widget-data') continue;
        x[i].className = 'file hidden';
        var clone = fakeFileUpload.cloneNode(true);
        x[i].parentNode.appendChild(clone);
        x[i].relatedElement = clone.getElementsByTagName('input')[0];
        x[i].onchange = x[i].onmouseout = function () {
          this.relatedElement.value = this.value;
        }
      }
    }
  };
})(jQuery);