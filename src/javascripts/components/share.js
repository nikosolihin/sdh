export default class Share {
  constructor(el) {
    this.$el = $(el)
    this.shareButton = ".share"
    this.attachEvents()
  }
  attachEvents() {
    this.$el.on('click', this.shareButton, (event) => {
      event.preventDefault()
      let href = $(event.target).parents(this.shareButton).attr('href')
      window.open( href, null, 'height=300,width=555,status=yes,toolbar=no,menubar=no,location=no')
    })
  }
}
