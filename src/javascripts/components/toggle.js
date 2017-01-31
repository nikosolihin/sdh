export default class Toggle {
  constructor(el) {
    this.$el = $(el)
    this.link = '.Toggle-link'
    this.$clear = this.$el.prev('.Pill-clear')
    this.selected = 'Toggle-item--selected'
    this.attribute = 'Type'
    this.attachEvents()
  }

  attachEvents() {
    this.$el.on('click', this.link, (event) => {
      event.preventDefault()
      let target = $(event.target).parent(),
        slugs = []
      target.toggleClass(this.selected)
      $('.'+this.selected).each( (index, value) => {
        let slug = $(value).data(this.attribute.toLowerCase()+'-slug')
        slugs[slugs.length] = slug
      })
      this.$el.data('selected'+this.attribute, slugs)
    })

    // Clear button
    this.$clear.on('click', (event) => {
      event.preventDefault()
      this.$el.find('.'+this.selected).removeClass(this.selected)
    })
  }
}
