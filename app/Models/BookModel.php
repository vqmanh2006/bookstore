<?php
namespace App\Models;

class BookModel
{
    public function latest($limit = 8)
    {
        $limit = max(1, (int) $limit);
        return \Database::GetData("SELECT * FROM books ORDER BY UpdatedAt DESC LIMIT $limit");
    }

    public function all($keyword = '')
    {
        $where = '';
        if ($keyword !== '') {
            $safe = addslashes($keyword);
            $where = "WHERE BookTitle LIKE '%$safe%'";
        }
        return \Database::GetData("SELECT * FROM books $where ORDER BY UpdatedAt");
    }

    public function find($isbn)
    {
        $safe = addslashes($isbn);
        return \Database::GetData(
            "SELECT * FROM books, languages, categories, publishes
             WHERE books.LanguageID = languages.LanguageID
               AND books.CategoryID = categories.CategoryID
               AND books.PublishID = publishes.PublishID
               AND ISBN = '$safe'",
            ['row' => 0]
        );
    }

    public function inCategory($categoryID)
    {
        $categoryID = (int) $categoryID;
        return \Database::GetData("SELECT * FROM books WHERE CategoryID = $categoryID ORDER BY UpdatedAt");
    }

    public function categoryName($categoryID)
    {
        $categoryID = (int) $categoryID;
        return \Database::GetData("SELECT CategoryName FROM categories WHERE CategoryID = $categoryID", ['row' => 0, 'cell' => 0]);
    }
}
