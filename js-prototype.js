// Constructor
// function Book(title, author, year) {
//     this.title = title;
//     this.author = author;
//     this.year = year;
//     this.getSummery = function(){
//         return `${title} was written by ${author} in ${year}`;
//     }
// }

function Book(title, author, year) {
  this.title = title;
  this.author = author;
  this.year = year;
}
Book.prototype.getSummery = function() {
  return `${this.title} was written by ${this.author} in ${this.year}`;
};

Book.prototype.getYears = function(){
    const years = new Date().getFullYear() - this.year;
    return `${this.title} was published ${years} years ago`;
}

const book1 = new Book("Book One", "Anisur", "2013");
console.log(book1);
console.log(book1.getYears());
