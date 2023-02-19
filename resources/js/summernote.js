import axios from 'axios';

$(function () {

  /**
  * テキストエディター summernote
  */
  $(document).ready(function() {
    $('#summernote').summernote({
      toolbar: [
        // ツールバーリスト
        // 他にも種類があるので公式サイトを見てみてくださいね♪
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ],
    });
  });
});