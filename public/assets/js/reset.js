const reset1 = document.querySelector('#reset1')
const reset2 = document.querySelector('#reset2')
const money = document.querySelector('#amount')
const code = document.querySelector('#orderNumber')
reset1.addEventListener('click', function () {
    money.value = 0
})

reset2.addEventListener('click', function () {
    code.value = ''
})