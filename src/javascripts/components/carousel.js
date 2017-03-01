import 'jquery-bridget'
import Flickity from 'flickity'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class Carousel {
  constructor(el) {
    this.$el = $(el)
    this.$body = $(".Carousel-items")
    this.button = '.Carousel-navItem'
    this.count = $(".Carousel-item").length
    this.flickity = this.initializeFlickity( this.count, this.$body, {
      wrapAround: true,
      pageDots: false,
      prevNextButtons: false,
      adaptiveHeight: false,
      autoPlay: false
    })
    this.attachEvents()
  }

  initializeFlickity(count, target, options) {
    let carouselData = target.flickity(options).data('flickity')
    return carouselData
  }

  attachEvents() {
    this.$el.on('click', this.button, (event) => {
      event.preventDefault()
      this.$el.find('.Carousel-navItem--active').removeClass('Carousel-navItem--active')
      let $suspect = $(event.target).closest(this.button),
          index = parseInt($suspect.data('nth'))
      $suspect.addClass('Carousel-navItem--active')
      this.flickity.select(index,true,false)
    })

  }
}
