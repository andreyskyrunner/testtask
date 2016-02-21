// Generated by CoffeeScript 1.10.0
(function() {
  app.module('GalleryApp.Show', function(Show, app, Backbone, Marionette, $, _) {
    return Show.Controller = {
      showAlbum: function(id, page) {
        var albumShowLayout, fetchingImages, loadingView;
        loadingView = new app.Common.Views.Loading;
        app.mainRegion.show(loadingView);
        albumShowLayout = new Show.Layout;
        fetchingImages = app.request('image:entities', {
          'albumId': id,
          'page': page
        });
        $.when(fetchingImages).done(function(imagesCollection) {
          var albumShowView, notfoundView, paginationView;
          if (imagesCollection.length) {
            albumShowLayout.templateHelpers = function() {
              return {
                album: imagesCollection.album
              };
            };
            albumShowView = new Show.Images({
              collection: imagesCollection
            });
            albumShowLayout.on('show', function() {
              albumShowLayout.imagesRegion.show(albumShowView);
            });
            if (imagesCollection.pagination.pageCount > 1) {
              paginationView = new Show.Pagination({
                templateHelpers: function() {
                  return {
                    'pagination': imagesCollection.pagination,
                    'album': imagesCollection.album
                  };
                }
              });
              albumShowLayout.on('show', function() {
                albumShowLayout.paginationRegion.show(paginationView);
              });
            }
            app.mainRegion.show(albumShowLayout);
          } else {
            notfoundView = new app.Common.Views.Notfound;
            app.mainRegion.show(notfoundView);
            return;
          }
        });
      }
    };
  });

}).call(this);