// This cleans up the output of ACF Medium Editor.

export default class Editor {
  constructor(el) {
    this.$el = $(el)
    this.removeSpans()
    this.removeBreaks()
  }

  removeSpans() {
    $('.Editor span').each( (index, element) => {
      let content = $(element).contents()
      $(element).replaceWith( () => {
        return content
      })
    })
  }

  removeBreaks() {
    $('.Editor br').remove()
  }
}
