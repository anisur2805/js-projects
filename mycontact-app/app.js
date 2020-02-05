let filterInput = document.querySelector('#filterInput');
filterInput.addEventListener('keyup', filterNames)

function filterNames(){
    // Get value of input
    let filterValue = document.querySelector('#filterInput').value.toUpperCase()
    console.log(filterValue);
    let ul = document.querySelector('#names')
    let li = ul.querySelectorAll('li.name-item')

    for(i=0; i<li.length; i++){
        let a = li[i].getElementsByTagName('a')[0]

        if(a.innerHTML.indexOf(filterValue) > -1) {
            li[i].style.display = ''
        }else{
            li[i].style.display = 'none'
        }
    }

}
