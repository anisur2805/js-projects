document.querySelector('.columns').style.display = "none"

document.querySelector('#wcInput').addEventListener('input', function(e){
	let lbs = e.target.value

	document.querySelector('.columns').style.display = "block"

	document.querySelector('#grames').innerHTML = lbs/0.0022046
	document.querySelector('#kilo').innerHTML = lbs/2.2046
	document.querySelector('#ounce').innerHTML = lbs*16

})