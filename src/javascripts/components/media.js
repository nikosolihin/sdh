import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'

export default class Media {
  constructor(el) {
    this.$el = $(el)
    this.$sidebar = $(el).find('.Sidebar')

    // Search field
    this.$search = this.$sidebar.find('input')

    // Others
    this.$loader = $("#Loader")
    this.$resultArea = $(".ArchiveMedia-result")
    this.searchButton = ".ArchiveMedia-search"
    this.$pagination = $(".Pagination-pages")

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.label = options.label
    this.ppp = options.ppp
    this.charLimit = options.charLimit
    this.allCategories = options.categories
    this.allTypes = options.types
    this.emptyMsg = options.emptyMsg

    // Get filters from URL & store them
    this.queryString = location.search
    let filters = getQueryParams()
    this.page = filters.page === undefined ? '1' : filters.page
    this.types = filters.types === undefined ? [] : filters.types.split(',')
    this.category = filters.category === undefined ? 'all' : filters.category
    // this.willJump = filters.page === undefined ? false : true

    this.prepSidebar()
    this.attachEvents()
    this.fetchMedia()
  }

  prepSidebar() {
    _.forEach( this.types, (type) => { // Media Type
      this.$sidebar.find(".Toggle-item[data-type-slug='"+ type +"']").toggleClass('Toggle-item--selected')
    })
    if (this.category != 'all') {
      let label = this.$sidebar.find(".Select-item[data-category-slug='"+ this.category +"']").text()
      this.$sidebar.find(".Select").data('selectedCategory', this.category).find('span').text(label)
    }
    // if (this.willJump) {
    //   window.scrollTo(0, 1050)
    // }
  }

  attachEvents() {
    this.$sidebar.on('click', this.searchButton, (event) => {
      event.preventDefault()
      this.updateQueryStrings()
      this.fetchMedia()
    })
    this.$pagination.on('click', '.Pagination-link', (event) => {
      event.preventDefault()
      window.scrollTo(0, 0)
      this.handlePagination( $(event.target).text() )
    })
    $(document).keypress( (event) => {
      if(event.which == 13) {
        event.preventDefault()
        this.updateQueryStrings()
        this.fetchEvents()
      }
    })
  }

  updateQueryStrings() {
    // Category
    this.category = this.$sidebar.find('.Select').data('selected-category')

    // Types
    this.types = []
    let typesString = ""
    _.forEach( this.$sidebar.find('.Toggle-item--selected'), (type) => {
      this.types[this.types.length] = $(type).data('type-slug')
    })
    if (this.types.length) {
      typesString = '&types='+this.types.join(',')
    }

    // Update URL
    window.history.pushState(null, document.title, `?utf8=✓&category=${this.category}${typesString}&page=1` )
  }

  fetchMedia() {
    let dataObject = {}
    dataObject.filter = {}
    dataObject.page = this.page
    dataObject.filter.posts_per_page = this.ppp

    // Set type filter
    if (this.types) {
      dataObject.filter.media_type = this.types.join(',')
    }

    // Set categories filter
    if (this.category != 'all') {
      dataObject.filter.media_category = this.category
    }

    $.ajax({
      url: `${this.domain}/wp-json/wp/v2/resources`,
      data: dataObject,
      type: "GET",
      dataType : "json",
      beforeSend: () => {
        this.$resultArea.toggleClass('ArchiveMedia-result--fadeOut')
        this.$loader.toggleClass('Loader--show')
      }
    })
    .always( () => {
      this.$resultArea.empty()
      this.$pagination.empty()
      this.$loader.toggleClass('Loader--show')
      this.$resultArea.toggleClass('ArchiveMedia-result--fadeOut')
    })
    .done( (data, status, xhr) => {
      if (data.length) {
        $(".Pagination--hidden").toggleClass('Pagination--hidden')
        let totalPages = parseInt(xhr.getResponseHeader('x-wp-totalpages'))

        _.forEach(data, (media) => {
          let templateVars = {
            title: media.title.rendered,
            link: media.link,
            date: moment(media.date).format('D MMM, Y'),
            teaser: media.acf.teaser.substring(0, this.charLimit)+'...',
            image: media.acf.image.url_n,
            label: this.label,
            type: this.allTypes[media['type']]['name'],
            slug: this.allTypes[media['type']]['slug'],
            color: this.allTypes[media['type']]['color'],
            category: this.allCategories[media['category']]['name'],
            top: this.allTypes[media['type']]['slug'] == 'document' ? 'top' : false
          }
          this.renderMedia(templateVars)
        })

        // Setup Pagination
        for (let i=1; i<=totalPages; i++) {
          let qstring = paramReplace( location.search, 'page', i )
          if (i == this.page) {
            this.$pagination.append(`<li class="Pagination--current"><a class="Pagination-link" href="${qstring}">${i}</a></li>`)
          } else {
            this.$pagination.append(`<li><a class="Pagination-link" href="${qstring}">${i}</a></li>`)
          }
        }
        if (totalPages > 1) { // Only show prev next if more than 1 page
          $(".Pagination").removeClass('Pagination--hidePrevNext')
          $(".Pagination-prev").attr('href', paramReplace( this.queryString, 'page', parseInt(this.page)-1))
          $(".Pagination-next").attr('href', paramReplace( this.queryString, 'page', parseInt(this.page)+1))
          if (this.page == 1) { // On first page
            $(".Pagination").toggleClass('Pagination--hidePrev')
            $(".Pagination-next").attr('href', paramReplace( this.queryString, 'page', parseInt(this.page)+1))
          } else if (this.page == totalPages) { // On last page
            $(".Pagination").toggleClass('Pagination--hideNext')
            $(".Pagination-next").attr('href', paramReplace( this.queryString, 'page', parseInt(this.page)-1))
          }
        }
      }
      else {
        this.renderMedia({ empty: this.emptyMsg })
        $(".Pagination").toggleClass('Pagination--hidden')
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderEvents({ error: `${errorThrown}: ${status}` })
      $(".Pagination").toggleClass('Pagination--hidden')
    })
  }

  renderMedia(data) {
    let template = $("#CardObject").html()
    Mustache.parse(template)
    this.$resultArea.append( Mustache.render(template, data) )
  }

  handlePagination(pageNum) {
    this.page = pageNum
    // Update URL
    window.history.pushState(null, document.title, paramReplace( location.search, 'page', pageNum) )
    this.fetchMedia()
  }
}
