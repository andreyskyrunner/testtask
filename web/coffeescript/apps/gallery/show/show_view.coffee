app.module 'GalleryApp.Show', (Show, app, Backbone, Marionette, $, _) ->
    Show.Layout = Marionette.LayoutView.extend(
        template: '#album-show-layout'
        regions:
            imagesRegion: '#images-region'
            paginationRegion: '#pagination-region'
    )
    Show.Image = Marionette.ItemView.extend(
        tagName: 'div'
        className: 'col-lg-3 col-md-4 col-xs-6 thumb'
        template: '#album-show-item'
        events: 'click a.swipebox': 'showSwipebox'
        showSwipebox: (e) ->
            e.preventDefault()
            $('.swipebox').swipebox()
            return
    )
    Show.Images = Marionette.CollectionView.extend(
        tagName: 'div'
        className: 'row'
        childView: Show.Image
    )
    Show.Pagination = Marionette.ItemView.extend(
        tagName: 'nav'
        template: '#album-show-pagination'
        events: 'click a': 'paginate'
        paginate: (e) ->
            e.preventDefault()
            page = $(e.target).closest('li').attr('data-page')
            albumId = $(e.target).closest('.pagination').attr('data-album')
            app.trigger 'album:show', albumId, page
            return
    )
    return