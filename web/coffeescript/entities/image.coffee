app.module 'Entities', (Entities, app, Backbone, Marionette, $, _) ->
    Entities.Image = Backbone.Model.extend(urlRoot: 'albums')
    Entities.ImageCollection = Backbone.Collection.extend(
        url: 'albums/:id'
        model: Entities.Image
        parse: (response) ->
            @album = response.album
            @pagination = response.paginationData
            response.images.items
    )

    fetchImages = (params) ->
        albumId = params.albumId
        page = params.page
        images = new (Entities.ImageCollection)
        url = 'albums/' + albumId
        if page
            url += '?page=' + page
        images.url = url
        defer = $.Deferred()
        images.fetch success: (data) ->
            defer.resolve data
            return
        defer

    API = getImageEntities: (albumId) ->
        fetchImages albumId
    app.reqres.setHandler 'image:entities', (params) ->
        API.getImageEntities params
    return