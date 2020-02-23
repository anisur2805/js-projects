document.getElementById("myForm").addEventListener("submit", saveBookmark);

function saveBookmark(event) {
  event.preventDefault();

  const siteName = document.querySelector("#siteName").value;
  const siteUrl = document.querySelector("#siteUrl").value;

  if (!validateForm(siteName, siteUrl)) {
    return false;
  }

  // console.log(siteName);

  const bookmark = {
    name: siteName,
    url: siteUrl
  };

  if (localStorage.getItem("bookmarks") === null) {
    const bookmarks = [];
    bookmarks.push(bookmark);
    localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
  } else {
    const bookmarks = JSON.parse(localStorage.getItem("bookmarks"));
    bookmarks.push(bookmark);
    localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
  }
  
  document.getElementById('myForm').reset()

  // Re-fetch Bookmarks
  fetchBookmarks();
}

function deleteBookmark(url) {
  const bookmarks = JSON.parse(localStorage.getItem("bookmarks"));

  for (let i = 0; i < bookmarks.length; i++) {
    if (bookmarks[i].url == url) {
      bookmarks.splice(i, 1);
    }
  }

  // Reset LocalStorage
  localStorage.setItem("bookmarks", JSON.stringify(bookmarks));

  // Re-fetch Bookmarks
  fetchBookmarks();
}

function fetchBookmarks() {
  const bookmarks = JSON.parse(localStorage.getItem("bookmarks"));

  const bookmarksResult = document.getElementById("bookmarksResults");

  bookmarksResult.innerHTML = "";
  for (let i = 0; i < bookmarks.length; i++) {
    let name = bookmarks[i].name;
    let url = bookmarks[i].url;

    bookmarksResult.innerHTML += `    
    <div class="card card-body bg-light mb-2">
      <h3>${name}</h3>
      <div class="btn-group" role="group">
      <a class="btn btn-primary" href="${url}" target="_blank">Visite</a>
      <a onclick="deleteBookmark('${url}')" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
    `;

    // bookmarksResult.innerHTML += '<div class="card card-body bg-light mb-2">'+
    // '<h3>'+name+'</h3>' +
    // '<a onclick="deleteBookmark(\''+url+'\')" href="">Delete</a>'+
    // '</div>'
  }
}

function validateForm(siteName, siteUrl) {
  if (!siteName || !siteUrl) {
    alert("Fill the all field");
    return false;
  }

  var expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
  var regex = new RegExp(expression);

  if (!siteUrl.match(regex)) {
    alert("Please use a valid URL");
    return false;
  }

  return true;
}
