import GoogleMapsLoader from 'google-maps'

export default class Map {
  constructor(el) {
    this.$el = $(el)
    this.withButtons = this.$el.data('withButtons')
    this.newMap(el)
  }

  newMap(el) {
    GoogleMapsLoader.KEY = 'AIzaSyCcqne1WUPeDEbyBfk9jurNKJ5ofAZlLIY'
    GoogleMapsLoader.load( google => {
      let $markers = $(el).find('.marker'),
        latlng = []
      $markers.each( (index, value) => {
        latlng[latlng.length] = {
          lat: $(value).data('lat'),
          lng: $(value).data('lng'),
          content: $(value).html().trim()
        }
      })
      let args = {
          zoom: 16,
          scrollwheel: false,
          disableDoubleClickZoom: true,
          center: new google.maps.LatLng(0, 0),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        },
        map = new google.maps.Map(el, args)
      map.markers = []
      latlng.map( (marker) => {
        this.addMarker( marker.lat, marker.lng, marker.content, map )
      })
      this.centerMap(map)
      if (this.withButtons) {
        this.attachEvents(map)
      }
      return map
    })
  }

  addMarker(lat, lng, content, map) {
    let latlng = new google.maps.LatLng( lat, lng ),
      marker = new google.maps.Marker({
        position: latlng,
        map: map
  	  })
    map.markers.push( marker )
    if( content.length ){
      let infowindow = new google.maps.InfoWindow({
        content: content,
        maxWidth: 275
      })
      google.maps.event.addListener(marker, 'click', () => {
        infowindow.open( map, marker )
      })
      infowindow.open( map, marker)
    }
  }

  centerMap(map) {
    let bounds = new google.maps.LatLngBounds()
    $.each( map.markers, (i, marker) => {
      var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() )
      bounds.extend( latlng )
    })
    if( map.markers.length == 1 ) {
      map.setCenter( bounds.getCenter() )
      map.setZoom( 16 )
    } else {
      map.fitBounds( bounds )
    }
  }

  attachEvents(map) {
    $(".Map-button").on('click', (event) => {
      event.preventDefault()
      let lng = parseFloat( $(event.target).closest('.Map-button').data('lng') ),
        lat = parseFloat( $(event.target).closest('.Map-button').data('lat') )
      map.setCenter({ lat: lat, lng: lng })
      map.setZoom( 18 )
    })
  }
}
