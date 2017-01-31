/*
  Automatically instantiates modules based on data-component attributes.
*/

const moduleElements = document.querySelectorAll('[data-component]')

for (var i = 0; i < moduleElements.length; i++) {
  const el = moduleElements[i]
  const name = el.getAttribute('data-component')
  const Module = require(`./${name}`).default
  new Module(el)
}
