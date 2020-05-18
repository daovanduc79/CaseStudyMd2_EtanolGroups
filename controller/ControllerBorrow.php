<?php


namespace Controller;


use Library\Borrows;
use Library\DetailBorrows;
use Model\BookDB;
use Model\BorrowDB;
use Model\DetailBorrowDB;
use Model\StudentsDB;

class ControllerBorrow
{
    protected $borrow;

    public function __construct()
    {
        $this->borrow = new BorrowDB();
    }

    function show()
    {
        $borrows = $this->borrow->getAll();
        include 'view/borrow/list.php';
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $_SESSION['student_id'] = $_REQUEST['student_id'];
            $_SESSION['return_date'] = $_REQUEST['return_date'];
            $_SESSION['numberOfBooks'] = $_REQUEST['numberOfBooks'];
            $book = new BookDB();
            $detailBorrow = new DetailBorrowDB();
            $student = new StudentsDB();
            $checkBorrow = 0;
            $differentDate = strtotime($_SESSION['return_date']) - strtotime(date('Y-m-d'));
            if ($differentDate > 0) {
                $checkBorrow++;
            } else {
                $_SESSION['errorReturnDate'] = 'Error';
            }
            if ($student->getDataById('status', $_SESSION['student_id'])->status == 'Clean') {
                $checkBorrow++;
            } else {
                $_SESSION['errorStudent'] = 'Student does not enough condition borrow!';
            }
            if (!checkInId($_SESSION['id'], $this->borrow->getId())) {
                $checkBorrow++;
            } else {
                $_SESSION['errorId'] = 'Id already exist!';
            }
            if ($_REQUEST['countBooks'] > 0) {
                $idBooks = $book->getId();
                for ($i = 1; $i <= $_SESSION['numberOfBooks']; $i++) {
                    $_SESSION['idBook' . $i] = $_REQUEST['idBook' . $i];
                    if (checkInId($_SESSION['idBook' . $i], $idBooks)) {
                        if ($book->getDataById('number_of_books', $_SESSION['idBook' . $i])->number_of_books > 0) {
                            $checkBorrow++;
                        } else {
                            $_SESSION['errorBookId' . $i] = 'Out of books!';
                        }
                    } else {
                        $_SESSION['errorBookId' . $i] = "Id book does not exist!";
                    }
                }
                if ($checkBorrow == ($_SESSION['numberOfBooks'] + 3)) {
                    $borrow = new Borrows($_SESSION['id'], $_SESSION['student_id'], $_SESSION['return_date']);
                    $this->borrow->add($borrow);
                    for ($i = 1; $i <= $_SESSION['numberOfBooks']; $i++) {
                        $detail = new DetailBorrows($_SESSION['idBook' . $i], $_SESSION['id']);
                        $detailBorrow->add($detail);
                        $book->borrowBook($_SESSION['idBook' . $i]);
                    }
                    $student->updateStatus('Borrow', $_SESSION['student_id']);
                    unset($_SESSION['id']);
                    unset($_SESSION['student_id']);
                    unset($_SESSION['return_date']);
                    for ($i = 1; $i <= $_SESSION['numberOfBooks']; $i++) {
                        unset($_SESSION['idBook' . $i]);
                    }
                    unset($_SESSION['numberOfBooks']);
                    header('Location: index.php?pages=borrow');
                } else {
                    header('Location: index.php?pages=borrow&actions=add');
                }
            } else {
                header('Location: index.php?pages=borrow&actions=add');
            }
        } else {
            include 'view/borrow/add.php';
        }
    }

    function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_REQUEST['id'];
            $_SESSION['pay_date'] = $_REQUEST['pay_date'];
            $_SESSION['status'] = $_REQUEST['status'];
            $borrowDate = $_REQUEST['borrowDate'];
            $differentDate = strtotime($_SESSION['pay_date']) - strtotime(date($borrowDate));
            if ($differentDate > 0) {
                $detailBorrow = new DetailBorrowDB();
                $book = new BookDB();
                $student = new StudentsDB();
                if ($_SESSION['status'] == 'Done') {
                    foreach ($detailBorrow->getBookId($_SESSION['id']) as $item) {
                        $bookId = $item->book_id;
                        $book->updateDoneBorrow($bookId);
                    }
                    $studentId = $this->borrow->getDataById('student_id', $id);
                    $student->updateStatus('Clean', $studentId);
                    header('Location: index.php?pages=borrow');
                } else {
                    $_SESSION['errorStatus'] = 'Edit status';
                    header('Location: index.php?pages=borrow&actions=edit&id=' . $id);
                }

                $this->borrow->edit($id, $_SESSION['status'], $_SESSION['pay_date']);
            } else {
                $_SESSION['errorPayDate'] = 'Pay Date is invalid';
                header('Location: index.php?pages=borrow&actions=edit&id=' . $id);
            }
        } else {
            $id = $_REQUEST['id'];
            $borrow = $this->borrow->get($id);
            $payDate = $borrow->pay_date;
            $status = $borrow->status;
            $borrowDate = $borrow->borrow_date;
            include 'view/borrow/edit.php';
        }
    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_REQUEST['id'];
            $detailBorrow = new DetailBorrowDB();
            $detailBorrow->deleteBorrowId($id);
            $this->borrow->delete($id);
            header('Location: index.php?pages=borrow');
        } else {
            $id = $_REQUEST['id'];
            $borrow = $this->borrow->getDataById('name', $id);
            include 'view/borrow/delete.php';
        }
    }

    function search()
    {
        $keyword = $_REQUEST['keyword'];
        $borrows = $this->borrow->search($keyword);
        include 'view/borrow/list.php';
    }

    function detail()
    {
        $id = $_REQUEST['id'];
        $detailBorrow = new DetailBorrowDB();
        $detail = $detailBorrow->getDetailBorrow($id);
        include 'view/borrow/detail.php';
    }
}