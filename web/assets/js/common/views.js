// Generated by CoffeeScript 1.10.0
(function() {
  app.module('Common.Views', function(Views, app, Backbone, Marionette, $, _) {
    Views.Loading = Marionette.ItemView.extend({
      template: '#loading-view',
      onShow: function() {
        var opts;
        opts = {
          lines: 13,
          length: 20,
          width: 10,
          radius: 30,
          corners: 1,
          rotate: 0,
          direction: 1,
          color: '#000',
          speed: 1,
          trail: 60,
          shadow: false,
          hwaccel: false,
          className: 'spinner',
          zIndex: 2e9,
          top: '250px',
          left: '300px'
        };
        $('#spinner').spin(opts);
      }
    });
    Views.Notfound = Marionette.ItemView.extend({
      template: '#notfound-view'
    });
  });

}).call(this);
