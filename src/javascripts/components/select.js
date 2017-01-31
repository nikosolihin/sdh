export default class Select {
  constructor(el) {
    this.el = '.Select'
    this.$el = $(el)
    this.$dropdown = this.$el.find('.Select-dropdown')
    this.item = this.$el.find('.Select-item')
    this.showDropdown = 'Select-dropdown--show'
    this.attribute = 'Category'
    this.isDown = false

    this.attachEvents()
  }

  attachEvents() {
    $(document).on('click', (event) => {
      let target = $(event.target)
      if( target.is(this.el) || target.parents(this.el).length ) {
        // clicks within the dropdown or its children
        if (this.isDown) {
          // dropdown is shown
          this.closeDropdown()
        } else {
          // dropdown is hidden
          this.openDropdown()
        }
      }
      else if ( !target.is(this.el) && !target.parents(this.el).length && this.isDown ) {
        // clicks outside the dropdown
        this.closeDropdown()
      }
      else if ( target.is(this.item) && this.isDown ) {
        this.closeDropdown()
      }
    })
    this.$dropdown.on('click', this.item, (event) => {
      event.preventDefault()
      let slug = $(event.target).data(this.attribute.toLowerCase()+'-slug'),
        name = $(event.target).text()
      this.$el.data('selected'+this.attribute, slug).find('span').text(name)
    })
  }

  closeDropdown() {
    this.isDown = false
    this.$dropdown.removeClass(this.showDropdown)
  }

  openDropdown() {
    this.isDown = true
    this.$dropdown.addClass(this.showDropdown)
  }
}
