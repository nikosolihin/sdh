export default class Subnav {
  constructor(el) {
    this.$el = $(el)
    this.explore = '.Subnav-explore'
    this.attachEvents()
  }
  attachEvents() {
    this.$el.on('click', this.explore, () => {
      this.$el.toggleClass('Subnav--open')
    })
  }
}
