<?php


namespace Controller;


use Library\Categories;
use Model\BookDB;
use Model\CategoriesDB;

class ControllerCategory
{
    protected $category;

    public function __construct()
    {
        $this->category = new CategoriesDB();
    }

    function show()
    {
        $categories = $this->category->getAll();
        include 'view/category/list.php';
    }

    function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $_SESSION['name'] = $_REQUEST['name'];
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];

            if (!checkInId($_SESSION['id'], $this->category->getId())) {
                $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                if ($_SESSION['checkImage'] == 'Upload file thành công') {
                    $student = new Categories($_SESSION['id'], $_SESSION['name'], $_SESSION['imageName']);
                    $this->category->add($student);
                    unset($_SESSION['id']);
                    unset($_SESSION['name']);
                    unset($_SESSION['imageName']);
                    unset($_SESSION['checkImage']);
                    header('Location: index.php?pages=category');
                } else {
                    header('Location: index.php?pages=category&actions=add');
                }
            } else {
                $_SESSION['id'] = '';
                $_SESSION['errorId'] = 'Id already exist!';
            }

        } else {
            include 'view/category/add.php';
        }
    }

    function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['id'] = $_REQUEST['id'];
            $image = $_FILES['image'];
            $_SESSION['imageName'] = $image['name'];
            $_SESSION['name'] = $_REQUEST['name'];

            if ($_SESSION['id'] == $_SESSION['oldId'] || !checkInId($_SESSION['id'], $this->category->getId())) {
                $_SESSION['checkImage'] = checkUploadImage($image, 'images/');
                if (($_SESSION['checkImage'] == 'Lỗi : File đã tồn tại.' && $_SESSION['imageName'] == $_SESSION['imageById']) || $_SESSION['checkImage'] == "Lỗi: Image is empty") {
                    $category = new Categories($_SESSION['id'], $_SESSION['name'], $_SESSION['imageById']);
                    update($this->category, $category, $_SESSION['oldId']);
                    header("Location: index.php?pages=category");
                } elseif ($_SESSION['checkImage'] == 'Upload file thành công') {
                    $category = new Categories($_SESSION['id'], $_SESSION['name'], $_SESSION['imageName']);
                    unlink('images/' . $_SESSION['imageById']);
                    update($this->category, $category, $_SESSION['oldId']);
                    header("Location: index.php?pages=category");
                } else {
                    header("Location: index.php?pages=category&actions=edit&id=" . $_SESSION['oldId']);
                }
            } else {
                if (checkInId($_SESSION['id'], $this->category->getId())) {
                    $_SESSION['id'] = '';
                    $_SESSION['errorId'] = 'Id already exist!';
                }
                header("Location: index.php?pages=category&actions=edit&id=".$_SESSION['oldId']);
            }
        } else {
            $id = $_REQUEST['id'];
            $_SESSION['oldId'] = $id;
            $categoryById = $this->category->get($id);
            $name = $categoryById->name;
            $_SESSION['imageById'] = $categoryById->image;
            include 'view/category/edit.php';
        }
    }

    function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_REQUEST['id'];
            $book = new BookDB();
            $book->changeCategoryUnknown($id);
            unlink('images/' . $this->category->getDataById('image', $id));
            $this->category->delete($id);
            header('Location: index.php?pages=category');
        } else {
            $id = $_REQUEST['id'];
            $categoryById = $this->category->get($id);
            include 'view/category/delete.php';
        }
    }

    function search()
    {
        $keyword = $_REQUEST['keyword'];
        $categories = $this->category->search($keyword);
        include 'view/category/list.php';
    }
}