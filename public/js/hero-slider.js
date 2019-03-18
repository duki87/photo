$(document).ready(function() {
  $('#page-links').hide();
  $('#all-works').addClass('active');
  var arr = ['1.jpg', '2.jpg', '3.jpg'];
  var i = 0;

  setInterval(function(){
    hero_slider();
  }, 5000);

  function hero_slider() {
    // $('#hero-area').fadeOut('slow', function() {
    //   $(this).css('background', 'url(img/'+arr[i]+') fixed no-repeat');
    //   $(this).css('background-size', 'cover');
    //   $(this).fadeIn('slow', 1);
    // });

    $('#hero-area').fadeOut(1000, function () {
      $('#hero-area').css('background-size', 'cover');
      // new changes
      let path = 'http://'+window.location.hostname+'/photo/public/img/';
      console.log(path);
      // $(this).css('background', 'url(img/'+arr[i]+') fixed no-repeat').fadeIn(1000);
      $(this).css('background', 'url('+path+arr[i]+') fixed no-repeat').fadeIn(1000);
      $(this).css('background-size', 'cover');
    });

    // $('#hero-area').animate({ opacity: 0}, 1000, function() {
    //   $(this).css('background', 'url(img/'+arr[i]+') fixed no-repeat').animate({opacity: 1},1000);
    //   $(this).css('background-size', 'cover');
    // });

    if(i == arr.length-1) {
      i = 0;
    } else {
      i++;
    }
  }

  $(document).on('click', '#navbar-show-hide', function(e) {
    e.preventDefault();
    $('#page-links').toggle();
    //$('#page-links').css('visibility', 'hidden');
  });

});
