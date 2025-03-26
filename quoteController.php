<?php
require_once __DIR__ . '/../models/Quote.php';

class QuoteController {
    private $quote;

    public function __construct($db) {
        $this->quote = new Quote($db);
    }

   
    public function createQuote() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['quote'], $data['author_id'], $data['category_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $result = $this->quote->create($data['quote'], $data['author_id'], $data['category_id']);
        if ($result) {
            http_response_code(201);
            echo json_encode(["message" => "Quote Created", "id" => $result]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to Create Quote"]);
        }
    }

    public function updateQuote() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'], $data['quote'], $data['author_id'], $data['category_id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $result = $this->quote->update($data['id'], $data['quote'], $data['author_id'], $data['category_id']);
        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "Quote Updated"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No Quotes Found"]);
        }
    }
    public function deleteQuote() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $result = $this->quote->delete($data['id']);
        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "Quote Deleted"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "No Quotes Found"]);
        }
    }
}
?>
