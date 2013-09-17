(function ($) {
  var $toplevel = $('#toplevel_page_st-page')
    , $item = $toplevel.find('ul li').eq(2)
    , page = $item.length ? $item.find('a').attr('href').replace('admin.php?page=', '') : 'st-page';
  $toplevel.find('> a').attr('href', 'admin.php?page=' + page);
}(jQuery));