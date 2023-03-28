"use strict";

/**
 *	Custom jQuery Scripts
 *
 */
jQuery(document).ready(function ($) {
  $('.flexslider').flexslider({
    animation: "fade",
    slideshowSpeed: 8000
  }); // end register flexslider

  $('.flexslider2').flexslider({
    animation: "fade",
    slideshowSpeed: 4000
  }); // end register flexslider
  // $('.vol-drop').find('.dropbox').toggleClass('open close');
  // $(".vol-drop").click(function() {
  //     $( ".dropbox" ).toggleClass("open");
  // });

  $('.vol-drop').on('click', 'span', function () {
    $('.dropbox').toggleClass('active');
    $('.vol-drop span i').toggleClass('active');
  });
  $('.btn-drop').on('click', 'span', function () {
    $('.btn-dropbox').toggleClass('active');
    $('.btn-drop span i').toggleClass('active');
  });
  /*
  *
  *	Equal Heights Divs
  *
  ------------------------------------*/

  $('.js-blocks').matchHeight();
  $('.js-titles').matchHeight();
  $(function () {
    $("#accordion").accordion({
      collapsible: true,
      active: false,
      heightStyle: "content"
    });
    $('#accordion h2').bind('click', function () {
      var self = this;
      setTimeout(function () {
        theOffset = $(self).offset();
        $('body,html').animate({
          scrollTop: theOffset.top - 100
        });
      }, 310); // ensure the collapse animation is done
    });
  });
  $('input.heart-submit').val('SUBMIT');
  /*
        FAQ dropdowns
  __________________________________________
  */

  $('.question').click(function () {
    $(this).next('.answer').slideToggle(500);
    $(this).toggleClass('close');
    $(this).find('.plus-minus-toggle').toggleClass('collapsed');
    $(this).parent().toggleClass('active');
  });
  $('#00N6A00000MTsDm').change(function () {
    var selection = this.value; //grab the value selected

    if (selection == 'Other') {
      $('.toggle').css("display", "block"); //alert(selection);
    }
  });
  $('#00N6A00000MTg6j').change(function () {
    var selection = this.value; //grab the value selected

    if (selection == 'Other') {
      $('.togglepref').css("display", "block"); //alert(selection);
    }
  });
  $('.firstname input').keyup(function (event) {
    var textBox = event.target;
    var start = textBox.selectionStart;
    var end = textBox.selectionEnd;
    textBox.value = textBox.value.charAt(0).toUpperCase() + textBox.value.slice(1);
    textBox.setSelectionRange(start, end);
  }); //Isotope with images loaded ...

  var $container = $('#container').imagesLoaded(function () {
    $container.isotope({
      // options
      itemSelector: '.item',
      masonry: {
        gutter: 30
      }
    });
  }); //Examples of how to assign the Colorbox event to elements

  $(".group1").colorbox({
    rel: 'group1'
  });
  $(".group2").colorbox({
    rel: 'group2'
  });
  $(".group3").colorbox({
    rel: 'group3',
    transition: "none",
    width: "75%",
    height: "75%"
  });
  $(".group4").colorbox({
    rel: 'group4',
    slideshow: true
  });
  $(".ajax").colorbox();
  $(".youtube").colorbox({
    iframe: true,
    innerWidth: 640,
    innerHeight: 390
  });
  $(".vimeo").colorbox({
    iframe: true,
    innerWidth: 500,
    innerHeight: 409
  });
  $(".iframe").colorbox({
    iframe: true,
    width: "80%",
    height: "80%"
  });
  $(".inline").colorbox({
    inline: true,
    width: "50%"
  });
  $(".callbacks").colorbox({
    onOpen: function onOpen() {
      alert('onOpen: colorbox is about to open');
    },
    onLoad: function onLoad() {
      alert('onLoad: colorbox has started to load the targeted content');
    },
    onComplete: function onComplete() {
      alert('onComplete: colorbox has displayed the loaded content');
    },
    onCleanup: function onCleanup() {
      alert('onCleanup: colorbox has begun the close process');
    },
    onClosed: function onClosed() {
      alert('onClosed: colorbox has completely closed');
    }
  });
  $('.non-retina').colorbox({
    rel: 'group5',
    transition: 'none'
  });
  $('.retina').colorbox({
    rel: 'group5',
    transition: 'none',
    retinaImage: true,
    retinaUrl: true
  }); //Example of preserving a JavaScript event for inline calls.

  $("#click").click(function () {
    $('#click').css({
      "background-color": "#f00",
      "color": "#fff",
      "cursor": "inherit"
    }).text("Open this window again and this message will still be here.");
    return false;
  });
});
/* GOOGLE MAP */

(function ($) {
  /*
  *  render_map
  *
  *  This function will render a Google Map onto the selected jQuery element
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$el (jQuery element)
  *  @return	n/a
  */
  function render_map($el) {
    // var
    var $markers = $el.find('.marker'); // vars

    var args = {
      zoom: 16,
      center: new google.maps.LatLng(0, 0),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }; // create map	        	

    var map = new google.maps.Map($el[0], args); // add a markers reference

    map.markers = []; // add markers

    $markers.each(function () {
      add_marker($(this), map);
    }); // center map

    center_map(map);
  }
  /*
  *  add_marker
  *
  *  This function will add a marker to the selected Google Map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	$marker (jQuery element)
  *  @param	map (Google Map object)
  *  @return	n/a
  */


  function add_marker($marker, map) {
    // var
    var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng')); // create marker

    var marker = new google.maps.Marker({
      position: latlng,
      map: map
    }); // add to array

    map.markers.push(marker); // if marker contains HTML, add it to an infoWindow

    if ($marker.html()) {
      // create info window
      var infowindow = new google.maps.InfoWindow({
        content: $marker.html()
      }); // show info window when marker is clicked

      google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, marker);
      });
    }
  }
  /*
  *  center_map
  *
  *  This function will center the map, showing all markers attached to this map
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	4.3.0
  *
  *  @param	map (Google Map object)
  *  @return	n/a
  */


  function center_map(map) {
    // vars
    var bounds = new google.maps.LatLngBounds(); // loop through all markers and create bounds

    $.each(map.markers, function (i, marker) {
      var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
      bounds.extend(latlng);
    }); // only 1 marker?

    if (map.markers.length == 1) {
      // set center of map
      map.setCenter(bounds.getCenter());
      map.setZoom(16);
    } else {
      // fit to bounds
      map.fitBounds(bounds);
    }
  }
  /*
  *  document ready
  *
  *  This function will render each map when the document is ready (page has loaded)
  *
  *  @type	function
  *  @date	8/11/2013
  *  @since	5.0.0
  *
  *  @param	n/a
  *  @return	n/a
  */


  $(document).ready(function () {
    $('.acf-map').each(function () {
      render_map($(this));
    });
  });
})(jQuery);