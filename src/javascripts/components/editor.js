// This cleans up the output of ACF Medium Editor.

export default class Editor {
  constructor(el) {
    this.$el = $(el)
    this.removeSpans()
    this.removeBreaks()
    this.removeEmptyParagraphs()
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

  removeEmptyParagraphs() {
    $('.Editor p').filter( (index, element) => {
      return $.trim( $(element).html() ) == ''
    }).remove()
  }
}
