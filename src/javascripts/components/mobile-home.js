import 'jquery-bridget'
import Flickity from 'flickity'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class MobileHome {
  constructor(el) {
    this.$el = $(el)
    this.$body = $(".Hero")
    this.count = $(".Hero-cell").length
    this.flickity = this.initializeFlickity( this.count, this.$body, {
      wrapAround: true,
      pageDots: false,
      prevNextButtons: false,
      adaptiveHeight: false,
      autoPlay: false,
      setGallerySize: false
    })
    // this.attachEvents()
  }

  initializeFlickity(count, target, options) {
    let galleryData = target.flickity(options).data('flickity')
    // Flickity events need to be done like this since
    // jQuery is encapsulated when used with Webpack
    // https://github.com/metafizzy/flickity/issues/329
    // target.flickity( 'on', 'cellSelect', function() {
    //   $(".Gallery-caption-item--show").removeClass('Gallery-caption-item--show')
    //   $(".Gallery-caption-item").eq( galleryData.selectedIndex ).addClass('Gallery-caption-item--show')
    // })
    return galleryData
  }

  attachEvents() {
    this.$el.on('click', this.newsButtons, () => {

    })
  }

}
