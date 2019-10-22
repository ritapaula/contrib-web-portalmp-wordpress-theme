// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*';

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import NavPrimary from './navigation/primary';
import NavMobile from './navigation/mobile';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
});

// Load Events
jQuery(document).ready(() => {
  routes.loadEvents();
  // Load Navigation
  NavPrimary.start();
  NavMobile.start();
});

