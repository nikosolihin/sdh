import 'mattboldt.typed.js'

export default class Home {
  constructor(el) {
    this.$el = $(el)
    this.$holder = this.$el.find('.Home-statementsUnderlined')
    this.$statements = this.$el.find('.Home-statements')
    this.$sentences = this.$el.find('.Home-sentences')
    this.$modal = $(".Modal")
    this.$loader = $(".Loader")

    // Learn more button
    this.$button = $(".Home-statementsButton")

    // Home Background
    this.index = 1

    // News Buttons & Panel
    this.newsButtons = '.Home-newsLink'
    this.$news = this.$el.find('.Home-news')
    this.newsOpen = 'Home-news--open'
    this.isNewsOpen = false

    // Initialize loader
    this.$loader.toggleClass('Loader--fadeIn')

    this.attachEvents()
  }

  startTyping() {
    this.$holder.typed({
      stringsElement: this.$sentences,
      typeSpeed: 40,
      startDelay: 500,
      backDelay: 5000,
      backSpeed: -30,
      loop: true,
      contentType: 'text',
      showCursor: false,
      callback: () => { this.index = 1 },
      preStringTyped: () => {
        this.assignUrl()
        this.zoomBgIn()
      }
    })
  }

  zoomBgIn() {
    $(".Home-backgroundItem--show").removeClass('Home-backgroundItem--show Home-backgroundItem--out')
    $('.Home-backgroundItem:nth-child('+this.index+')').addClass('Home-backgroundItem--show')
    this.index++
  }

  assignUrl() {
    let url = $('.Home-backgroundItem:nth-child('+this.index+')').data('buttonUrl')
    this.$button.attr('href', url)
  }

  attachEvents() {
    this.$el.on('click', this.newsButtons, () => {
      this.isNewsOpen = !this.isNewsOpen
      $(".Home-statements").toggleClass('Home-statements--show')
      this.$news.toggleClass(this.newsOpen)
      this.$modal.trigger('modal:toggle')
    })
    .on('lazybeforeunveil', (image) => {
      if ($(image.target).is('.Home-backgroundItem:nth-child(1)')) {
        setTimeout(() => {
          this.$loader.toggleClass('Loader--fadeIn')
          this.startTyping()
          this.$statements.addClass('Home-statements--show')
          setTimeout(() => {
            this.$statements.addClass('Home-statements--static')
          }, 750)
        }, 1000)
      }
    })
    this.$modal.on('click', () => {
      if (this.isNewsOpen) {
        this.closeNews()
      }
    })

    // Escape out
    $(document).keyup( (event) => {
      if(event.keyCode == 27 && this.isNewsOpen) {
        this.closeNews()
      }
    })
  }

  closeNews() {
    this.isNewsOpen = !this.isNewsOpen
    $(".Home-statements").toggleClass('Home-statements--show')
    this.$modal.trigger('modal:toggle')
    this.$news.toggleClass(this.newsOpen)
  }
}
