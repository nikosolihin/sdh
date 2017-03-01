import 'mattboldt.typed.js'
import ScrollMagic from 'ScrollMagic'
import 'animation.gsap'
// import TweenLite from 'TweenLite'

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
    this.newsOpen = 'Home-news--openViaModal'

    this.setAnimation() // Scroll animation
    this.attachEvents()
  }

  setAnimation() {
    const controller = new ScrollMagic.Controller()

    new ScrollMagic.Scene({
      triggerElement: ".Home-background",
      triggerHook: 'onLeave',
      duration: 400
    })
		.setTween(".Home-statements", {
      opacity: 0,
      y: 275,
      ease: Linear.easeNone
    })
		.addTo(controller)
  }

  startTyping() {
    this.$holder.typed({
      stringsElement: this.$sentences,
      typeSpeed: 40,
      startDelay: 250,
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
      this.$news.toggleClass(this.newsOpen)
      this.$modal.trigger('modal:toggle')
    })
    .on('lazybeforeunveil', (image) => {
      if ($(image.target).is('.Home-backgroundItem:nth-child(1)')) {
        setTimeout(() => {
          this.$loader.addClass('Loader--fadeOut')
          this.startTyping()
          this.$statements.addClass('Home-statements--show')
          setTimeout(() => {
            this.$statements.addClass('Home-statements--static')
          }, 750)
        }, 1000)
      }
    })
  }
}
