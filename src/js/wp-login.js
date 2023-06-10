const footerElements = document.querySelectorAll('#nav, #backtoblog, .privacy-policy-page-link, .forgetmenot')

for (let key = 0; key < footerElements.length; key++) {
  footerElements[key].remove()
}
