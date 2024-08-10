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

    public function getAllPosts($table)
    {
        $select = $this->query->newSelect();
        $select->cols(["*"])->from("posts");  // Измените на "posts", если это название вашей таблицы
    
        // Выполняем запрос
        $sql = $select->getStatement();
    
        // Получаем результат
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Получаем все результаты как ассоциативный массив
    
        return $results; // Возвращаем результат
    }
}