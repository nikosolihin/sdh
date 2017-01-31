import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'
import Pikaday from 'pikaday'

export default class Event {
  constructor(el) {
    this.$el = $(el)
    this.$sidebar = $(el).find('.Sidebar')

    // Datepicker
    this.$datepicker = this.$sidebar.find('.Datepicker')
    this.picker = new Pikaday({
      firstDay: 0
    })
    this.$datepicker.append(this.picker.el)

    // Search field
    this.$search = this.$sidebar.find('input')

    // Others
    this.$loader = $("#Loader")
    this.$resultArea = $(".ArchiveEvent-result")
    this.searchButton = ".ArchiveEvent-search"
    this.$pagination = $(".Pagination-pages")

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.label = options.label
    this.ppp = options.ppp
    this.allCategories = options.categories
    this.emptyMsg = options.emptyMsg

    // Get filters from URL & store them
    this.queryString = location.search
    let filters = getQueryParams()
    this.page = filters.page === undefined ? '1' : filters.page
    this.categories = filters.categories === undefined ? [] : filters.categories.split(',')
    this.date = filters.date === undefined ? 'any' : filters.date
    this.keyword = filters.q === undefined ? undefined : encodeURI(filters.q)
    this.willJump = filters.page === undefined ? false : true

    this.prepSidebar()
    this.attachEvents()
    this.fetchEvents()
  }

  prepSidebar() {
    if (this.date != 'any') {
      this.picker.setMoment(moment(this.date, 'YYYY-MM-DD'))
    }
    if (this.keyword) {
      this.$search.val( decodeURI(this.keyword) )
    }
    _.forEach( this.categories, (category) => { // Categories
      this.$sidebar.find(".Pill[data-category-slug='"+ category +"']").toggleClass('Pill--inactive')
    })
    if (this.willJump) {
      window.scrollTo(0, 1050)
    }
  }

  attachEvents() {
    this.$sidebar.on('click', this.searchButton, (event) => {
      event.preventDefault()
      this.updateQueryStrings()
      this.fetchEvents()
    })
    .on('click', '.Datepicker-clear', (event) => {
      event.preventDefault()
      this.picker.setDate(null)
    })
    .on('click', '.Pill-clear', (event) => {
      event.preventDefault()
      this.$sidebar.find('.Pill').addClass('Pill--inactive')
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
    // Date
    if(this.$datepicker.find('td.is-selected').length != 0) {
      this.date = this.picker.getMoment().format('YYYY-MM-DD')
    } else {
      this.date = 'any'
    }

    // Keyword
    this.keyword = encodeURI(this.$search.val())

    // Categories
    this.categories = []
    _.forEach( this.$sidebar.find('.Pill').not('.Pill--inactive'), (category) => {
      this.categories[this.categories.length] = $(category).data('category-slug')
    })
    let categories = this.categories.join(','),
      categoriesString = categories ? `&categories=${categories}` : ''

    // Update URL
    window.history.pushState(null, document.title, `?utf8=✓&q=${this.keyword}&date=${this.date}${categoriesString}&page=${this.page}` )
  }

  fetchEvents() {
    let dataObject = {}
    dataObject.order = 'asc'
    dataObject.filter = {}
    dataObject.page = this.page
    dataObject.filter.posts_per_page = this.ppp

    // Set search filter
    if (this.keyword) {
      dataObject.search = this.keyword
    }

    // Set categories filter
    if (this.categories) {
      dataObject.filter.event_category = this.categories.join(',')
    }

    // Set date filter
    if (this.date != 'any' || this.date === undefined ) {
      dataObject.filter.meta_compare = 'LIKE'
      dataObject.filter.meta_key = 'id'
      dataObject.filter.meta_value = this.date
    } else {
      dataObject.after = moment(new Date()).format()
    }

    $.ajax({
      url: `${this.domain}/wp-json/wp/v2/events`,
      data: dataObject,
      type: "GET",
      dataType : "json",
      beforeSend: () => {
        this.$resultArea.toggleClass('ArchiveEvent-result--fadeOut')
        this.$loader.toggleClass('Loader--show')
      }
    })
    .always( () => {
      this.$resultArea.empty()
      this.$pagination.empty()
      this.$loader.toggleClass('Loader--show')
      this.$resultArea.toggleClass('ArchiveEvent-result--fadeOut')
    })
    .done( (data, status, xhr) => {
      if (data.length) {
        // Group by month
        let groupedData = _.chain(data)
          .groupBy( (item) => {
            return moment(item.date).format('MMMM YYYY')
          })
          .toPairs()
          .map( (item) => {
            return _.zipObject(["month", "events"], item)
          })
          .value()

        $(".Pagination--hidden").toggleClass('Pagination--hidden')
        let totalPages = parseInt(xhr.getResponseHeader('x-wp-totalpages'))

        _.forEach(groupedData, (month) => {
          this.$resultArea.append( `<div class="ArchiveEvent-resultGroup"><h3 class="h4 Lead">${month.month}</h3>` )
          _.forEach(month.events, (event) => {
            let templateVars = {
              id: event.acf.gcal.id,
              title: event.title.rendered,
              link: event.link,
              date: moment(event.date).format('D MMM, Y'),
              teaser: event.acf.gcal.description,
              image: event.acf.image.url_n,
              label: this.label,
              category: this.allCategories[event['categories']]['name'],
              color: this.allCategories[event['categories']]['color']
            }
            this.renderEvents(templateVars, '.ArchiveEvent-resultGroup')
          })
          this.$resultArea.append( `</div>` )
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
      } else {
        this.renderEvents({ empty: this.emptyMsg })
        $(".Pagination").toggleClass('Pagination--hidden')
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderEvents({ error: `${errorThrown}: ${status}` })
      $(".Pagination").toggleClass('Pagination--hidden')
    })
  }

  renderEvents(data, target) {
    let template = $("#MediaObject").html()
    Mustache.parse(template)
    if (target) {
      this.$resultArea.find(target).last().append( Mustache.render(template, data) )
    } else {
      this.$resultArea.append( Mustache.render(template, data) )
    }
  }

  handlePagination(pageNum) {
    this.page = pageNum
    // Update URL
    window.history.pushState(null, document.title, paramReplace( location.search, 'page', pageNum) )
    this.fetchEvents()
  }
}
