export default class Pill {
  constructor(el) {
    // Pills are usually wrapped within parent elements
    this.$el = $(el)
    this.pills = '.Pill'
    this.attachEvents()
  }
  attachEvents() {
    this.$el.on('click', this.pills, (event) => {
      event.preventDefault()
      $(event.target).toggleClass('Pill--inactive')
    })
  }
}
