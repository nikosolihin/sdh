import 'jquery-bridget'
import Flickity from 'flickity'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class MobileHome {
  constructor(el) {
    this.$el = $(el)
    this.$body = $(".MobileHero")
    this.count = $(".MobileHero-item").length
    this.flickity = this.initializeFlickity( this.count, this.$body, {
      wrapAround: true,
      cellSelector: '.MobileHero-item',
      pageDots: false,
      prevNextButtons: false,
      adaptiveHeight: false,
      autoPlay: 7500,
      setGallerySize: false,
      draggable: false
    })

    this.playFirst()
  }

  initializeFlickity(count, target, options) {
    let mobileHero = target.flickity(options).data('flickity')
    // Flickity events need to be done like this since
    // jQuery is encapsulated when used with Webpack
    // https://github.com/metafizzy/flickity/issues/329
    target.flickity( 'on', 'cellSelect', function() {
      $(".MobileHero-item--appear").removeClass('MobileHero-item--appear')
      $(".MobileHero-item").eq( mobileHero.selectedIndex ).addClass('MobileHero-item--appear')
    })
    return mobileHero
  }

  playFirst() {
    setTimeout(() => {
      $(".MobileHero-item").eq(0).addClass('MobileHero-item--appear')
    }, 1000)
  }
}
