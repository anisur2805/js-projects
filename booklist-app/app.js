// Book Class: Represent a Book
class Book {
  constructor(title, author, isbn) {
    (this.title = title), (this.author = author), (this.isbn = isbn);
  }
}

// UI Class: Handle UI Tasks
class UI {
  static dislayBooks() {
    // Dummy book start
    /* const StoreBooks = [
      {
        title: "Book One",
        author: "John Deo",
        isbn: "1235478"
      },
      {
        title: "Book Two",
        author: "John Smith",
        isbn: "12354"
      }
    ];
    const books = StoreBooks; */
    // Dummy book end

    const books = Store.getBooks();
    books.forEach(book => UI.addToBookList(book));
  }

  static addToBookList(book) {
    const list = document.querySelector("#book-list");
    const row = document.createElement("tr");

    row.innerHTML = `
        <td>${book.title}</td>
        <td>${book.author}</td>
        <td>${book.isbn}</td>
        <td><a class="btn btn-danger btn-sm delete">X</a></td>
    `;

    list.appendChild(row);
  }

  static deleteBook(el) {
    if (el.classList.contains("delete")) {
      el.parentElement.parentElement.remove();
    }
  }

  static showAlert(message, className) {
    const div = document.createElement("div");
    div.className = `alert alert-${className}`;
    div.appendChild(document.createTextNode(message));
    const container = document.querySelector(".container");
    // console.log(container);
    const form = document.querySelector("#book-form");
    container.insertBefore(div, form);

    // Vanish alert in just 3 secons
    setTimeout(() => document.querySelector(".alert").remove(), 3000);
  }

  static clearFields() {
    document.querySelector("#title").value = "";
    document.querySelector("#author").value = "";
    document.querySelector("#isbn").value = "";
  }
}

// Store Class: handle Storage
class Store {
  static getBooks() {
    let books;
    if (localStorage.getItem("books") === null) {
      books = [];
    } else {
      books = JSON.parse(localStorage.getItem("books"));
    }

    return books;
  }

  static addBook(book) {
    const books = Store.getBooks();
    books.push(book);
    localStorage.setItem("books", JSON.stringify(books));
  }

  static removeBook(isbn) {
    const books = Store.getBooks();
    books.forEach((book, index) => {
      if (book.isbn === isbn) {
        books.splice(index, 1);
      }
    });

    localStorage.setItem("books", JSON.stringify(books));
  }
}

// Event: Display Books
document.addEventListener("DOMContentLoaded", UI.dislayBooks);

// Event: Add a Book
document.querySelector("#book-form").addEventListener("submit", e => {
  e.preventDefault();

  const title = document.querySelector("#title").value;
  const author = document.querySelector("#author").value;
  const isbn = document.querySelector("#isbn").value;

  if (title === "" || author === "" || isbn === "") {
    UI.showAlert("Please fill all fields!", "danger");
  } else {
    const book = new Book(author, title, isbn);
    // console.log(book);

    // Add Book ti UI
    UI.addToBookList(book);

    // Add book to store
    Store.addBook(book);

    UI.showAlert("Book Added!", "success");

    // Reset fields
    UI.clearFields();
  }
});

// Event: Remove a Book
document.querySelector("#book-list").addEventListener("click", e => {
  
  // Remove book from UI
  UI.deleteBook(e.target);

  // Remove book from Store
  Store.removeBook(e.target.parentElement.previousElementSibling.textContent)
  //   console.log(e.target);
  UI.showAlert("Book Removed", "success");
});
