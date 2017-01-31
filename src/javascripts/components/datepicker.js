import moment from 'moment'
import Pikaday from 'pikaday'

export default class Datepicker {
  constructor(el) {
    this.$el = $(el)
    this.picker = new Pikaday({
      i18n: {
        previousMonth : 'Previous Month',
        nextMonth     : 'Next Month',
        months        : ['January','February','March','April','May','June','July','August','Septembre','October','November','December'],
        weekdays      : ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
        weekdaysShort : ['S','M','T','W','T','F','S']
      },
      firstDay: 0,
      onSelect: function(date) {
        return picker.getMoment()
      }
    })
    this.$el.append(this.picker.el)
  }
}
