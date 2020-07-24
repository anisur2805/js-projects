const getName = new Promise ( ( resolve ) => {
	return resolve( 'Anisur Rahman' )
})

const getAge = ( name ) => {
	return new Promise( (resolve, reject ) => {
		if( name === 'Anisur Rahman' ) {
			resolve( 25 )
		} else {
			reject( 'Not Found!' )
		}
	})
}

getName.then( (name) => {
	getAge( name ).then( (age) => {
		console.log( `My name is ${name} and I am ${age} years old!` )
	})
})

// with async await

const getDetails = async() => {
	const name = await getName
	const age = await getAge( name )

	console.log( `Details about me: My name is ${name} and I am ${age} years old!` )
}
getDetails()


// ajax text

var loadPosts = document.getElementById('btn-click-me');
var box = document.getElementById('box');
var uList = document.createElement('ul');

loadPosts.addEventListener('click', function() {
   var request = new XMLHttpRequest();
   request.open('GET', 'https://jsonplaceholder.typicode.com/posts', true);
   request.send();
   request.onreadystatechange = function handleRequest(){
      if(request.readyState === 4 && request.status === 200) {
         var data = JSON.parse(request.responseText);
         data.forEach(function(singleData) {
           var list = document.createElement('li');
		   list.className = 'hahahaha'
           var desc = document.createElement('p');
           list.textContent = singleData.title;
           desc.textContent = singleData.body;
           uList.appendChild(list)
		   list.appendChild(desc)
         })
         box.insertAdjacentElement('beforeend', uList);
      }
   }
});