export default class Modal {
  constructor(el) {
    this.$el = $(el)
    this.body = $("body")
    this.modalOpen = 'Modal--open'
    this.attachEvents()
  }

  attachEvents() {
    this.$el.on('modal:toggle', () => {
      this.toggle()
    })
  }

  toggle() {
    this.body.toggleClass('noScroll')
    this.$el.toggleClass(this.modalOpen)
  }
}
