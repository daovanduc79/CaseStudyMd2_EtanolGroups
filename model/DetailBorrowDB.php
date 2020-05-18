<?php


namespace Model;
use PDO;

class DetailBorrowDB extends LibraryDB
{
    public function __construct()
    {
        parent::__construct();
        $this->nameTable = 'detailBorrows';
    }

    function add($detailBorrow) {
        $bookId = $detailBorrow->getBookId();
        $borrowId = $detailBorrow->getBorrowId();
        $sql = "INSERT INTO $this->nameTable (book_id, borrow_id) VALUES (?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$bookId);
        $stmt->bindParam(2,$borrowId);
        $stmt->execute();
    }

    function deleteBookId($bookId) {
        $sql = "DELETE FROM $this->nameTable WHERE book_id = '$bookId';";
        $this->conn->query($sql);
    }
    function deleteBorrowId($borrowId) {
        $sql = "DELETE FROM $this->nameTable WHERE borrow_id = '$borrowId';";
        $this->conn->query($sql);
    }
    function getDetailBorrow($idBorrow)
    {
        $sql = "SELECT students.id AS idStudent, students.name AS nameStudent, students.email AS emailStudent, students.phone AS phoneStudent,
                borrows.id AS idBorrow, borrows.borrow_date AS borrowDate, borrows.return_date AS returnDate, borrows.pay_date AS payDate,
                books.id AS idBook, books.image AS imageBook, books.name AS nameBook, books.author AS authorBook, books.price AS priceBook,
                categories.name AS nameCategory
                FROM students
                JOIN borrows
                ON students.id = borrows.student_id
                JOIN detailBorrows
                ON borrows.id = detailBorrows.borrow_id
                JOIN books
                ON detailBorrows.book_id = books.id
                JOIN categories
                ON categories.id = books.category_id
                WHERE borrows.id = '$idBorrow';";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    function getBookId($borrowId) {
        $sql = "SELECT book_id FROM $this->nameTable WHERE borrow_id = $borrowId;";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}