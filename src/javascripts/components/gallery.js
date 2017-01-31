import 'jquery-bridget'
import Flickity from 'flickity-imagesloaded'
import 'flickity-as-nav-for'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class Gallery {
  constructor(el) {
    this.$el = $(el)
    this.$body = $(".Gallery-body")
    this.$nav = $(".Gallery-nav")
    this.count = $(".Gallery-body img").length

    this.initializeFlickity( this.count, this.$body, {
      contain: true,
      pageDots: false,
      imagesLoaded: true,
      prevNextButtons: true,
      adaptiveHeight: true,
      lazyLoad: 1,
      autoPlay: 8000,
      pauseAutoPlayOnHover: true
    })
    this.initializeFlickityNav( this.$nav, {
      asNavFor: '.Gallery-body',
      contain: true,
      pageDots: false,
      prevNextButtons: false,
      imagesLoaded: true
    })
  }

  initializeFlickity(count, target, options) {
    let galleryData = target.flickity(options).data('flickity')
    // Flickity events need to be done like this since
    // jQuery is encapsulated when used with Webpack
    // https://github.com/metafizzy/flickity/issues/329
    target.flickity( 'on', 'cellSelect', function() {
      // During initialization, FLickity fires 'cellSelect',
      // resulting in inaccurate class assignment for the caption
      if (!count) {
        $(".Gallery-caption-item--show").removeClass('Gallery-caption-item--show')
        $(".Gallery-caption-item").eq( galleryData.selectedIndex ).addClass('Gallery-caption-item--show')
      } else {
        if (count=1) {
          $(".Gallery-caption-item").eq(0).addClass('Gallery-caption-item--show')
        }
        count--
      }
    })
  }

  initializeFlickityNav(target, options) {
    target.flickity(options)
  }
}
