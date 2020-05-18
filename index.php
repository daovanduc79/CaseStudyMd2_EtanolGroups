<?php


use Controller\ControllerCategory;
use Controller\ControllerHome;
use Controller\ControllerUsers;

session_start();
include 'class/Books.php';
include 'class/Borrows.php';
include 'class/Categories.php';
include 'class/Students.php';
include 'class/Users.php';
include 'class/DetailBorrows.php';

include 'controller/ControllerUsers.php';
include 'controller/ControllerHome.php';
include 'controller/ControllerCategory.php';
include 'controller/ControllerBook.php';
include 'controller/ControllerStudent.php';
include 'controller/ControllerBorrow.php';

include 'model/ConnectionDB.php';
include 'model/LibraryDB.php';
include 'model/BookDB.php';
include 'model/StudentsDB.php';
include 'model/UsersDB.php';
include 'model/CategoriesDB.php';
include 'model/BorrowDB.php';
include 'model/DetailBorrowDB.php';

include 'support/function.php';

$user = new ControllerUsers();
$home = new ControllerHome();
$category = new ControllerCategory();
$book = new \Controller\ControllerBook();
$student = new \Controller\ControllerStudent();
$borrow = new \Controller\ControllerBorrow();

if (isset($_REQUEST['pages'])) {
    switch ($_REQUEST['pages']) {
        case 'user':
            checkTrueLogin();
            if (isset($_REQUEST['actions'])) {
                switch ($_REQUEST['actions']) {
                    case 'login':
                        checkTrueLogin();
                        $user->login();
                        break;
                    case 'registration':
                        checkTrueLogin();
                        $user->registration();
                        break;
                    case 'logout':
                        $user->logout();
                        break;
                    case 'forgot':
                        checkTrueLogin();
                        if (isset($_REQUEST['param'])) {
                            switch ($_REQUEST['param']) {
                                case 'resetPassword':
                                    $user->resetPassword();
                                    break;
                                default:
                                    $user->forgotPassword();
                            }
                        } else {
                            $user->forgotPassword();
                        }
                        break;
                    default:
                        checkTrueLogin();
                        $user->login();
                }
            } else {
                $user->login();
            }
            break;
        case 'category':
            checkFalseLogin();
            if (isset($_REQUEST['actions'])) {
                switch ($_REQUEST['actions']) {
                    case 'add':
                        $category->add();
                        break;
                    case 'edit':
                        if (isset($_REQUEST['id'])) {
                            $category->edit();
                        } else {
                            header('Location: index.php?pages=category');
                        }
                        break;
                    case 'delete':
                        if (isset($_REQUEST['id'])) {
                            $category->delete();
                        } else {
                            header('Location: index.php?pages=category');
                        }
                        break;
                    case 'search':
                        if (isset($_REQUEST['keyword'])) {
                            $category->search();
                        } else {
                            header('Location: index.php?pages=category');
                        }
                        break;
                    default:
                        header('Location: index.php?pages=category');
                }
            } else {
                $category->show();
            }
            break;
        case 'book':
            checkFalseLogin();
            if (isset($_REQUEST['actions'])) {
                switch ($_REQUEST['actions']) {
                    case 'add':
                        $book->add();
                        break;
                    case 'edit':
                        if (isset($_REQUEST['id'])) {
                            $book->edit();
                        } else {
                            header('Location: index.php?pages=book');
                        }
                        break;
                    case 'delete':
                        if (isset($_REQUEST['id'])) {
                            $book->delete();
                        } else {
                            header('Location: index.php?pages=book');
                        }
                        break;
                    case 'search':
                        if (isset($_REQUEST['keyword'])) {
                            $book->search();
                        } else {
                            header('Location: index.php?pages=book');
                        }
                        break;
                    default :
                        header('Location: index.php?pages=book');
                }
            } else {
                $book->show();
            }
            break;
        case 'student':
            checkFalseLogin();
            if (isset($_REQUEST['actions'])) {
                switch ($_REQUEST['actions']) {
                    case 'add':
                        $student->add();
                        break;
                    case 'edit':
                        if (isset($_REQUEST['id'])) {
                            $student->edit();
                        } else {
                            header('Location: index.php?pages=student');
                        }
                        break;
                    case 'delete':
                        if (isset($_REQUEST['id'])) {
                            $student->delete();
                        } else {
                            header('Location: index.php?pages=student');
                        }
                        break;
                    case 'search':
                        if (isset($_REQUEST['keyword'])) {
                            $student->search();
                        } else {
                            header('Location: index.php?pages=student');
                        }
                        break;
                    default :
                        header('Location: index.php?pages=student');
                }
            } else {
                $student->show();
            }
            break;
        case 'borrow':
            checkFalseLogin();
            if (isset($_REQUEST['actions'])) {
                switch ($_REQUEST['actions']) {
                    case 'add':
                        $borrow->add();
                        break;
                    case 'edit':
                        if (isset($_REQUEST['id'])) {
                            $borrow->edit();
                        } else {
                            header('Location: index.php?pages=borrow');
                        }
                        break;
                    case 'detail':
                        if (isset($_REQUEST['id'])) {
                            $borrow->detail();
                        } else {
                            header('Location: index.php?pages=borrow');
                        }
                        break;
                    case 'delete':
                        if (isset($_REQUEST['id'])) {
                            $borrow->delete();
                        } else {
                            header('Location: index.php?pages=borrow');
                        }
                        break;
                    case 'search':
                        if (isset($_REQUEST['keyword'])) {
                            $borrow->search();
                        } else {
                            header('Location: index.php?pages=borrow');
                        }
                        break;
                    default:
                        header('Location: index.php?pages=borrow');
                }
            } else {
                $borrow->show();
            }
            break;
        case 'home':
            checkFalseLogin();
            $home->show();
            break;
        default:
            checkTrueLogin();
            $user->login();
    }
} else {
    checkFalseLogin();
    $home->show();
}

