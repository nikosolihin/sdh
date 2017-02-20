import 'jquery-bridget'
import Flickity from 'flickity'

$.bridget('flickity', Flickity) // jQuerify flickity

export default class Gallery {
  constructor(el) {
    this.$el = $(el)
    this.$body = $(".Gallery-body")
    this.count = $(".Gallery-cell").length
    this.flickity = this.initializeFlickity( this.count, this.$body, {
      wrapAround: true,
      pageDots: false,
      prevNextButtons: false,
      adaptiveHeight: false,
      autoPlay: false,
      setGallerySize: false
    })
    this.attachEvents()
  }

  initializeFlickity(count, target, options) {
    let galleryData = target.flickity(options).data('flickity')
    // Flickity events need to be done like this since
    // jQuery is encapsulated when used with Webpack
    // https://github.com/metafizzy/flickity/issues/329
    target.flickity( 'on', 'cellSelect', function() {
      $(".Gallery-caption-item--show").removeClass('Gallery-caption-item--show')
      $(".Gallery-caption-item").eq( galleryData.selectedIndex ).addClass('Gallery-caption-item--show')
    })
    return galleryData
  }

  attachEvents() {
    this.$el.on('click', '.Gallery-left', (event) => {
      event.preventDefault()
      this.flickity.previous()
    })
    .on('click', '.Gallery-right', (event) => {
      event.preventDefault()
      this.flickity.next()
    })
    .on('click', '.Gallery-close', (event) => {
      event.preventDefault()
      this.close()
    })
    $(".Gallery-previewButton, .Gallery-preview").on('click', (event) => {
      event.preventDefault()
      this.open()
    })
    $(document).keyup( (event) => {
      if(event.keyCode == 27) {
        event.preventDefault()
        this.close()
      }
    })
  }

  open() {
    $("body").addClass('noScroll')
    this.$el.removeClass('die')
    setTimeout(() => {
      this.$el.addClass('Gallery--open')
    }, 10)
  }

  close() {
    $("body").removeClass('noScroll')
    this.$el.removeClass('Gallery--open')
    setTimeout(() => {
      this.$el.addClass('die')
    }, 125)
  }
}
