export default class Tabs {
  constructor(el) {
    this.$el = $(el)
    this.target = null
    this.targets = null
    this.panels = null
    this.$tabs = $(this.$el).find('.Tabs-tab')
    this.initialize()
    this.attachEvents()
  }

  initialize() {
    this.$tabs.attr('tabindex', '0')
    this.targets = this.$tabs.map( (i, el) => {
      return el.hash
    }).get()
    this.panels = $(this.targets.join(',')).each( (i, el) => {
      $(el).data('old-id', el.id)
    })
    if (this.targets.indexOf( window.location.hash ) !== -1) {
      this.update()
    } else {
      this.show()
    }
  }

  attachEvents() {
    this.$el.on( 'click', this.tabs, (event) => {
      event.preventDefault()
      if(window.history.pushState) {
        window.history.pushState(null, null, event.target.hash)
      } else {
        location.hash = event.target.hash
      }
      this.target = $(event.target.hash).removeAttr('id')
      if (location.hash === event.target.hash) {
        setTimeout( this.update() )
      }
    })
    $(window).on( 'hashchange', (event) => {
      this.update()
    })
  }

  update() {
    let hash = window.location.hash
    if (this.target) {
      this.target.attr('id', this.target.data('old-id'))
      this.target = null
    }
    if (this.targets.indexOf( hash ) !== -1) {
      this.show( hash )
    }
    if ( !hash ) {
      this.show()
    }
  }

  show( id = this.targets[0] ) {
    this.$tabs.removeClass('selected')
      .attr('aria-selected', 'false')
      .filter( (i, el) => {
        return (el.hash === id)
      })
      .addClass('selected')
      .attr('aria-selected', 'true')

    $(this.panels).removeClass('Tabs-panel--show')
      .attr('aria-hidden', 'true')
      .filter(id)
      .addClass('Tabs-panel--show')
      .attr('aria-hidden', 'false')
  }
}
