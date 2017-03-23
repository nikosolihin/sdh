export default class Search {
  constructor(el) {
    this.$el = $(el)
    this.$search = $(".Search")
    this.$close = $(".Search-close")
    this.$input = $(".Search-input")
    this.$form = $(".Search-form")
    this.$popular = $(".Search-popular")
    this.$modal = $(".Modal")

    this.isSearchOpen = false

    this.attachEvents()
  }

  attachEvents() {
    this.$el.on('click', (event) => {
      event.preventDefault()
      this.isSearchOpen = !this.isSearchOpen

      $(".Home-statements").removeClass('Home-statements--show')
      $(".Home-news").css('display', 'none')

      this.$modal.trigger('modal:toggle')
      this.$search.addClass('Search--open')
      this.$close.addClass('Search-close--open')

      setTimeout( () => {
        this.$form.addClass('Search-form--open')
        this.$popular.addClass('Search-popular--open')
      }, 150)
      setTimeout( () => {
        $(".Search-input").focus()
      }, 300)

    })

    $(".Search-close").on('click', (event) => {
      if (this.isSearchOpen) {
        this.closeSearch(event)
      }
    })

    // Escape out
    $(document).keyup( (event) => {
      if(event.keyCode == 27 && this.isSearchOpen) {
        this.closeSearch(event)
      }
    })
  }

  closeSearch(event) {
    event.preventDefault()
    this.isSearchOpen = !this.isSearchOpen

    this.$close.removeClass('Search-close--open')
    this.$form.removeClass('Search-form--open')
    this.$popular.removeClass('Search-popular--open')

    setTimeout( () => {
      this.$modal.trigger('modal:toggle')
    }, 100)
    setTimeout( () => {
      this.$search.removeClass('Search--open')
    }, 200)

    $(".Home-statements").addClass('Home-statements--show')
    $(".Home-news").css('display', 'flex')
  }
}
