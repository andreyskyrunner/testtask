app = new (Marionette.Application)

app.addRegions
    mainRegion: '#main-region'

app.navigate = (route, options) ->
    options or (options = {})
    Backbone.history.navigate route, options
    return

app.getCurrentRoute = ->
    Backbone.history.fragment

app.on 'start', ->
    if Backbone.history
        Backbone.history.start()
    return

window.app = app

$(document).ready ->
  app.start()
