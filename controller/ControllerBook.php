<?php


namespace Controller;


use Library\Books;
use Model\BookDB;
use Model\CategoriesDB;
use Model\DetailBorrowDB;

class ControllerBook
{
    protected $book;

    public function __construct()
    {
        $this->book = new BookDB();
    }

    function show()
    {
        $books = $this->book->getDBShow();
        include 'view/book/list.php';
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $_SESSION['name'] = $_REQUEST['name'];
            $_SESSION['author'] = $_REQUEST['author'];
            $_SESSION['price'] = $_REQUEST['price'];
            $_SESSION['producer'] = $_REQUEST['producer'];
            $_SESSION['amount'] = $_REQUEST['amount'];
            $_SESSION['category_id'] = $_REQUEST['category_id'];
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];
            $category = new CategoriesDB();
            $arrayObjectCategoryId = $category->getId();

            if (checkInId($_SESSION['category_id'], $arrayObjectCategoryId) && !checkInId($_SESSION['id'], $this->book->getId())) {
                $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                if ($_SESSION['checkImage'] == 'Upload file thành công') {
                    $book = new Books($_SESSION['id'], $_SESSION['name'], $_SESSION['category_id'], $_SESSION['author'], $_SESSION['price'], $_SESSION['imageName'], $_SESSION['producer'], $_SESSION['amount']);
                    $this->book->add($book);
                    unset($_SESSION['id']);
                    unset($_SESSION['name']);
                    unset($_SESSION['author']);
                    unset($_SESSION['price']);
                    unset($_SESSION['producer']);
                    unset($_SESSION['amount']);
                    unset($_SESSION['category_id']);
                    unset($_SESSION['imageName']);
                    unset($_SESSION['checkImage']);
                    header('Location: index.php?pages=book');
                } else {
                    header('Location: index.php?pages=book&actions=add');
                }
            } else {
                if (!checkInId($_SESSION['category_id'], $arrayObjectCategoryId)) {
                    $_SESSION['errorCategoryId'] = "Category Id don't already exists";
                }
                if (checkInId($_SESSION['id'], $this->book->getId())) {
                    $_SESSION['errorId'] = 'Id already exist!';
                }
                header('Location: index.php?pages=book&actions=add');
            }
        } else {
            include 'view/book/add.php';
        }
    }

    function edit()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $_SESSION['name'] = $_REQUEST['name'];
            $_SESSION['author'] = $_REQUEST['author'];
            $_SESSION['price'] = $_REQUEST['price'];
            $_SESSION['producer'] = $_REQUEST['producer'];
            $_SESSION['amount'] = $_REQUEST['amount'];
            $_SESSION['category_id'] = $_REQUEST['category_id'];
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];
            $category = new CategoriesDB();
            if (checkInId($_SESSION['category_id'], $category->getId())) {
                if ($_SESSION['id'] == $_SESSION['oldId'] || !checkInId($_SESSION['id'], $this->book->getId())) {
                    $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                    if (($_SESSION['checkImage'] == 'Lỗi : File đã tồn tại.' && $_SESSION['imageName'] == $_SESSION['imageById']) || $_SESSION['checkImage'] == "Lỗi: Image is empty") {
                        $book = new Books($_SESSION['id'], $_SESSION['name'], $_SESSION['category_id'], $_SESSION['author'], $_SESSION['price'], $_SESSION['imageById'], $_SESSION['producer'], $_SESSION['amount']);
                        update($this->book, $book, $_SESSION['oldId']);
                        header("Location: index.php?pages=book");
                    } elseif ($_SESSION['checkImage'] == 'Upload file thành công') {
                        $book = new Books($_SESSION['id'], $_SESSION['name'], $_SESSION['category_id'], $_SESSION['author'], $_SESSION['price'], $_SESSION['imageName'], $_SESSION['producer'], $_SESSION['amount']);
                        unlink('images/' . $_SESSION['imageById']);
                        update($this->book, $book, $_SESSION['oldId']);
                        header("Location: index.php?pages=book");
                    } else {
                        header("Location: index.php?pages=book&actions=edit&id=" . $_SESSION['oldId']);
                    }
                } else {
                    $_SESSION['id'] = '';
                    $_SESSION['errorId'] = 'Id already exist!';
                    header("Location: index.php?pages=book&actions=edit&id=" . $_SESSION['oldId']);
                }
            } else {
                $_SESSION['category_id'] = '';
                $_SESSION['errorCategoryId'] = 'Id category does not exist!';
                header("Location: index.php?pages=book&actions=edit&id=" . $_SESSION['oldId']);
            }

        } else {
            $id = $_REQUEST['id'];
            $_SESSION['oldId'] = $_REQUEST['id'];
            $books = $this->book->get($_SESSION['oldId']);
            $name = $books->name;
            $author = $books->author;
            $price = $books->price;
            $producer = $books->producer;
            $categoryId = $books->category_id;
            $amount = $books->number_of_books;
            $_SESSION['imageById'] = $books->image;
            include 'view/book/edit.php';
        }
    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_REQUEST['id'];
            $detail = new DetailBorrowDB();
            $detail->deleteBookId($id);
            $this->book->delete($id);
            header('Location: index.php?pages=book');
        } else {
            $id = $_REQUEST['id'];
            $book = $this->book->get($id);
            $name = $book->name;
            include 'view/book/delete.php';
        }
    }
    function search() {
        $keyword = $_REQUEST['keyword'];
        $books = $this->book->search($keyword);
        include 'view/book/list.php';
    }
}