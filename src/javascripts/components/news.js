import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'

export default class News {
  constructor(el) {
    this.$el = $(el)
    this.$control = $(el).find('.ArchiveNews-control')

    // Others
    this.$loader = $(".Loader")
    this.resultArea = ".ArchiveNews-content"
    this.$resultArea = $(".ArchiveNews-content")
    this.$pagination = $(".Pagination-pages")
    this.$campusFilter = this.$el.find(".ArchiveNews-campusFilter")
    this.$dateFilter = this.$el.find(".ArchiveNews-dateFilter")
    this.totalPages = 1

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.ppp = options.ppp
    this.allCampuses = options.campuses
    this.appID = options.appId
    this.handle = options.handle
    this.emptyMsg = options.emptyMsg
    this.emptyImg = options.emptyImg

    // Get filters from URL & store them
    this.queryString = location.search
    let filters = getQueryParams()
    this.page = filters.pg === undefined ? '1' : filters.pg
    this.date = filters.date === undefined ? 'desc' : 'asc'
    this.campus = filters.campus === undefined ? 'all' : filters.campus
    this.willJump = this.queryString === "" ? false : true

    this.prepDropdown()
    this.attachEvents()
    this.fetchNews()
  }

  prepDropdown() {
    if (this.campus != 'all') {
      this.$campusFilter.val(this.campus);
    }
    this.$dateFilter.val(this.date);
    if (this.willJump) {
      window.scrollTo(0, 520)
    }
  }

  attachEvents() {
    this.$el.on('change', '.ArchiveNews-campusFilter, .ArchiveNews-dateFilter', () => {
      this.page = 1
      this.updateQueryStrings()
      this.fetchNews()
    })
    .on('click', '.Pagination-page', (event) => {
      // Pagination pages click
      event.preventDefault()
      this.page = $(event.target).data('page')
      this.updateQueryStrings()
      this.fetchNews()
    })
    .on('click', '.Pagination-nav', (event) => {
      // Prev and next pagination click
      event.preventDefault()
      let target = $(event.target).closest('.Pagination-nav')
      if (target.attr('class').indexOf('Pagination--active') !== -1) {
        // If this prev/next nav is active then go ahead
        this.page = target.data('page')
        this.updateQueryStrings()
        this.fetchNews()
      }
    })
  }

  updateQueryStrings() {
    this.campus = this.$campusFilter.val()
    this.date = this.$dateFilter.val()
    window.history.pushState(null, document.title, `?utf8=✓&date=${this.date}&campus=${this.campus}&pg=${this.page}` )
  }

  renderNews(data) {
    let template = $("#NewsObject").html()
    Mustache.parse(template)
    this.$resultArea.append( Mustache.render(template, data) )
  }

  paginate(totalPages) {
    for (let i=1; i<=totalPages; i++) {
      let qstring = paramReplace( location.search, 'page', i )
      if (i == this.page) {
        this.$pagination.append(`<a class="Pagination-page Pagination--active h6 medium" data-page="${i}">${i}</a>`)
      } else {
        this.$pagination.append(`<a class="Pagination-page h6 medium" data-page="${i}">${i}</a>`)
      }
    }
    if (totalPages > 1) {
      $(".Pagination-prev").attr('data-page', parseInt(this.page)-1)
      $(".Pagination-next").attr('data-page', parseInt(this.page)+1)
      if (this.page == 1) { // On first page
        $(".Pagination-prev").removeClass('Pagination--active').addClass('Pagination--inactive')
        $(".Pagination-next").removeClass('Pagination--inactive').addClass('Pagination--active')
        $(".Pagination-prev").removeAttr('href')
      } else if (this.page == totalPages) { // On last page
        $(".Pagination-next").removeClass('Pagination--active').addClass('Pagination--inactive')
        $(".Pagination-prev").removeClass('Pagination--inactive').addClass('Pagination--active')
        $(".Pagination-next").removeAttr('href')
      }
    } else { // If we're on the first and last page. Or total pages is 1
      $(".Pagination-prev, .Pagination-next").removeClass('Pagination--active').addClass('Pagination--inactive')
    }
  }

  fetchNews( isMore = false ) {
    let dataObject = {}
    dataObject.order = this.date
    dataObject.filter = {}
    dataObject.page = this.page
    dataObject.per_page = this.ppp

    // Set topic filter
    if (this.campus != 'all') {
      dataObject.filter.campus = this.campus
    }

    $.ajax({
      url: `${this.domain}/wp-json/wp/v2/news`,
      data: dataObject,
      type: "GET",
      dataType : "json",
      beforeSend: () => {
        this.$resultArea.toggleClass('ArchiveNews-content--fadeOut')
        this.$loader.toggleClass('Loader--fadeIn')
      }
    })
    .always( () => {
      this.$resultArea.empty()
      this.$pagination.empty()
      this.$loader.toggleClass('Loader--fadeIn')
      this.$resultArea.toggleClass('ArchiveNews-content--fadeOut')
    })
    .done( (data, status, xhr) => {
      if (data.length) {
        _.forEach(data, (news) => {
          let newsLink = news.link,
          newsTitle = news.title.rendered,
          facebook = encodeURI(`https://www.facebook.com/dialog/share?app_id=${this.appID}&display=popup&href=${newsLink}`),
          twitter = encodeURI(`https://twitter.com/intent/tweet?text=${newsTitle}&url=${newsLink}&via=${this.handle}`),
          image = news.acf.image,
          imageBase = image.base,
          imageTitle = image.title

          let templateVars = {
            id: news.id,
            title: news.title.rendered,
            link: news.link,
            date: moment(news.date).format('D MMM, Y'),
            campus: this.allCampuses[news.campus]['name'],
            facebook: facebook,
            twitter: twitter
          }

          // Do we have a teaser image selected?
          if (image == "") {
            // Fallback
            templateVars['image'] = this.emptyImg
          } else {
            templateVars['image'] = imageBase + 's400/' + imageTitle
          }
          this.renderNews(templateVars)
        })
        this.paginate(parseInt(xhr.getResponseHeader('x-wp-totalpages')))
      } else {
        this.renderNews({ empty: this.emptyMsg })
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderNews({ error: `${errorThrown}: ${status}` })
    })
  }
}
