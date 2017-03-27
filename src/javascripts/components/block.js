export default class Block {
  constructor(el) {
    this.$el = $(el)
    this.url = this.$el.data('url')
    this.isHovered = false
    this.attachEvents()
  }

  attachEvents() {
    this.$el.on('click touch', (event) => {
      event.preventDefault()

      // Check if this block is hovered
      if (this.isHovered) {
        window.location.href = $(event.target).closest('.Block-body').attr('href');
      }
    })

    this.$el.hover(() => {
      this.$el.toggleClass('Block--hover')

      // This timeout is the key to detecting whether
      // block has been hovered or not
      setTimeout(() => {
        this.isHovered = !this.isHovered
      }, 200)
    })
  }
}
