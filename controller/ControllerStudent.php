<?php


namespace Controller;


use Library\Students;
use Model\BorrowDB;
use Model\DetailBorrowDB;
use Model\StudentsDB;

class ControllerStudent
{
    protected $student;

    public function __construct()
    {
        $this->student = new StudentsDB();
    }

    function show()
    {
        $students = $this->student->getAll();
        include 'view/student/list.php';
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];
            $_SESSION['id'] = $_REQUEST['id'];
            $_SESSION['name'] = $_REQUEST['name'];
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['birthDay'] = $_REQUEST['birthDay'];
            $_SESSION['address'] = $_REQUEST['address'];
            if (!checkInId($_SESSION['id'],$this->student->getId())) {
                $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                if ($_SESSION['checkImage'] == 'Upload file thành công') {
                    $student = new Students($_SESSION['id'], $_SESSION['name'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['address'], $_SESSION['birthDay'], $_SESSION['imageName']);
                    $this->student->add($student);
                    unset($_SESSION['id']);
                    unset($_SESSION['name']);
                    unset($_SESSION['email']);
                    unset($_SESSION['phone']);
                    unset($_SESSION['birthDay']);
                    unset($_SESSION['address']);
                    unset($_SESSION['imageName']);
                    unset($_SESSION['checkImage']);
                    header('Location: index.php?pages=student');
                } else {
                    header('Location: index.php?pages=student&actions=add');
                }
            } else {
                $_SESSION['id'] = '';
                $_SESSION['errorId'] = 'Id already exist!';
                header('Location: index.php?pages=student&actions=add');
            }
        } else {
            include 'view/student/add.php';
        }
    }

    function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];
            $_SESSION['name'] = $_REQUEST['name'];
            $_SESSION['email'] = $_REQUEST['email'];
            $_SESSION['phone'] = $_REQUEST['phone'];
            $_SESSION['birthDay'] = $_REQUEST['birthDay'];
            $_SESSION['address'] = $_REQUEST['address'];
            $_SESSION['status'] = $_REQUEST['status'];


            if (($_SESSION['id'] == $_SESSION['oldId'] || !checkInId($_SESSION['id'], $this->student->getAll()))) {
                $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                if (($_SESSION['checkImage'] == 'Lỗi : File đã tồn tại.' && $_SESSION['imageName'] == $_SESSION['imageById']) || $_SESSION['checkImage'] == "Lỗi: Image is empty") {
                    $student = new Students($_SESSION['id'], $_SESSION['name'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['address'], $_SESSION['birthDay'], $_SESSION['imageById']);
                    $student->setStatus($_SESSION['status']);
                    update($this->student, $student, $_SESSION['oldId']);
                    header("Location: index.php?pages=student");
                } elseif ($_SESSION['checkImage'] == 'Upload file thành công') {
                    $student = new Students($_SESSION['id'], $_SESSION['name'], $_SESSION['email'], $_SESSION['phone'], $_SESSION['address'], $_SESSION['birthDay'], $_SESSION['imageName']);
                    $student->setStatus($_SESSION['status']);
                    unlink('images/' . $_SESSION['imageById']);
                    update($this->student, $student, $_SESSION['oldId']);
                    header("Location: index.php?pages=student");
                } else {
                    header("Location: index.php?pages=student&actions=edit&id=" . $_SESSION['oldId']);
                }
            } else {
                $_SESSION['id'] = '';
                $_SESSION['showError'] = 'Id already exists!';
                header("Location: index.php?pages=student&actions=edit&id=" . $_SESSION['oldId']);
            }
        } else {
                $_SESSION['oldId'] = $_REQUEST['id'];
                $studentById = $this->student->get($_SESSION['oldId']);
                $name = $studentById->name;
                $email = $studentById->email;
                $phone = $studentById->phone;
                $birthDay = $studentById->birthday;
                $address = $studentById->address;
                $status = $studentById->status;
                $_SESSION['imageById'] = $studentById->image;
                include 'view/student/edit.php';
        }
    }

    function search()
    {
        $keyword = $_REQUEST['keyword'];
        $students = $this->student->search($keyword);
        include 'view/student/list.php';
    }
    function delete() {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $id = $_REQUEST['id'];
            $borrow = new BorrowDB();
            $detailBorrow = new DetailBorrowDB();
            $borrowId = $borrow->getIdByStudentId($id);
            foreach ($borrowId as $item) {
                $detailBorrow->deleteBorrowId($item->id);
                $borrow->delete($item->id);
            }
            $this->student->delete($id);
            header('Location: index.php?pages=student');
        } else {
            $id = $_REQUEST['id'];
            $name = $this->student->getDataById('name',$id);
            include 'view/student/delete.php';
        }
    }
}