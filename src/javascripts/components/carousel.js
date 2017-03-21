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
      pageDots: true,
      prevNextButtons: false,
      adaptiveHeight: false,
      autoPlay: 6000
    })
    this.attachEvents()
  }

  initializeFlickity(count, target, options) {
    let carouselData = target.flickity(options).data('flickity')
    // Flickity events need to be done like this since
    // jQuery is encapsulated when used with Webpack
    // https://github.com/metafizzy/flickity/issues/329
    target.flickity( 'on', 'cellSelect', function() {
      $(".Carousel-navItem--active").removeClass('Carousel-navItem--active')
      $(".Carousel-navItem").eq( carouselData.selectedIndex ).addClass('Carousel-navItem--active')
    })
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
