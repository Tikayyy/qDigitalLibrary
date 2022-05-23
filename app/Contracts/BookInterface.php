<?php

namespace App\Contracts;

interface BookInterface
{
    /**
     * @param string $search
     * @return object
     */
    public function search(string $search);

    /**
     * @param string $book_id
     * @return object
     */
    public function info(string $book_id);
}
