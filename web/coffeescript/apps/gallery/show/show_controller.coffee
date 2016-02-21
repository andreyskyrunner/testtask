app.module 'GalleryApp.Show', (Show, app, Backbone, Marionette, $, _) ->
    Show.Controller = showAlbum: (id, page) ->
        loadingView = new (app.Common.Views.Loading)
        app.mainRegion.show loadingView
        albumShowLayout = new (Show.Layout)
        fetchingImages = app.request('image:entities',
            'albumId': id
            'page': page
        )
        $.when(fetchingImages).done (imagesCollection) ->
            if imagesCollection.length
                albumShowLayout.templateHelpers = ->
                    album: imagesCollection.album

                albumShowView = new (Show.Images)(collection: imagesCollection)
                albumShowLayout.on 'show', ->
                    albumShowLayout.imagesRegion.show albumShowView
                    return
                if imagesCollection.pagination.pageCount > 1
                    paginationView = new (Show.Pagination)(templateHelpers: ->
                        'pagination': imagesCollection.pagination
                        'album': imagesCollection.album
                    )
                    albumShowLayout.on 'show', ->
                        albumShowLayout.paginationRegion.show paginationView
                        return
                app.mainRegion.show albumShowLayout
            else
                notfoundView = new (app.Common.Views.Notfound)
                app.mainRegion.show notfoundView
                return
            return
        return