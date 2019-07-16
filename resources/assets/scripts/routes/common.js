
export default {
  init() {
    // JavaScript to be fired on all pages

    // $('.sliderbehaviour').slick({
    //   centerMode: true,
    //   slidesToShow: 1,
    //   slidesToScroll: 1,
    //   // dots: true,
    //   // infinite: true,
    //   cssEase: 'linear',
    //   variableWidth: true,
    //   variableHeight: true,
    //   rows: 0,
    // });

    // var $slickGallery = $('.gallery.gallery-columns-1');

    // $slickGallery.on('init reInit afterChange', function (event, slick, currentSlide) {
    //   var i = (currentSlide ? currentSlide : 0) + 1;
    //   $(this).find('.gallery-item-slider-counter span').text(i + '/' + slick.slideCount);
    // });

    // $slickGallery.on('setPosition', function (event, slick) {
    //   var height = slick.$slider.find('.slick-current .gallery-icon').height();
    //   slick.$slider.find('.gallery-item-slider-controls').css('top', height);
    //   $(this).find('.gallery-item-slider-controls').css('top', $(this).find('.slick-current .gallery-icon').height());
    // });

    // $slickGallery.slick({
    //   slide: '.gallery-item',
    //   appendArrows: $slickGallery.find('.gallery-item-slider-arrows'),
    //   rows: 0,
    // });

    // $('.gallery.gallery-columns-1').on('click', '.gallery-icon a', function (e) {
    //   e.preventDefault();
    // });

    // $('.gallery.gallery-columns-1').on('click', '.gallery-icon', function () {

    //   $('#galleryModal').modal();

    //   var $slickGalleryModal = $('#galleryModal .gallery-modal');

    //   $('#galleryModal').on('shown.bs.modal', function () {
    //     var currentSlide = $slickGallery.slick('slickCurrentSlide');

    //     $slickGalleryModal.on('afterChange', function() {
    //       $slickGalleryModal.addClass('gallery-loaded');
    //     });

    //     if (! $slickGalleryModal.hasClass('slick-initialized') ) {

    //       $slickGalleryModal.on('init reInit afterChange', function (event, slick, currentSlide) {
    //         var i = (currentSlide ? currentSlide : 0) + 1;
    //         $(this).find('.gallery-item-slider-counter span').text(i + '/' + slick.slideCount);
    //       });

    //       $slickGalleryModal.on('setPosition', function (event, slick) {
    //         var height = slick.$slider.find('.slick-current .gallery-icon').height();
    //         slick.$slider.find('.gallery-item-slider-controls').css('top', height);
    //         $(this).find('.gallery-item-slider-controls').css('top', $(this).find('.slick-current .gallery-icon').height());
    //       });

    //       $slickGalleryModal.slick({
    //         slide: '.gallery-item',
    //         appendArrows: $('#galleryModal .gallery-item-slider-arrows'),
    //         rows: 0,
    //       });

    //       $slickGalleryModal.slick('slickGoTo', currentSlide);
    //     } else {
    //       $slickGalleryModal.slick('slickGoTo', currentSlide);
    //     }
    //   });

    //   $('#galleryModal').on('hidden.bs.modal', function () {
    //     $slickGalleryModal.removeClass('gallery-loaded');
    //   });
    // });

    $('.page-content table').tableresponsive();

    // $('.widget-filter .widget-filter__taxonomy').on('click', 'input[type="checkbox"]', function() {
    $('.widget-filter .widget-filter__checkbox').on('click', 'input[type="checkbox"]', function() {
      $(this).closest('form').submit();
    });


    const $shareBtn = $('#share-buttons');
    if ( $shareBtn.length > 0 ) {
      if (typeof(addthis) !== 'undefined') {
        addthis.addEventListener('addthis.ready', function() {

          console.log('Load addthis');

          setTimeout(function() {
            $shareBtn.on('click', '.btn-share', function(event) {
              event.preventDefault();
              const $container = $(event.target).parent().find('.share-buttons-container');
              $container.slideToggle('400', function() {});
            });
          }, 1000);

          // Para ocultar o menú social cando facemos click fóra
          $(document).on('click', function(event) {
            if ( $(event.target).closest('.share-buttons').length === 0 ) {
              $('.share-buttons .share-buttons-container').slideUp('400');
            }
          });
        });
      }
      const top = $('.wrap').offset().top + 40;
      $shareBtn.css('top', top + 'px');
        // } else {
        //     shareBtn.css('top', 'auto');
        // }
      $shareBtn.addClass('visible');
    }

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
