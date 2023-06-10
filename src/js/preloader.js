window.addEventListener('load', () => {
  setTimeout(() => {
    document.getElementById('preloader').style.display = 'none'
    const obj = document.querySelectorAll('html,body')
    for (let key = 0; key < obj.length; ++key) {
      obj[key].style.overflowY = 'visible'
    }
  }, 350)
})
