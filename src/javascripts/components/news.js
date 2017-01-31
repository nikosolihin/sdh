import _ from 'lodash'
import getQueryParams from '../lib/getQueryParams'
import paramReplace from '../lib/paramReplace'
import Mustache from 'mustache'
import moment from 'moment'

export default class Event {
  constructor(el) {
    this.$el = $(el)
    this.$control = $(el).find('.ArchiveNews-control')
    this.topicList = '.ArchiveNews-topics'
    this.$topicList = $(el).find(this.topicList)
    this.topicItem = '.ArchiveNews-topic'
    this.$dropdown = $(el).find('.ArchiveNews-topicsDropdown')
    this.showDropdown = 'ArchiveNews-topicsDropdown--show'
    this.isDown = false

    // Others
    this.$loader = $("#Loader")
    this.resultArea = ".ArchiveNews-content"
    this.$resultArea = $(".ArchiveNews-content")
    this.searchButton = ".ArchiveNews-search"
    this.$loadButton = this.$el.find(".ArchiveNews-load")

    // Data attribute options
    let options = this.$el.data('options')
    this.domain = options.domain
    this.ppp = options.ppp
    this.allTopics = options.topics
    this.appID = options.appId
    this.handle = options.handle
    this.emptyMsg = options.emptyMsg

    // Get filters from URL & store them
    let filters = getQueryParams()
    this.page = filters.page === undefined ? '1' : filters.page
    this.topic = filters.topic === undefined ? undefined : filters.topic
    this.willJump = filters.topic === undefined ? false : true

    this.prepDropdown()
    this.attachEvents()
    this.fetchNews()
  }

  prepDropdown() {
    // Populate dropdown
    _.forEach( this.allTopics, (topic) => {
      this.$dropdown.append(`<a href="" class="ArchiveNews-topic" data-topic-slug="${topic.slug}">${topic.name}</a>`)
    })
    // Assign active topic based on param
    if (this.topic) {
      let label = this.$dropdown.find(`[data-topic-slug='${this.topic}']`).text()
      this.$topicList.find('span').text(label)
    }
    if (this.willJump) {
      window.scrollTo(0, 1600)
    }
  }

  attachEvents() {
    $(document).on('click', (event) => {
      let target = $(event.target)
      if( target.is(this.topicList) || target.parents(this.topicList).length ) {
        // clicks within the dropdown or its children
        if (this.isDown) {
          // dropdown is shown
          this.closeDropdown()
        } else {
          // dropdown is hidden
          this.openDropdown()
        }
      }
      else if ( !target.is(this.topicList) && !target.parents(this.topicList).length && this.isDown ) {
        // clicks outside the dropdown
        this.closeDropdown()
      }
      else if ( target.is(this.topicItem) && this.isDown ) {
        this.closeDropdown()
      }
    })
    this.$dropdown.on('click', this.topicItem, (event) => {
      event.preventDefault()
      let slug = $(event.target).data('topic-slug'),
        name = $(event.target).text()
      this.$topicList.data('selectedTopic', slug).find('span').text(name)
    })
    this.$control.on('click', this.searchButton, (event) => {
      event.preventDefault()
      this.updateQueryStrings()
      this.fetchNews()
    })
    this.$loadButton.on('click', (event) => {
      event.preventDefault()
      this.page = parseInt(this.page) + 1
      this.updateQueryStrings()
      this.fetchNews(true)
    })
  }

  closeDropdown() {
    this.isDown = false
    this.$dropdown.removeClass(this.showDropdown)
  }

  openDropdown() {
    this.isDown = true
    this.$dropdown.addClass(this.showDropdown)
  }

  updateQueryStrings() {
    this.topic = this.$topicList.data('selectedTopic')
    // Update URL
    window.history.pushState(null, document.title, `?utf8=✓&topic=${this.topic}&page=${this.page}` )
  }

  fetchNews( isMore = false ) {
    let dataObject = {}
    dataObject.filter = {}
    dataObject.page = this.page
    dataObject.filter.posts_per_page = this.ppp

    // Set topic filter
    if (this.topic != 'all') {
      dataObject.filter.news_topic = this.topic
    }

    $.ajax({
      url: `${this.domain}/wp-json/wp/v2/news`,
      data: dataObject,
      type: "GET",
      dataType : "json",
      beforeSend: () => {
        this.$loadButton.hide()
        this.$resultArea.toggleClass('ArchiveNews-content--fadeOut')
        this.$loader.toggleClass('Loader--show')
      }
    })
    .always( () => {
      if (!isMore) {
        this.$resultArea.empty()
      }
      this.$loadButton.show()
      this.$loader.toggleClass('Loader--show')
      this.$resultArea.toggleClass('ArchiveNews-content--fadeOut')
    })
    .done( (data, status, xhr) => {
      if (data.length) {
        _.forEach(data, (news) => {
          let newsLink = news.link,
          newsTitle = news.title.rendered,
          facebook = encodeURI(`https://www.facebook.com/dialog/share?app_id=${this.appID}&display=popup&href=${newsLink}`),
          twitter = encodeURI(`https://twitter.com/intent/tweet?text=${newsTitle}&url=${newsLink}&via=${this.handle}`),
          authors = []

          _.forEach(news.acf.authors, (author) => {
            authors[authors.length] = author.post_title
          })

          let templateVars = {
            id: news.id,
            title: news.title.rendered,
            link: news.link,
            date: moment(news.date).format('D MMM, Y'),
            topic: this.allTopics[news['topics']]['name'],
            facebook: facebook,
            twitter: twitter,
            authors: authors.join(', ')
          }
          this.renderNews(templateVars)
        })
      } else {
        this.renderNews({ empty: this.emptyMsg })
      }
    })
    .fail( (xhr, status, errorThrown) => {
      this.renderNews({ error: `${errorThrown}: ${status}` })
    })
  }

  renderNews(data) {
    let template = $("#NewsObject").html()
    Mustache.parse(template)
    this.$resultArea.append( Mustache.render(template, data) )
  }
}
