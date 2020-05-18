<?php


namespace Model;

use PDO;
class CategoriesDB extends LibraryDB
{
    public function __construct()
    {
        parent::__construct();
        $this->nameTable = 'categories';
    }

    function add($category)
    {
        $id = $category->getId();
        $name = $category->getName();
        $image = $category->getImage();
        $sql = "INSERT INTO $this->nameTable (id,name,image) VALUES (?,?,?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $image);
        $stmt->execute();
    }

    function update($idOld, $category)
    {
        $id = $category->getId();
        $name = $category->getName();
        $image = $category->getImage();
        $sql = "UPDATE $this->nameTable SET id = ?, name = ?, image = ? WHERE id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $image);
        $stmt->bindParam(4, $idOld);
        $stmt->execute();
    }

    function search($keyword) {
        $sql = "SELECT * FROM $this->nameTable WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%';";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}