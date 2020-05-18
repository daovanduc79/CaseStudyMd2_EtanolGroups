<?php


namespace Model;


class UsersDB extends LibraryDB
{
    public function __construct()
    {
        parent::__construct();
        $this->nameTable = 'users';
    }

    function add($user)
    {
        $id = $user->getId();
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $phone = $user->getPhone();
        $sql = "INSERT INTO $this->nameTable (id,name,email,password,phone) VALUES (?,?,?,?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $password);
        $stmt->bindParam(5, $phone);
        $stmt->execute();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM $this->nameTable WHERE email = ? AND password = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getRetrievalInfo() {
        $sql = 'SELECT email, phone FROM users;';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function updatePasswordByEmail($email, $password) {
        $sql = 'UPDATE users SET password = :password WHERE email = :email;';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    }
}