import Flickity from 'flickity-bg-lazyload'

export default class FeaturedEvents {
  constructor(el) {
    this.$el = $(el)
    this.cellName = '.FeaturedEvents-image'
    this.$arrows = $(".FeaturedEvents").find('.Arrows')
    this.featuredEvents = new Flickity (el, {
      cellSelector: this.cellName,
      callAlign: 'left',
      draggable: false,
      pageDots: false,
      prevNextButtons: false,
      wrapAround: true,
      adaptiveHeight: false,
      bgLazyLoad: 1,
      autoPlay: 8000,
      pauseAutoPlayOnHover: false
    })
    this.featuredEventsData = Flickity.data(el)
    this.attachEvents()
    this.showFirstCell()
  }

  attachEvents() {
    this.featuredEvents.on( 'select', () => {
      this.displayContent( this.featuredEventsData.selectedIndex )
    })
    this.$arrows.on('click', '.Flickity-prev', (event) => {
      event.preventDefault()
      this.featuredEvents.previous()
    })
    .on('click', '.Flickity-next', (event) => {
      event.preventDefault()
      this.featuredEvents.next()
    })

    // Pause flickity if user is reading
    $(".FeaturedEvents-body").hover(() => {
      this.featuredEvents.pausePlayer()
    }, () => {
      this.featuredEvents.unpausePlayer()
    })
  }

  showFirstCell() {
    $('.FeaturedEvents-content[data-content-id="0"]').addClass('FeaturedEvents-content--show')
  }

  displayContent( index ) {
    $(".FeaturedEvents-content--show").removeClass('FeaturedEvents-content--show')
    $('.FeaturedEvents-content[data-content-id="'+ index +'"]').addClass('FeaturedEvents-content--show')
  }
}
