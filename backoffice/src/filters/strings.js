import Vue from 'vue'

Vue.filter('title', function (str) {
  return str.split('_').map(function (item) {
    return item.charAt(0).toUpperCase() + item.substring(1)
  }).join(' ')
})

Vue.filter('boolean', value => value && parseInt(value) ? 'Yes' : 'No')

Vue.filter('booleanOrUndefined', value => {
  if (value === null || value === undefined) {
    return '-'
  }
  return value && parseInt(value) ? 'Yes' : 'No'
})

Vue.filter('truncate', (value, index = 10) => {
  if (value.length <= index) {
    return value
  }

  const truncated = value.slice(0, index - 3)

  return `${truncated}...`
})
