(function ($) {
  var $wp_inline_edit = inlineEditPost.edit;
  inlineEditPost.edit = function (id) {
    $wp_inline_edit.apply(this, arguments);

    var $post_id = 0;
    if (typeof id == 'object') $post_id = parseInt(this.getId(id));

    if ($post_id > 0) {
      var $edit_row = $('#edit-' + $post_id);
      var $post_row = $('#post-' + $post_id);

      //重要なお知らせを表示（チェックボックス）
      var $isImportant = !!$('.column-is_important>*', $post_row).attr('checked');
      $(':input[name="is_important"]', $edit_row).attr('checked', $isImportant);
    }
  };
})(jQuery);
