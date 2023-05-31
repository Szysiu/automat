const rb = document.querySelectorAll('input[type="radio"]')
const amount = document.querySelector('#amount')
const button = document.querySelector('#btn')
const numButtons = document.querySelectorAll('.btn-custom')
const ordNumber = document.querySelector('#orderNumber')

button.addEventListener('click',function () {
    let value=0
    rb.forEach((rbtn)=>{
        if(rbtn.checked){
            value+=parseInt(rbtn.value)
        }
    })
    value+=parseInt(amount.value)
    amount.value=value
})

numButtons.forEach((button)=>{
    button.addEventListener('click',()=>{
        ordNumber.value+=button.value
    })
})