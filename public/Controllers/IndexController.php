<?php
namespace Public\Controllers;
use PDO;
use Public\Models\Database;
use Laminas\Diactoros\Response\HtmlResponse;
use Aura\SqlQuery\QueryFactory;
use League\Plates\Engine;
use Laminas\Diactoros\Response\JsonResponse;

class IndexController {

    public $db;
    public $view;   

    public function __construct(PDO $pdo, QueryFactory $query, Engine $view)
    {
        $this->db = new Database($pdo, $query);
        $this->view = $view;
    }

    public function index()
    {
        $cards = $this->db->getAll("cards");
        // $images = $this->db->getAll("images");
        $categories = $this->db->getAll("categories");
        $responseContent = '';
        $responseContent = $this->view->render('home', ["cards" => $cards, "categories" => $categories]);
        return new HtmlResponse($responseContent);
    }

    public function about()
    {
        $responseContent = $this->view->render('about');
        return new HtmlResponse($responseContent);
    }

    public function services()
    {
        $services = $this->db->getAll("services");
        $responseContent = $this->view->render('services', ['services' => $services]);
        return new HtmlResponse($responseContent);
    }

    public function news()
    {
        $news = $this->db->getAll("news");
        $responseContent = $this->view->render('news', ['news' => $news]);
        return new HtmlResponse($responseContent);
    }



    public function getCategory()
    {  
        $data = json_decode(file_get_contents('php://input'), true); // Decode JSON input
    if (!isset($data['id'])) {
        return new JsonResponse(['error' => 'Invalid request'], 400); // Bad request if ID is not provided
    }

    if ($data['id'] === "*") {
        $exactlyCards = $this->db->getAll("cards");
        return new JsonResponse(['status' => 201, 'data' => $exactlyCards], 201);
    }else{
        $category = $this->db->selectWhereId("categories", $data['id']);
    
        if (!$category) {
            return new JsonResponse(['error' => 'Category not found'], 404);
        }
    
        $exactlyCards = $this->db->getWhereCategory("cards", $category[0]['id']);
    
        return new JsonResponse(['status' => 201, 'data' => $exactlyCards], 201);
    }
    }


    public function search()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data["word"])) {
            return new JsonResponse(['error' => 'Invalid request'], 400); // Bad request if ID is not provided
        }
        if ($data["word"] === ' ') {
            $exactlyCards = $this->db->getAll("cards");
            return new JsonResponse(['status' => 201, 'data' => $exactlyCards], 201);
        }else{
            $cards = $this->db->getDefinitive("cards", "name", $data["word"]);

            if (!$cards) {
                return new JsonResponse(['error' => 'Cards not found'], 404);
            }

            return new JsonResponse(['status' => 201, 'cards' => $cards], 201);
        }
    }
}
