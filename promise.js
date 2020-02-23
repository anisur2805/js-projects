const posts = [
  { title: "Book One", body: "Book One Content" },
  { title: "Book Two", body: "Book Two Content" }
];

function getPosts() {
  setTimeout(() => {
    let outpur = "";
    posts.forEach(post => {
      outpur += `<li>${post.title}</li>`;
    });
    document.body.innerHTML = outpur;
  }, 1000);
}

function createPost(post) {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      posts.push(post);

      const error = true;   // set false to get the correct output
      if (!error) {
        resolve();
      } else {
        reject("Error: Something wrong!");
      }
    }, 2000);
  });
}

// getPosts()
createPost({ title: "Book Three", body: "Book Three Content" })
  .then(getPosts)
  .catch(err => console.log(err));
