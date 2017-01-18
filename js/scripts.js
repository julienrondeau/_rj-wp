// as the page loads, call these scripts
jQuery(document).ready(function($) {

  /*****************  Navigation du site pour les mobiles *****************/

  $('.nav-trigger').on('click', function(event) {
    event.preventDefault();
    $('body').toggleClass('nav-open');
    $('.main-navigation').toggleClass('menu-open');
  });

  /************* Closes the Responsive Menu on Menu Item Click *****************/

  $('.main-navigation a').click(function() {

    if ($('.main-navigation').hasClass('menu-open')) {
      $('.nav-trigger').click();
    }

  });

  /************* Expandable search form *****************/
  var submitIcon = $('.icon-search'),
    inputBox = $('.search-input'),
    searchBox = $('.searchbox'),
    inputSubmit = $('.search-submit'),
    isOpen = false;

  submitIcon.click(function() {

    if (!isOpen) {
      searchBox.addClass('searchbox-open');
      //inputSubmit.addClass('z-index-1');
      inputBox.focus();
      isOpen = true;
    } else {
      searchBox.removeClass('searchbox-open');
      //inputSubmit.removeClass('z-index-1');
      inputBox.focusout();
      isOpen = false;
    }
  });

  // check if there are values in search input text
  // submit if true
  function buttonUp() {
    var inputVal = $('.search-input').val();
    inputVal = $.trim(inputVal).length;

    if (inputVal !== 0) {
      $('.icon-search').css('display', 'none');
    } else {
      $('.search-input').val('');
      $('.icon-search').css('display', 'block');
    }
  }

  $('.search-input').on('keypress', function() {
    buttonUp();
  });

  // Close search form when click outside the form
  //  $(document).on('click', function(event) {
  //    var clickID = event.target.className;
  //
  //    if (clickID !== 'search-submit' && clickID !== 'icon-search' && clickID !== 'search-input') {
  //
  //      if ($('.searchbox').hasClass('searchbox-open')) {
  //
  //        $('.searchbox').removeClass('searchbox-open');
  //        $('.search-submit').removeClass('z-index-1');
  //        $('.search-input').focusout();
  //
  //      }
  //    }
  //  });

  /************* Sticky footer  *****************/

//  var windowHeight = $(window).height(),
//      bodyHeight = $('body').height();
//
//  if (bodyHeight < windowHeight) {
//    $('.site-footer').toggleClass('sticky-footer');
//  }


  /************* Infinite Ajax Scroll init *****************/

//  var ias = $.ias({
//  container:  '.site-main-content',
//  item:       '.post',
//  pagination: '.navigation',
//  next:       '.nav-previous a',
//  delay: 1000
//});
//
//  ias.extension(new IASTriggerExtension({
//    text: 'SHOW MORE PUBLICATIONS',
//    offset: 1
//  }));
//  ias.extension(new IASSpinnerExtension());
//  ias.extension(new IASNoneLeftExtension({text: 'NO MORE PUBLICATIONS'}));

  /************* Owl carousel init for footer references *****************/
//
//  $('.logos-container').owlCarousel({
//    center: false,
//    autoWidth: true,
//    loop: true,
//    nav: false,
//    dots: false,
//    autoplay: true,
//    autoplayTimeout: 100,
//    autoplayHoverPause: false,
//    smartSpeed: 15000
//  });

}); // fin jQuery(document)
