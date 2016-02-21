app.module 'Entities', (Entities, app, Backbone, Marionette, $, _) ->
    Entities.Album = Backbone.Model.extend(urlRoot: 'albums')
    Entities.AlbumCollection = Backbone.Collection.extend(
        url: 'albums'
        model: Entities.Album)

    fetchAlbums = ->
        albums = new (Entities.AlbumCollection)
        defer = $.Deferred()
        albums.fetch success: (data) ->
            defer.resolve data
            return
        defer

    API = getAlbumEntities: ->
        fetchAlbums()
    app.reqres.setHandler 'album:entities', ->
        API.getAlbumEntities()
    return