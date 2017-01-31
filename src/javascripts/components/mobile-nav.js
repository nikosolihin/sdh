export default class MobileNav {
  constructor(el) {
    this.$el = $(el)
    this.$body = $("body")
    this.burger = ".MobileNav-burger"
    this.$burger = $(".Burger")
    this.$nav = $(".MobileNav")
    this.$panel = $(".MobilePanel")
    this.search = ".MobileNav-search"
    this.$searchbar = $(".SearchBar")
    this.navOpen = false
    this.searchOpen = false
    this.attachEvents()
  }

  attachEvents() {
    // Escape should close the mobile menu
    $(document).on('keyup', (key) => {
      if (key.keyCode == 27 && this.isSearchOpen) {

      }
      if (key.keyCode == 27 && this.isOpen) {

      }
    })
    $(".Header-secondaryNav").on('click', '.Header-search', (event) => {
      event.preventDefault()
      if (!this.searchOpen) {
        this.searchOpen = !this.searchOpen
        this.$searchbar.addClass('SearchBar--open')
        $(".Header-search").addClass('Header-search--open')
        setTimeout( () => {
          $("#SearchBar-input").focus()
        }, 300)
      } else {
        this.searchOpen = !this.searchOpen
        $("#SearchBar-input").blur()
        this.$searchbar.removeClass('SearchBar--open')
        $(".Header-search").removeClass('Header-search--open')
      }
    })
    this.$el.on('click', this.burger, (event) => {
      event.preventDefault()
      if (!this.navOpen) {
        this.navOpen = !this.navOpen
        this.$body.addClass('noScroll')
        this.$burger.addClass('Burger--morph')
        this.$nav.addClass('MobileNav--open')
        this.$panel.addClass('MobilePanel--open')
        if (this.searchOpen) {
          this.$panel.addClass('MobilePanel--openWithSearch')
        }
      } else {
        // Already opened
        this.navOpen = !this.navOpen
        this.$body.removeClass('noScroll')
        this.$burger.removeClass('Burger--morph')
        this.$panel.removeClass('MobilePanel--open MobilePanel--openWithSearch')
        this.$nav.removeClass('MobileNav--open')
      }
    })
    .on('click', this.search, (event) => {
      event.preventDefault()
      if (!this.searchOpen) {
        this.searchOpen = !this.searchOpen
        this.$searchbar.addClass('SearchBar--open')
        setTimeout( () => {
          $("#SearchBar-input").focus()
        }, 300)
        if (this.navOpen) {
          this.$panel.addClass('MobilePanel--openWithSearch')
        }
      } else {
        this.searchOpen = !this.searchOpen
        $("#SearchBar-input").blur()
        this.$searchbar.removeClass('SearchBar--open')
        if (this.navOpen) {
          this.$panel.removeClass('MobilePanel--openWithSearch')
        }
      }
    })
  }
}
