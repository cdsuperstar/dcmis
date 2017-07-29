
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
//require('bootstrap-sass');
import angular from 'angular'
require('angular-ui-grid');
require('restangular');
require('ng-dialog');
require('angular-animate');
require('angular-jsoneditor');

require('laravel-echo');
require('socket.io-client');
require('ng-tags-input');
require('jasny-bootstrap/js/fileinput');
require('ui-select');
//require('jquery-ui-bundle');
require("jquery-ui/ui/widgets/draggable");
require('ui-router-extras');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

//window.Vue = require('vue');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

 import Echo from "laravel-echo"

 window.Echo = new Echo({
     broadcaster: 'socket.io',
     host: window.location.hostname + ':6001',
     appId: 'dcmis',
     key: '22185490f482e2d492aa725ce449dd38'
 });

