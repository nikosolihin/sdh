import Flickity from 'flickity-bg-lazyload'

export default class Carousel {
  constructor(el) {
    this.$el = $(el)
    this.cellName = '.CarouselNews-card'
    this.$arrows = $(".CarouselNews").find('.Arrows')
    this.carousel = new Flickity (el, {
      cellSelector: this.cellName,
      cellAlign: 'left',
      groupCells: 3,
      draggable: false,
      pageDots: false,
      prevNextButtons: false,
      wrapAround: false,
      adaptiveHeight: false,
      bgLazyLoad: 1,
      autoPlay: false
    })
    this.attachEvents()
  }

  attachEvents() {
    this.$arrows.on('click', '.Flickity-prev', (event) => {
      event.preventDefault()
      this.carousel.previous()
    })
    .on('click', '.Flickity-next', (event) => {
      event.preventDefault()
      this.carousel.next()
    })
  }
}
