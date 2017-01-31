export default class TOC {
  constructor(el) {
    this.$el = $(el)
    this.$sidebar = $(".Sidebar")
    this.attachEvents()
  }
  attachEvents() {
    this.$el.on('click', () => {
      this.$sidebar.toggleClass('Sidebar--open')
    })
  }
}
