let fact = document.querySelector('#fact')
let factText = document.querySelector('#factText')

let numberInput = document.querySelector('#numberInput')
numberInput.addEventListener('input', getFactAjax)

function getFactAjax(){
    let number = numberInput.value
    
    let xhr = new XMLHttpRequest()

    xhr.open('GET', 'http://numbersapi.com/'+number)

    xhr.onload = function(){
        if(this.status == 200 && number != ''){
            fact.style.display = 'block'
            factText.innerHTML = this.responseText
        }
    }
    xhr.send()
}