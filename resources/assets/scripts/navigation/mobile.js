class NavMobile {

  constructor() {
    console.warn('Constructor NavMobile');
  }

  static start() {

    // Botón toggle
    $('.toggle-button-mobile').on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();
      $(this).toggleClass('active');
      // $('#nav-container-mobile').toggleClass('active');
      $('#nav-container-mobile').slideToggle();
    });

    $('.menu-item-more').on('click', function(event) {
      event.preventDefault();
      event.stopPropagation();

      // $('#nav-container-mobile .sub-menu.active').removeClass('active');

      $(this).next().slideToggle();
      const text = $(this).text();
      $(this).text(text == '+' ? '-' : '+');
    });

  }

}

export default NavMobile;
