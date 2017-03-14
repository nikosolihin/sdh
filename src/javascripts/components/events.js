import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'

export default class Events {
  constructor(el) {
    this.$el = $(el)
    this.$loader = $(".Loader")
    this.$resultArea = $(".ArchiveEvents-content")

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.allCampuses = options.campuses
    this.emptyMsg = options.emptyMsg

    // Get filters from URL & store them
    this.queryString = location.search
    let filters = getQueryParams()
    this.campus = filters.campus === undefined ? [] : filters.campus.split(',')
    this.willJump = this.queryString === "" ? false : true

    this.prepPills()
    this.attachEvents()
    this.fetchEvents()
  }

  prepPills() {
    _.forEach(this.campus, (campus) => {
      this.$el.find(".Pill[data-campus='" + campus + "']").toggleClass('Pill--on')
    })

    if (this.willJump) {
      // window.scrollTo(0, 1520)
    }
  }

  attachEvents() {
    this.$el.on('click', '.Pill', () => {
      $(event.target).toggleClass('Pill--on')
      this.updateQueryStrings()
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

  renderEvents(data) {
    let template = $("#EventObject").html()
    Mustache.parse(template)
    this.$resultArea.append( Mustache.render(template, data) )
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
        this.$resultArea.toggleClass('ArchiveEvents-content--fadeOut')
        this.$loader.toggleClass('Loader--fadeIn')
      }
    })
    .always( () => {
      this.$resultArea.empty()
      this.$loader.toggleClass('Loader--fadeIn')
      this.$resultArea.toggleClass('ArchiveEvents-content--fadeOut')
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
            this.$resultArea.append( `<div class="ArchiveEvent-resultGroup"><h3 class="h4 Lead">${month.month}</h3>` )
            _.forEach(month.events, (event) => {
              let templateVars = {
                id: event.acf.gcal.id,
                title: event.title.rendered,
                link: event.link,
                date: moment(event.date).format('D MMM, Y'),
                teaser: event.acf.gcal.description,
                campus: this.allCategories[event['categories']]['name']
              }
              this.renderEvents(templateVars, '.ArchiveEvent-resultGroup')
            })
            this.$resultArea.append( `</div>` )
          })

        console.log(groupedData)



      } else {
        this.renderEvents({ empty: this.emptyMsg })
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderEvents({ error: `${errorThrown}: ${status}` })
    })
  }
}
