import 'jquery-bridget'
import Flickity from 'flickity'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class Spotlight {
  constructor(el) {
    this.$el = $(el)
    this.count = $(".Spotlight-cell").length
    this.flickity = this.initializeFlickity( this.count, this.$el, {
      wrapAround: true,
      pageDots: false,
      prevNextButtons: false,
      adaptiveHeight: true,
      autoPlay: false,
      setGallerySize: true,
      draggable: true
    })
    this.attachEvents()
  }

  initializeFlickity(count, target, options) {
    let spotlightData = target.flickity(options).data('flickity')
    return spotlightData
  }

  attachEvents() {
    this.$el.on('click', '.Spotlight-buttonPrev', (event) => {
      event.preventDefault()
      this.flickity.previous()
    })
    .on('click', '.Spotlight-buttonNext', (event) => {
      event.preventDefault()
      this.flickity.next()
    })
  }
}
