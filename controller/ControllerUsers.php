<?php

namespace Controller;

use Model\UsersDB;

class ControllerUsers
{
    protected $user;

    public function __construct()
    {
        $this->user = new UsersDB();
    }

    public function registration()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_REQUEST['id'];
            $email = $_REQUEST['email'];
            $name = $_REQUEST['name'];
            $password = $_REQUEST['password'];
            $confirmPassword = $_REQUEST['confirmPassword'];
            $phone = $_REQUEST['phone'];
            $checkInfo = 0;
            $arrayUser = $this->user->getAll();

            if (checkId($id)) {
                $_SESSION['id'] = $id;
                $checkInfo++;
            } else {
                $_SESSION['id'] = '';
            }
            if (checkName($name)) {
                $_SESSION['name'] = $name;
                $checkInfo++;
            } else {
                $_SESSION['name'] = '';
            }
            if (checkEmail($email)) {
                $_SESSION['email'] = $email;
                $checkInfo++;
                foreach ($arrayUser as $item) {
                    if ($item->email == $email) {
                        $_SESSION['email'] = '';
                        $checkInfo--;
                        break;
                    }
                }
            } else {
                $_SESSION['email'] = '';
            }
            if (checkPassword($password)) {
                $_SESSION['password'] = $password;
                $checkInfo++;
            } else {
                $_SESSION['password'] = '';
            }
            if ($confirmPassword == $password) {
                $_SESSION['confirmPassword'] = $confirmPassword;
                $checkInfo++;
            } else {
                $_SESSION['confirmPassword'] = '';
            }
            if (checkPhoneNUmber($phone)) {
                $_SESSION['phone'] = $phone;
                $checkInfo++;
            } else {
                $_SESSION['phone'] = '';
            }
            if ($checkInfo == 6) {
                $user = new \Library\Users($id, $name, $email, $password, $phone);
                $this->user->add($user);
                $_SESSION['user'] = true;
                unset($_SESSION['id']);
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['confirmPassword']);
                unset($_SESSION['phone']);
                header('Location: index.php?pages=home');

            } else {
                header('Location: index.php?pages=user&actions=registration');
            }
        } else {
            include 'view/user/registration.php';
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // lay du lieu tu form login
            $email = $_REQUEST['email'];
            $password = $_REQUEST['password'];
            // check voi tren csdl
            $checkLogin = $this->user->login($email, $password);
            if ($checkLogin) {
                $_SESSION['user'] = true;
                // cho phep vao home
                header('location: index.php?pages=home');
            } else {
                $_SESSION['errorLogin'] = 'email or password incorrect';
                header('location: index.php?pages=user&actions=login');
            }
        } else {
            include 'view/user/login.php';
        }
    }

    function logout() {
        session_destroy();
        header('Location: index.php?pages=user&actions=login');
    }
    function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_REQUEST['username'];
            $phoneNumber = $_REQUEST['phoneNumber'];
            $arrayRetrievalInfo = $this->user->getRetrievalInfo();
            foreach ($arrayRetrievalInfo as $item) {
                if ($item['email'] == $username && $item['phone'] == $phoneNumber) {
                    $_SESSION['username'] = $username;
                }
            }
            if (isset($_SESSION['username'])) {
                header("Location: index.php?pages=user&actions=forgot&param=resetPassword");
            } else {
                include 'view/user/check.php';
            }
        } else {
            include 'view/user/check.php';
        }
    }
    function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
            $password = $_REQUEST['password'];
            $confirmPassword = $_REQUEST['confirmPassword'];
            $checkPassword = checkPassword($password);
            if ($checkPassword) {
                if ($password == $confirmPassword) {
                    $this->user->updatePasswordByEmail($_SESSION['username'], $password);
                    $_SESSION['user'] = true;
                    unset($_SESSION['username']);
                    header('Location: index.php?pages=home');
                } else {
                    $_SESSION['checkConfirmPassword'] = false;
                    include 'view/user/resetPassword.php';
                }
            } else {
                $_SESSION['checkPassword'] = false;
                include 'view/user/reset.php';
            }
        } else {
            include 'view/user/reset.php';
        }
    }
}
