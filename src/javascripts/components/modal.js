window.$ = $
export default class Modal {
  constructor(el) {
    this.$el = $(el)
    this.$video = $(".welcome-video")
    this.$modal = $(".Modal")
    this.isOpen = false
    this.frame = $(".Modal .Embed iframe")
    this.vidsrc = this.frame.attr('src')
    this.attachEvents()

    console.log(this.frame)
    console.log(this.vidsrc)
  }

  attachEvents() {
    this.$el.on('click', (event) => {
      event.preventDefault()
      this.isOpen = true
      this.frame.attr('src', this.vidsrc+"&autoplay=1")
      this.$video.get(0).pause()
      this.$modal.addClass('Modal--on')
      $('body').addClass('noScroll')
    })
    this.$modal.on('click', (event) => {
      event.preventDefault()
      if (this.isOpen) {
        this.frame.attr('src', this.vidsrc)
        this.$modal.addClass('Modal--close').delay(150).queue(() => {
          this.$modal.removeClass('Modal--on').dequeue()
          this.$modal.removeClass('Modal--close').dequeue()
        })
        $('body').removeClass('noScroll')
        this.$video.get(0).play()
      }
    })
  }
}
