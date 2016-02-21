app.module 'GalleryApp.List', (List, app, Backbone, Marionette, $, _) ->
    List.Layout = Marionette.LayoutView.extend(
        template: '#album-list-layout'
        regions: albumsRegion: '#albums-region')
    List.Album = Marionette.ItemView.extend(
        template: '#album-list-item'
        events: 'click a.show_album > button': 'showAlbum'
        showAlbum: (e) ->
            app.trigger 'album:show', @model.id
            e.preventDefault()
            return
    )
    List.Albums = Marionette.CollectionView.extend(
        tagName: 'div'
        className: 'list-group'
        childView: List.Album)
    return
