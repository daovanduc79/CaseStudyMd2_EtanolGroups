<?php


namespace Library;


class DetailBorrows
{
    protected $bookId;
    protected $borrowId;
    public function __construct($bookId,$borrowId)
    {
        $this->bookId = $bookId;
        $this->borrowId = $borrowId;
    }

    /**
     * @return mixed
     */
    public function getBorrowId()
    {
        return $this->borrowId;
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }
}