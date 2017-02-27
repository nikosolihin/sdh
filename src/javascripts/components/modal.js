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
    .on('click', () => {
      this.toggle()
      this.closeElement()
    })

    // Escape out
    $(document).keyup( (event) => {
      if(event.keyCode == 27) {
        event.preventDefault()
        this.toggle()
        this.closeElement()
      }
    })
  }

  toggle() {
    this.body.toggleClass('noScroll')
    this.$el.toggleClass(this.modalOpen)
  }

  closeElement() {
    $("[class$='--openViaModal']").removeClass((index, className) => {
      return (className.match(/\S+--openViaModal($|\s)/g) || []).join(' ')
    })
  }
}
