import Flickity from 'flickity'

export default class Hero {
  constructor(el) {
    this.$el = $(el)
    this.cellName = '.Hero-cell'
    this.hero = new Flickity (el, {
      cellSelector: this.cellName,
      wrapAround: true,
      pageDots: false,
      adaptiveHeight: false,
      autoPlay: 8000,
      pauseAutoPlayOnHover: true
    })
  }
}
