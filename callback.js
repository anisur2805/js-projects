const posts = [
    {title: "Book One", body: "Book One Content"},
    {title: "Book Two", body: "Book Two Content"}
]

function getPosts() {
    setTimeout(() => {
        let outpur = '';
        posts.forEach((post) => {
            outpur += `<li>${post.title}</li>`
        })
        document.body.innerHTML = outpur
    }, 1000)
}


function createPost(post, callback) {
    setTimeout(() => {
        posts.push(post)
        callback()
    }, 2000)
}

// getPosts()
createPost({title: "Book Three", body: "Book Three Content"}, getPosts)