document.getElementById("myForm").addEventListener("submit", saveBookmark);

function saveBookmark(event) {
  event.preventDefault();

  const siteName = document.querySelector("#siteName").value;
  const siteUrl = document.querySelector("#siteUrl").value;

  console.log(siteName);

  const bookmark = {
    name: siteName,
    url: siteUrl
  };

  if (localStorage.getItem("bookmarks") === null) {
    const bookmarks = [];
    bookmarks.push(bookmark);
    localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
  } else {      
      const bookmarks = JSON.parse(localStorage.getItem('bookmarks'))
      bookmarks.push(bookmark)
      localStorage.setItem("bookmarks", JSON.stringify(bookmarks));
  }
  localStorage.setItem("Test", "Hello World!");
}