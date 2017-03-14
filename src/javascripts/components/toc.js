export default class Toc {
  constructor(el) {
    this.$el = $(el)
    this.$titles = $(".SinglePage-content .Editor > h2")
    this.tagIds()
  }

  tagIds() {
    this.$titles.each( (index, data) => {
      let label = $(data).text(),
        slug = label.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'')
        
      $(data).attr('id', slug)
      this.setupToc(label, slug)
    })
  }

  setupToc(label, slug) {
    this.$el.append(`<a href="#${slug}" class="Toc-link h6 medium gray">${label}</a>`)
  }
}
