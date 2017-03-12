export default class MobileHeader {
  constructor(el) {
    this.$el = $(el)
    this.parent = '.MobileHeader-links'
    this.target = '.MobileHeader-link'
    this.on = 'MobileHeader-links--open'
    this.attachEvents()
  }

  attachEvents() {
    $(".MobileHeader-burger").on('click', (event) => {
      $(".Burger").toggleClass('Burger--morph')
      $(".MobileHeader-burgerLabel").toggle()
      $("body").toggleClass('noScroll')
      this.$el.toggleClass('MobileHeader--open')
    })
    this.$el.on('click', this.target, (event) => {
      $('.' + this.on).removeClass(this.on)
      $(event.target).closest(this.parent).toggleClass(this.on)
    })
  }
}
