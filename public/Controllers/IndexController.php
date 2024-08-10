<?php
namespace Public\Controllers;
use PDO;
use Public\Models\Database;
use Laminas\Diactoros\Response\HtmlResponse;
use Aura\SqlQuery\QueryFactory;
use League\Plates\Engine;

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
        $posts = $this->db->getAllPosts("posts");

        $responseContent = '';
        $responseContent .= $this->view->render('home', ['posts' => 'posts']);
        return new HtmlResponse($responseContent);
    }

    public function about()
    {
        return new HtmlResponse("about");
    }
}
