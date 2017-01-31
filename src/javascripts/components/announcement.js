import Cookies from 'js-cookie'

export default class Announcement {
  constructor(el) {
    this.$el = $(el)
    this.closeButton = ".Announcement-close"
    this.closed = "Announcement--closed"
    this.show = "Announcement--show"
    this.dte = parseInt(this.$el.data('options').dte)
    if ( !this.checkCookie() ) {
      this.$el.toggleClass(this.show)
      this.attachEvents()
    }
  }
  attachEvents() {
    this.$el.on('click', this.closeButton, (event) => {
      event.preventDefault()
      Cookies.set('stroopwafel', 'yuss', { expires: this.dte })
      this.$el.toggleClass(this.closed)
    })
  }
  checkCookie() {
    return Cookies.get('stroopwafel') ? true : false
  }
  hideBar() {
    this.$el.css()
  }
}
