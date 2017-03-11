export default class MobileHeader {
  constructor(el) {
    this.$el = $(el)
    this.parent = '.MobileHeader-links'
    this.target = '.MobileHeader-link'
    this.on = 'MobileHeader-links--open'
    this.attachEvents()
  }

  attachEvents() {
    $(".Burger").on('click', (event) => {
      event.preventDefault()
      $(".Burger").toggleClass('Burger--morph')
      $("body").toggleClass('noScroll')
      this.$el.toggleClass('MobileHeader--open')
    })
    this.$el.on('click', this.target, (event) => {
      $('.' + this.on).removeClass(this.on)
      $(event.target).closest(this.parent).toggleClass(this.on)
    })
  }
}
