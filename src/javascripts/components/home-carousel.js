import Flickity from 'flickity'

export default class HomeCarousel {
  constructor(el) {
    this.$el = $(el)
    this.cellName = '.block-carousel-cell'
    this.carousel = new Flickity (el, {
      cellSelector: this.cellName,
      cellAlign: 'left',
      contain: true,
      groupCells: true,
      draggable: true,
      pageDots: false,
      prevNextButtons: true
    })
  }
}
