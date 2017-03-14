import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'

export default class Events {
  constructor(el) {
    this.$el = $(el)
    this.$loader = $(".Loader")
    this.$resultArea = $(".ArchiveEvents-result")
    this.$current = $('.ArchiveEvents-resultGroup--current')

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.allCampuses = options.campuses
    this.emptyMsg = options.emptyMsg
    this.buttonLabel = options.buttonLabel

    // Get filters from URL & store them
    this.queryString = location.search
    let filters = getQueryParams()
    this.campus = filters.campus === undefined ? 'all' : filters.campus
    this.willJump = this.queryString === "" ? false : true

    this.prepPills()
    this.attachEvents()
    this.fetchEvents()
  }

  prepPills() {
    if (this.campus == 'all') {
      this.$el.find(".Pill--all").toggleClass('Pill--on')
    } else {
      this.$el.find(".Pill[data-campus='" + campus + "']").toggleClass('Pill--on')
    }
    if (this.willJump) {
      window.scrollTo(0, 1520)
    }
  }

  attachEvents() {
    this.$el.on('click', '.Pill', (event) => {
      // Filter side
      $(".Pill--on").removeClass('Pill--on')
      $(event.target).toggleClass('Pill--on')

      // Result area side
      this.$current.find('.EventObject--collapse').toggleClass('EventObject--collapse')

      let campus = $(event.target).data('campus')
      if (campus !== 'all') {
        this.$current.find(".EventObject[data-campus!='" + campus + "']").toggleClass('EventObject--collapse')
      }
      this.updateQueryStrings()
    })
    .on('click', '.ArchiveEvents-navButton--prev', (event) => {
      let currentGroup = $('.ArchiveEvents-resultGroup--current'),
      prevGroup = $('.ArchiveEvents-resultGroup--current').prev()
      currentGroup.removeClass('ArchiveEvents-resultGroup--current')
      prevGroup.addClass('ArchiveEvents-resultGroup--current')
    })
    .on('click', '.ArchiveEvents-navButton--next', (event) => {
      let currentGroup = $('.ArchiveEvents-resultGroup--current'),
      nextGroup = $('.ArchiveEvents-resultGroup--current').next()
      currentGroup.removeClass('ArchiveEvents-resultGroup--current')
      nextGroup.addClass('ArchiveEvents-resultGroup--current')
    })
  }

  updateQueryStrings() {
    this.campus = []
    _.forEach(this.$el.find('.Pill--on'), (campus) => {
      this.campus[this.campus.length] = $(campus).data('campus')
    })
    let campus = this.campus.join(','),
      campusString = campus ? `&campus=${campus}` : ''

    // Update URL
    window.history.pushState(null, document.title, `?utf8=✓&campus=${this.campus}` )
  }

  fetchEvents() {
    let dataObject = {}
    dataObject.order = 'asc'

    // Set retreive 3 months back and forward
    let numMonths = 3

    let today = new Date(),
      year = today.getFullYear(),
      pastMonth = today.getMonth() - numMonths,
      futureMonth = today.getMonth() + (numMonths + 1),
      past = new Date(year, futureMonth, 0),
      future = new Date(year, pastMonth, 1)

    dataObject.before = moment(past).format()
    dataObject.after = moment(future).format()

    $.ajax({
      url: `${this.domain}/wp-json/wp/v2/events`,
      data: dataObject,
      type: "GET",
      dataType : "json",
      beforeSend: () => {
        this.$resultArea.toggleClass('ArchiveEvents-result--fadeOut')
        this.$loader.toggleClass('Loader--fadeIn')
      }
    })
    .always( () => {
      this.$resultArea.empty()
      this.$loader.toggleClass('Loader--fadeIn')
      this.$resultArea.toggleClass('ArchiveEvents-result--fadeOut')
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

        _.forEach(groupedData, (month) => {
          let today = new Date(),
            current = moment(today).format('MMMM YYYY'),
            isCurrent = month.month == current ? 'ArchiveEvents-resultGroup--current' : ''

          // Open wrapper div
          this.$resultArea.append(`<div class="ArchiveEvents-resultGroup ${isCurrent}" data-month="${month.month}">`)

          _.forEach(month.events, (event) => {
            let templateVars = {
              id: event.acf.gcal.id,
              title: event.title.rendered,
              link: event.link,
              month: moment(event.date).format('MMM'),
              day: moment(event.date).format('DD'),
              start: moment(event.acf.gcal.start.dateTime).format('kk:mm'),
              end: moment(event.acf.gcal.end.dateTime).format('kk:mm'),
              campus: this.allCampuses[event['campus']]['name'],
              slug: this.allCampuses[event['campus']]['slug'],
              location: event.acf.gcal.location,
              label: this.buttonLabel
            }
            this.renderEvents(templateVars, '.ArchiveEvents-resultGroup')
          })

          // Close wrapper div
          this.$resultArea.append(`</div>`)
        })
      } else {
        this.renderEvents({ empty: this.emptyMsg })
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderEvents({ error: `${errorThrown}: ${status}` })
    })
  }

  renderEvents(data, target) {
    let template = $("#EventObject").html()
    Mustache.parse(template)
    if (target) {
      this.$resultArea.find(target).last().append( Mustache.render(template, data) )
    } else {
      this.$resultArea.append( Mustache.render(template, data) )
    }
  }
}
