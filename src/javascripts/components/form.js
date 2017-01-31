export default class Form {
  constructor(el) {
    this.$el = $(el)
    this.iframe = this.$el.find('.Form-embed')
    this.height = this.$el.data('formHeight')
    this.attachEvents()
  }
  attachEvents() {
    this.iframe.attr('height', this.height)
  }
}
