app.module 'GalleryApp.List', (List, app, Backbone, Marionette, $, _) ->
    List.Controller = listAlbums: ->
        loadingView = new (app.Common.Views.Loading)
        app.mainRegion.show loadingView
        albumsListLayout = new (List.Layout)
        fetchingAlbums = app.request('album:entities')
        $.when(fetchingAlbums).done (albumsCollection) ->
            albumsListView = new (List.Albums)(collection: albumsCollection)
            albumsListLayout.on 'show', ->
                albumsListLayout.albumsRegion.show albumsListView
                return
            app.mainRegion.show albumsListLayout
            return
        return
    return