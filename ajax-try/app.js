document.getElementById("button").addEventListener("click", loadText)
function loadText(){
    var xhr = new XMLHttpRequest()

    // OPEN - type, url/file, async
    xhr.open('GET','sample.txt', true)
    xhr.onload = function(){
        if(this.status == 200) {
            console.log(this.responseText);
        }
    }
    xhr.send()
}