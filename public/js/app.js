(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js"); // RWD menu


$('.show-menu').click(function () {
  $('.dashboard').addClass('mobile-menu');
});
$('.close-menu').click(function () {
  $('.dashboard').removeClass('mobile-menu');
}); // Handle message close button event

$('.message .close.icon').click(function () {
  $(this).parent().remove();
}); // Handle selectable resource tables

$('.resource .selectable.table tbody tr').click(function () {
  $(this).find('td:first-child input[type="radio"]')[0].click();
});
$('.resource .selectable.table td:first-child input[type="radio"]').prop('checked', false).change(function () {
  $(this).closest('tbody').find('tr').removeClass('active');
  $(this).closest('tr').addClass('active');
  $(this).closest('.resource').find('.controls button.disabled').removeClass('disabled');
}); // Handle resource delete button click

$('.delete-resource').click(function () {
  var _$$closest$find$data = $(this).closest('.resource').find('tr.active').data(),
      name = _$$closest$find$data.name,
      deleteRoute = _$$closest$find$data.deleteRoute;

  var $modal = $('.delete-modal');
  $modal.find('.content > strong').text(name);
  $modal.modal({
    onApprove: function onApprove() {
      $('.delete-modal form').attr('action', deleteRoute).submit();
    }
  }).modal('show');
}); // Handle resource edit button click

$('.edit-resource').click(function () {
  var route = $(this).closest('.resource').find('tr.active').data('edit-route');
  document.location = route;
}); // Add CSRF token to every ajax request

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js").default;
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });


__webpack_require__(/*! semantic-ui-css/semantic.min.js */ "./node_modules/semantic-ui-css/semantic.min.js");

__webpack_require__(/*! ./tablesort.js */ "./resources/js/tablesort.js");

/***/ }),

/***/ "./resources/js/tablesort.js":
/*!***********************************!*\
  !*** ./resources/js/tablesort.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*
	A simple, lightweight jQuery plugin for creating sortable tables.
	https://github.com/kylefox/jquery-tablesort
	Version 0.0.11
*/
(function ($) {
  $.tablesort = function ($table, settings) {
    var self = this;
    this.$table = $table;
    this.$thead = this.$table.find('thead');
    this.settings = $.extend({}, $.tablesort.defaults, settings);
    this.$sortCells = this.$thead.length > 0 ? this.$thead.find('th:not(.no-sort)') : this.$table.find('th:not(.no-sort)');
    this.$sortCells.on('click.tablesort', function () {
      self.sort($(this));
    });
    this.index = null;
    this.$th = null;
    this.direction = null;
  };

  $.tablesort.prototype = {
    sort: function sort(th, direction) {
      var start = new Date(),
          self = this,
          table = this.$table,
          rowsContainer = table.find('tbody').length > 0 ? table.find('tbody') : table,
          rows = rowsContainer.find('tr').has('td, th'),
          cells = rows.find(':nth-child(' + (th.index() + 1) + ')').filter('td, th'),
          sortBy = th.data().sortBy,
          sortedMap = [];
      var unsortedValues = cells.map(function (idx, cell) {
        if (sortBy) return typeof sortBy === 'function' ? sortBy($(th), $(cell), self) : sortBy;
        return $(this).data().sortValue != null ? $(this).data().sortValue : $(this).text();
      });
      if (unsortedValues.length === 0) return; //click on a different column

      if (this.index !== th.index()) {
        this.direction = 'asc';
        this.index = th.index();
      } else if (direction !== 'asc' && direction !== 'desc') this.direction = this.direction === 'asc' ? 'desc' : 'asc';else this.direction = direction;

      direction = this.direction == 'asc' ? 1 : -1;
      self.$table.trigger('tablesort:start', [self]);
      self.log("Sorting by " + this.index + ' ' + this.direction); // Try to force a browser redraw

      self.$table.css("display"); // Run sorting asynchronously on a timeout to force browser redraw after
      // `tablesort:start` callback. Also avoids locking up the browser too much.

      setTimeout(function () {
        self.$sortCells.removeClass(self.settings.asc + ' ' + self.settings.desc);

        for (var i = 0, length = unsortedValues.length; i < length; i++) {
          sortedMap.push({
            index: i,
            cell: cells[i],
            row: rows[i],
            value: unsortedValues[i]
          });
        }

        sortedMap.sort(function (a, b) {
          return self.settings.compare(a.value, b.value) * direction;
        });
        $.each(sortedMap, function (i, entry) {
          rowsContainer.append(entry.row);
        });
        th.addClass(self.settings[self.direction]);
        self.log('Sort finished in ' + (new Date().getTime() - start.getTime()) + 'ms');
        self.$table.trigger('tablesort:complete', [self]); //Try to force a browser redraw

        self.$table.css("display");
      }, unsortedValues.length > 2000 ? 200 : 10);
    },
    log: function log(msg) {
      if (($.tablesort.DEBUG || this.settings.debug) && console && console.log) {
        console.log('[tablesort] ' + msg);
      }
    },
    destroy: function destroy() {
      this.$sortCells.off('click.tablesort');
      this.$table.data('tablesort', null);
      return null;
    }
  };
  $.tablesort.DEBUG = false;
  $.tablesort.defaults = {
    debug: $.tablesort.DEBUG,
    asc: 'sorted ascending',
    desc: 'sorted descending',
    compare: function compare(a, b) {
      if (a > b) {
        return 1;
      } else if (a < b) {
        return -1;
      } else {
        return 0;
      }
    }
  };

  $.fn.tablesort = function (settings) {
    var table, sortable, previous;
    return this.each(function () {
      table = $(this);
      previous = table.data('tablesort');

      if (previous) {
        previous.destroy();
      }

      table.data('tablesort', new $.tablesort(table, settings));
    });
  };
})(window.Zepto || window.jQuery);

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/sass/vendor.scss":
/*!************************************!*\
  !*** ./resources/sass/vendor.scss ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!******************************************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ./resources/sass/vendor.scss ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\laragon\www\Spinback\resources\js\app.js */"./resources/js/app.js");
__webpack_require__(/*! C:\laragon\www\Spinback\resources\sass\app.scss */"./resources/sass/app.scss");
module.exports = __webpack_require__(/*! C:\laragon\www\Spinback\resources\sass\vendor.scss */"./resources/sass/vendor.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);