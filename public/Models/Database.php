<?php
namespace Public\Models;

use Aura\SqlQuery\QueryFactory;
use PDO;

class Database{ 

    public $pdo;
    public $query;


    public function __construct(PDO $pdo, QueryFactory $query)
    {
        $this->pdo = $pdo;
        $this->query = $query;

    }

    public function getAll($table)
    {
        $select = $this->query->newSelect();
        $select->cols(["*"])->from($table); 
    
        $sql = $select->getStatement();
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
        return $results ?: [];
    }

    public function selectWhereId($table, $id)
    {   
        $sql = "SELECT * FROM $table WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
    
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getWhereCategory($table, $category)
    {
        $sql = "SELECT * FROM $table WHERE category = :category";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDefinitive($table, $column1 = null , $word = null)
    {
        $sql = "SELECT * FROM " . $table; // Базовый запрос

    if ($column1 !== null && $word !== null) {
        $sql .= " WHERE " . $column1 . " LIKE :word"; // Добавляем WHERE с LIKE
    }

    $stmt = $this->pdo->prepare($sql); // Подготавливаем запрос

    if ($column1 !== null && $word !== null) {
        $stmt->bindValue(':word', '%' . $word . '%'); // Привязываем значение с %
    }

    $stmt->execute(); // Выполняем запрос
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Извлекаем результаты

    return $results ?: []; // Возвращаем результаты, либо пустой массив
    }
}