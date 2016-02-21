app.module 'GalleryApp', (GalleryApp, app, Backbone, Marionette, $, _) ->
    GalleryApp.Router = Marionette.AppRouter.extend(appRoutes:
        '': 'listAlbums'
        'album/:id': 'showAlbum'
        'album/:id/page/:page': 'showAlbum'
    )
    API =
        listAlbums: ->
            GalleryApp.List.Controller.listAlbums()
            return
        showAlbum: (id, page) ->
            GalleryApp.Show.Controller.showAlbum id, page
            return
    app.on 'albums:list', ->
        API.listAlbums()
        return
    app.on 'album:show', (id, page) ->
        url = 'album/' + id
        if page
            url += '/page/' + page
        app.navigate url
        API.showAlbum id, page
        return
    app.addInitializer ->
        new (GalleryApp.Router)(controller: API)
        return
    return
