<?php
class AuthorController {

    private $db;
    private $table = 'authors';
    public function __construct($db) {
        $this->db = $db;
    }

    public function createAuthor() {

        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->author)) {
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $query = "INSERT INTO " . $this->table . " (author) VALUES (:author)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":author", $data->author);

        if ($stmt->execute()) {
            echo json_encode([
                "id" => $this->db->lastInsertId(),
                "author" => $data->author
            ]);
        } else {
            echo json_encode(["message" => "Author could not be created"]);
        }
    }

    public function updateAuthor() {

        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->id) || empty($data->author)) {
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $query = "UPDATE " . $this->table . " SET author = :author WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":author", $data->author);
        $stmt->bindParam(":id", $data->id);

        if ($stmt->execute()) {
            echo json_encode([
                "id" => $data->id,
                "author" => $data->author
            ]);
        } else {
            echo json_encode(["message" => "Author could not be updated"]);
        }
    }

    public function deleteAuthor() {
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->id)) {
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":id", $data->id);

        if ($stmt->execute()) {
            echo json_encode(["id" => $data->id]);
        } else {
            echo json_encode(["message" => "Author could not be deleted"]);
        }
    }
}
?>
