export default class Block {
  constructor(el) {
    this.$el = $(el)
    this.url = this.$el.data('url')
    this.attachEvents()
  }

  attachEvents() {
    this.$el.on('touchstart', (event) => {
      // Mobile touch hover
      event.preventDefault()
      if (this.$el.hasClass('Block--hover')) {
        window.location = this.url
      } else {
        $(".Block--hover").removeClass('Block--hover')
        this.$el.toggleClass('Block--hover')
      }
    })
    .hover(() => {
      // Desktop hover
      this.$el.toggleClass('Block--hover')
    })
  }
}
