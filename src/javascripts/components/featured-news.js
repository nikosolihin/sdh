import Flickity from 'flickity-bg-lazyload'

export default class FeaturedNews {
  constructor(el) {
    this.$el = $(el)
    this.cellName = '.FeaturedNews-image'
    this.$arrows = $(".FeaturedNews").find('.Arrows')
    this.featuredNews = new Flickity (el, {
      cellSelector: this.cellName,
      cellAlign: 'left',
      draggable: false,
      pageDots: false,
      prevNextButtons: false,
      wrapAround: true,
      adaptiveHeight: false,
      bgLazyLoad: 1,
      autoPlay: 8000,
      pauseAutoPlayOnHover: false
    })
    this.featuredNewsData = Flickity.data(el)
    this.attachEvents()
    this.showFirstCell()
  }

  attachEvents() {
    this.featuredNews.on( 'select', () => {
      this.displayContent( this.featuredNewsData.selectedIndex )
    })
    this.$arrows.on('click', '.Flickity-prev', (event) => {
      event.preventDefault()
      this.featuredNews.previous()
    })
    .on('click', '.Flickity-next', (event) => {
      event.preventDefault()
      this.featuredNews.next()
    })
    // Pause flickity if user is navigating
    .hover(() => { this.featuredNews.pausePlayer() },
      () => { this.featuredNews.unpausePlayer() })
  }

  showFirstCell() {
    $('.FeaturedNews-body .news').eq(0).addClass('news--active')
  }

  displayContent( index ) {
    $('.FeaturedNews-body .news.news--active').removeClass('news--active')
    $('.FeaturedNews-body .news').eq(index).addClass('news--active')
  }
}
