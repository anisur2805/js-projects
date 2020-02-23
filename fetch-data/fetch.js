document.getElementById("getText").addEventListener("click", getText);
document.getElementById("getUsers").addEventListener("click", getUsers);
document.getElementById("getPosts").addEventListener("click", getPosts);
document.getElementById("addPost").addEventListener("submit", addPost);

// Get Text from txt file
function getText() {
  fetch("sample.txt")
    .then(res => res.text())
    .then(data => {
      document.getElementById("output").innerHTML = data;
    });
}

// Get Text from json file
function getUsers() {
  fetch("sample.json")
    .then(res => res.json())
    .then(data => {
      let output = "<h2>Users</h2>";
      data.forEach(user => {
        output += `
                <ul>
                    <li>ID: ${user.id}</li>
                    <li>Name: ${user.name}</li>
                    <li>Email: ${user.email}</li>
                </ul>
            `;
      });
      document.getElementById("output").innerHTML = output;
    });
}

// Get Posts from URL
function getPosts() {
  fetch("https://jsonplaceholder.typicode.com/posts")
    .then(res => res.json())
    .then(data => {
      let output = "<h2>Posts</h2>";
      data.forEach(post => {
        output += `
                <div>
                    <h3>Title: ${post.title}</h3>
                    <p>Body: ${post.body}</p>
                </div>
            `;
      });
      document.getElementById("output").innerHTML = output;
    });
}

// Add Post into URL
function addPost(e) {
  e.preventDefault();
  let title = document.getElementById("title").value;
  let body = document.getElementById("body").value;

  fetch("https://jsonplaceholder.typicode.com/posts", {
    method: "POST",
    headers: {
      Accept: "application/json, text/plain, */*",
      "Content-type": "application/json"
    },
    body:JSON.stringify({ title: title, body: body })
  })
    .then(res => res.json())
    .then(data => console.log(data));

  title = document.getElementById("title").value = "";
  body = document.getElementById("body").value = "";
}
