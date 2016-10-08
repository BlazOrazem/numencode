//"use strict";

var datetime = null,
        time = null,
        date = null;

var update = function () {
    date = moment(new Date());
    datetime.html(date.format('DD MMMM YYYY <br> dddd'));
    time.html(date.format('H:mm:ss'));
};

$(function() {
  
  if($(".icon-menu")[0]){
    if($(window).width() > 991){
      $("aside.sidebar ul").removeClass("metismenu");

      $(".nav-inside").mCustomScrollbar({
        theme: "minimal",
        scrollInertia: 0,
        mouseWheel:{
          preventDefault: true
        }
      });
    }
  }
  
  $(".side-panel .tab-pane").mCustomScrollbar({
    theme: "minimal",
    scrollInertia: 0,
    mouseWheel:{
      preventDefault: true
    }
  });
  
  
  if($("body").hasClass("menu-alt")){
      if($(window).width() <= 480){
        $('body').removeClass('icon-menu');
        $("aside.sidebar ul").addClass("metismenu");
     }
     if($(window).width() > 480){
        $('body').addClass('icon-menu');
       $("aside.sidebar ul").removeClass("metismenu");
      }
    }
  
  // Full height of content
  $('.container-fluid').css("min-height", $(window).height() - 150 + "px");

  if($(window).resize()){
    $('.container-fluid').css("min-height", $(window).height() - 150 + "px");
  }

  //Current Time
  if($('.current-date')[0] && $('.time')[0]) {
    datetime = $('.current-date');
    time = $('.time');

    update();
    setInterval(update, 1000);
  }
 

  
  
  $(".notification-container").mCustomScrollbar({
    theme: "minimal-dark",
    scrollInertia: 0,
    mouseWheel:{
      preventDefault: true
    }
  });

  $('.notification>a').on('click', function (event) {
    $(this).parent().toggleClass('open');
  });

  $('body').on('click', function (e) {
    if (!$('.notification').is(e.target)
        && $('.notification').has(e.target).length === 0
        && $('.open').has(e.target).length === 0
    ) {
        $('.notification').removeClass('open');
    }
  });

  $(".notification .clear-all").on("click", function(e){
      e.preventDefault();
      $(".notification-container").mCustomScrollbar("disable");
      $(".notification-container a").each(function(i){
        setTimeout(function(){
          $(".notification-container a").eq(i).addClass("animated fadeOutRight");
        }, i * 50);
      });
      setTimeout(function(){
        $(".check-ok").fadeIn(200);
      }, 800);
  });

  //selectpickers
  if($(".selectpicker")[0]){
    $('.selectpicker').selectpicker({
      iconBase: "zmdi",
      tickIcon: "zmdi-check"
    });
  }

  //Input fields
  if($('.fg-input')[0]) {
      $('body').on('focus', '.form-control', function(){
          $(this).closest('.fg-input').addClass('fg-active');
      });

      $('body').on('blur', '.form-control', function(){
          var p = $(this).closest('.form-group');
          var i = p.find('.form-control').val();

          if (p.hasClass('fg-float')) {
              if (i.length === 0) {
                  $(this).closest('.fg-input').removeClass('fg-active');
              }
          }
          else {
              $(this).closest('.fg-line').removeClass('fg-active');
          }
      });
  }

  if($('.fg-float')[0]) {
      $('.fg-float .form-control').each(function(){
          var i = $(this).val();

          if (i.length !== 0) {
              $(this).closest('.fg-input').addClass('fg-active');
          }

      });
  }
  //Quantity buttons
  // This button will increment the value
  $('.qtyplus').on("click", function(e){
      // Stop acting like a button
      e.preventDefault();
      // Get the field name
      fieldName = $(this).attr('data-field');
      // Get its current value
      var currentVal = parseInt($('input[name='+fieldName+']').val());
      // If is not undefined
      if (!isNaN(currentVal)) {
          // Increment
          $('input[name='+fieldName+']').val(currentVal + 1);
      } else {
          // Otherwise put a 0 there
          $('input[name='+fieldName+']').val(0);
      }
  });
  // This button will decrement the value till 0
  $(".qtyminus").on("click", function(e) {
      // Stop acting like a button
      e.preventDefault();
      // Get the field nameg
      fieldName = $(this).attr('data-field');
      // Get its current value
      var currentVal = parseInt($('input[name='+fieldName+']').val());
      // If it isn't undefined or its greater than 0
      if (!isNaN(currentVal) && currentVal > 0) {
          // Decrement one
          $('input[name='+fieldName+']').val(currentVal - 1);
      } else {
          // Otherwise put a 0 there
          $('input[name='+fieldName+']').val(0);
      }
  });


  //Click to remove content-block
  $(".close-btn").on("click", function(e){
     e.preventDefault();
      var removedBlock = $(this).closest(".content-box").fadeOut(200, function(){
        $(this).remove();
      });
  });

  //Click to collapse block
  var collapsedBlock = false;
  $(".collapse-btn").on("click", function(e){
     e.preventDefault();
     if (!collapsedBlock){
      $(this).closest(".content-box").find(".content").slideUp(200);
      $(this).find("i").toggleClass("zmdi-minus zmdi-plus");
      collapsedBlock = true;
     }
     else {
      $(this).closest(".content-box").find(".content").slideDown(200);
      $(this).find("i").toggleClass("zmdi-plus zmdi-minus");
      collapsedBlock = false;
     }
  });

  //Click to refresh content-block
  $(".refresh-btn").on("click", function(e){
      var refreshBox = $(this).closest('div.content-box');
      $("<div class='refresh-preloader'><div class='preloader'><i>.</i><i>.</i><i>.</i></div></div>").appendTo(refreshBox).fadeIn(200);

      setTimeout(function(){
        var refreshPreloader = refreshBox.find('.refresh-preloader'),
            deletedRefreshBox = refreshPreloader.fadeOut(200, function(){
            refreshPreloader.remove();
        });
      },2500);

      e.preventDefault();
  });


  //sidepanel
  $(".sidepanel-toggle").on("click", function(e){
    e.preventDefault();
    $(this).parent().toggleClass("open");
    $(".side-panel").toggleClass("open");
  });

  
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-bottom-left",
  "preventDuplicates": true,
  "showDuration": "300",
  "hideDuration": "500",
  "timeOut": "4000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "show",
  "hideMethod": "hide"
};
  
//toastr["success"]('Good to see you, Marcus!');

  //Open/Close sidebar
  $(".menu-toggle").on("click", function(){
    $("body").toggleClass("open-menu");
    $(this).toggleClass("toggled");
    $(".menu-toggle i").toggleClass("zmdi-menu zmdi-arrow-left");
    if($(window).width() < 768){
      $("body").append("<div class='menu-overlay'></div>");
      $(".menu-overlay").fadeIn(300);
    }
    if($("body").hasClass("open-menu")){
      if($(window).width() >= 1024){
        setTimeout(function(){
          $(".logo").show();
        },300);
      }
    }
    else{
      $(".logo").hide();
      $(".menu-overlay").fadeOut(100, function(){
        $(".menu-overlay").remove();
      });
    }
  });

  $(window).on("resize", function(){
     if($("body").hasClass("open-menu")){
      if($(window).width() >= 1024){
        setTimeout(function(){
          $(".logo").show();
        },300);
     }
     if($(window).width() < 1024){
        $(".logo").hide();
    }
     }
       
     if($("body").hasClass("menu-alt")){
      if($(window).width() <= 480){
        $('body').removeClass('icon-menu');
        $("aside.sidebar ul").addClass("metismenu");
        $('.metismenu').metisMenu();
     }
     if($(window).width() > 480){
        $('body').addClass('icon-menu');
        $("aside.sidebar ul").removeClass("metismenu");
      }
    }
});
  
  

  $('body').on('click', '.menu-toggle', function(e){
      e.preventDefault();

      var $elem = '.sidebar';
      var $elem2 = '.menu-toggle';

      $(".side-panel").removeClass('open');
      $('.sidepanel-toggle').parent().removeClass("open");
      //When clicking outside
      if ($('body').hasClass('open-menu')) {
          $(document).on('click', function (e) {
              if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                  setTimeout(function(){
                      if(!$("body").hasClass("fixed-sidebar")){
                        $('body').removeClass('open-menu');
                        $(".logo").hide();
                      }
                      $($elem2).removeClass("toggled");
                      $(".menu-toggle i").removeClass("zmdi-arrow-left").addClass("zmdi-menu");
                      
                      $(".menu-overlay").fadeOut(300, function(){
                        $(".menu-overlay").remove();
                      });
                  });
              }
          });
      }
  });
  
  $('body').on('click', '.sidepanel-toggle', function(e){
      e.preventDefault();

      var $elem = '.side-panel';
      var $elem2 = '.sidepanel-toggle';
      
      $(".more-options, .notification").removeClass('open');

      //When clicking outside
      if ($('.side-panel').hasClass('open')) {
          $(document).on('click', function (e) {
              if (($(e.target).closest($elem).length === 0) && ($(e.target).closest($elem2).length === 0)) {
                  setTimeout(function(){
                      $(".side-panel").removeClass('open');
                      $($elem2).parent().removeClass("open");
                  });
              }
          });
      }
  });
  
  $(".more-options a, .notification a").on("click", function(){
    $(".side-panel").removeClass('open');
    $('.sidepanel-toggle').parent().removeClass("open");
  });

  //Collaspe Fix
  if ($('.collapse')[0]) {

      //Add active class for opened items
      $('.collapse').on('show.bs.collapse', function (e) {
          $(this).closest('.panel').find('.panel-heading').addClass('active');
      });

      $('.collapse').on('hide.bs.collapse', function (e) {
          $(this).closest('.panel').find('.panel-heading').removeClass('active');
      });

      //Add active class for pre opened items
      $('.collapse.in').each(function(){
          $(this).closest('.panel').find('.panel-heading').addClass('active');
      });
  }

  //Tooltips
  if ($('[data-toggle="tooltip"]')[0]) {
      $('[data-toggle="tooltip"]').tooltip({
        container: "body"
      });
  }

  //Popover
  if ($('[data-toggle="popover"]')[0]) {
      $('[data-toggle="popover"]').popover();
  }



  function changeTitlePosition(){
    var title = $(".page-title").remove();
    
    if($(".breadcrumb")[0]){
      $(".breadcrumb").eq(0).after(title);
    }
    else{
      $(".container-fluid > .row").eq(0).before(title);
    }
  }
  
  if($(window).width() <= 1024){
    changeTitlePosition();
  }

  $(window).resize(function(){
    if($(window).width() <= 1024){
      changeTitlePosition();
    }
    else{
      var title = $(".page-title").remove();
      $(".navbar-container > .pull-left").html(title);
    }
  });

  var locationHref = $(location).attr('pathname').replace("/", "");
  var currentPage = $('a[href="' + locationHref + '"]');
  $(".sidebar").find(currentPage).addClass("current-page");
  currentPage.closest("ul").parent().addClass("current-block");

});
