// Book Class: Represent a Book
class Book {
  constructor(title, author, isbn) {
    (this.title = title), (this.author = author), (this.isbn = isbn);
  }
}

// UI Class: Handle UI Tasks
class UI {
  static dislayBooks() {
    const StoreBooks = [
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

    const books = StoreBooks;
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

  static clearFields() {
    document.querySelector("#title").value = "";
    document.querySelector("#author").value = "";
    document.querySelector("#isbn").value = "";
  }
}

// Store Class: handle Storage

// Event: Display Books
document.addEventListener("DOMContentLoaded", UI.dislayBooks);

// Event: Add a Book
document.querySelector("#book-form").addEventListener("submit", e => {
  e.preventDefault();

  const title = document.querySelector("#title").value;
  const author = document.querySelector("#author").value;
  const isbn = document.querySelector("#isbn").value;

  const book = new Book(author, title, isbn);
  console.log(book);

  // Add Book ti UI
  UI.addToBookList(book);

  // Reset fields
  UI.clearFields();
});

// Event: Remove a Book
document.querySelector("#book-list").addEventListener("click", e => {
  UI.deleteBook(e.target)
//   console.log(e.target);
});
