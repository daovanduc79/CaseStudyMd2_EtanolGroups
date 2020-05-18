<?php


namespace Model;

use controllers\Borrow;
use PDO;

class BookDB extends LibraryDB
{
    public function __construct()
    {
        parent::__construct();
        $this->nameTable = 'books';
    }

    function getDBShow()
    {
        $sql = "SELECT books.id, books.image, books.name, books.author, books.number_of_books, categories.name AS nameCategory FROM books JOIN categories ON books.category_id = categories.id;";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    function add($book)
    {
        $id = $book->getId();
        $name = $book->getName();
        $author = $book->getAuthor();
        $price = $book->getPrice();
        $categoryId = $book->getCategoryId();
        $image = $book->getImage();
        $producer = $book->getProducer();
        $numberOfBooks = $book->getNumberOfBooks();

        $sql = 'insert into books (id,name,category_id,author,price,image,producer,number_of_books) values (?,?,?,?,?,?,?,?);';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $categoryId);
        $stmt->bindParam(4, $author);
        $stmt->bindParam(5, $price);
        $stmt->bindParam(6, $image);
        $stmt->bindParam(7, $producer);
        $stmt->bindParam(8, $numberOfBooks);
        $stmt->execute();
    }

    function update($oldId, $book)
    {
        $id = $book->getId();
        $name = $book->getName();
        $author = $book->getAuthor();
        $price = $book->getPrice();
        $categoryId = $book->getCategoryId();
        $image = $book->getImage();
        $producer = $book->getProducer();
        $numberOfBooks = $book->getNumberOfBooks();

        $sql = "UPDATE $this->nameTable SET id = ?, name = ?, category_id = ?, author = ?, price = ?, image = ?, producer = ?, number_of_books = ? WHERE id = '$oldId';";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $categoryId);
        $stmt->bindParam(4, $author);
        $stmt->bindParam(5, $price);
        $stmt->bindParam(6, $image);
        $stmt->bindParam(7, $producer);
        $stmt->bindParam(8, $numberOfBooks);
        $stmt->execute();
    }


    function borrowBook($id)
    {
        $amount = $this->getDataById('number_of_books', $id)->number_of_books;
        $amount -= 1;
        $sql = "UPDATE $this->nameTable SET number_of_books = $amount WHERE id = '$id';";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
    }

    function updateDoneBorrow($id)
    {
        $amount = $this->getDataById('number_of_books', $id)->number_of_books;
        $amount += 1;
        $sql = "UPDATE $this->nameTable SET number_of_books = $amount WHERE id = '$id';";
        $stmt = $this->conn->query($sql);
        $stmt->execute();
    }

    function getIdByCategory($category_id)
    {
        $sql = "SELECT id FROM $this->nameTable WHERE category_id = '$category_id';";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    function changeCategoryUnknown($category_id)
    {
        $ids = $this->getIdByCategory($category_id);
        foreach ($ids as $item) {
            $sql = "UPDATE $this->nameTable SET category_id = 'Category_999' WHERE id = '$item->id';";
            $this->conn->query($sql);
        }
    }

    function search($keyword)
    {
        $sql = "SELECT books.id, books.name, books.image, books.author, books.number_of_books, categories.name AS nameCategory FROM $this->nameTable LEFT JOIN categories ON books.category_id = categories.id WHERE books.id LIKE '%$keyword%' OR books.name LIKE '%$keyword%' OR books.author LIKE '%$keyword%' OR books.number_of_books LIKE '%$keyword%' OR categories.name LIKE '%$keyword%';";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}