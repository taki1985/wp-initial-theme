<?php

/******************************************
汎用関数
 ******************************************/
/*
*サムネイル画像取得
*/
function my_get_thumbs($id, $use_content = true, $size = 'thumbnail')
{
  if (has_post_thumbnail($id)) {
    $image_id = get_post_thumbnail_id($id);
    $image_url = wp_get_attachment_image_src($image_id, $size);
    return $image_url[0];
  } elseif ($use_content) {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    if ($matches[1]) {
      $first_img = $matches[1][0];
    }

    if (empty($first_img)) {
      $first_img = IMG_URI . '/common/img-default.jpg';
    }
    return $first_img;
  } else {
    return IMG_URI . '/common/img-default.jpg';
  }
}

/** 画像幅と高さだけ取得 **/
function my_get_image_size($file)
{
  $size = "";
  if (file_exists($file)) {
    $size = getimagesize($file);
    return $size[3];
  }
  return $size;
}

/*
*WebP用画像タグ出力
*/
function my_get_img_tag($src, $alt = "", $class = "", $use_size = true, $attrs = "")
{
  $src_arr = explode('.', $src); //拡張子を分ける
  $img_src =  get_template_directory() . '/assets/img/' . $src;
  $size = "";
  if ($use_size) {
    $size = my_get_image_size($img_src);
  }
  if (is_array($class)) {
    $class = implode(' ', $class);
  }
  $tags = "<picture>";
  $tags .= "<source type='image/webp' srcset='" . IMG_URI . "/" .  $src_arr[0] . ".webp'>";
  $tags .= "<img src='" . IMG_URI . "/" . $src . "' alt='" . $alt . "' " . $size . " class='" . $class . "' " . $attrs . ">";
  $tags .= "</picture>";
  return $tags;
}

//現在のページの親ページスラッグを取得
function my_get_parent_slug()
{
  global $post;
  if (isset($post->post_parent)) {
    $post_data = get_post($post->post_parent);
    return $post_data->post_name;
  }
  return false;
}


//現在のページが$slugの子孫ページか
function my_is_ancestor($slug)
{
  global $post;
  $page = get_page_by_path($slug);
  $result = false;
  if ($page && $post) {
    foreach (get_post_ancestors($post->ID) as $ancestor) {
      if ($ancestor == $page->ID) {
        $result = true;
      }
    }
  }
  return $result;
}



//文字列を改行コードごとに区切る
function my_wrapStringWithSpanTags($string, $class = "", $tag = "span")
{
  // 改行文字（\nや\r\nなど）を<>タグに置換
  $classStr = $class ? "class='" . $class . "'" : "";
  $replaceTag = '</' . $tag . '><' . $tag . ' ' . $classStr . '>';
  $wrappedString = str_replace(PHP_EOL, $replaceTag, $string);

  // 先頭と末尾に<span>タグを追加
  $wrappedString = '<' . $tag . ' ' . $classStr . '>' . $wrappedString . '</' . $tag . '>';

  return $wrappedString;
}

//console.log
function consoleLog($str)
{
  echo "<script>
    ";
  echo "console.log('" . $str .
    "')";
  echo "
  </script>";
}
