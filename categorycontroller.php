<?php
class CategoryController {

    private $db;
    private $table = 'categories';
    public function __construct($db) {
        $this->db = $db;
    }

    public function createCategory() {
 
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->category)) {
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $query = "INSERT INTO " . $this->table . " (category) VALUES (:category)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":category", $data->category);
        if ($stmt->execute()) {
            echo json_encode([
                "id" => $this->db->lastInsertId(),
                "category" => $data->category
            ]);
        } else {
            echo json_encode(["message" => "Category could not be created"]);
        }
    }

    public function updateCategory() {
 
        $data = json_decode(file_get_contents("php://input"));

        if (empty($data->id) || empty($data->category)) {
            echo json_encode(["message" => "Missing Required Parameters"]);
            return;
        }

        $query = "UPDATE " . $this->table . " SET category = :category WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(":category", $data->category);
        $stmt->bindParam(":id", $data->id);

        if ($stmt->execute()) {
            echo json_encode([
                "id" => $data->id,
                "category" => $data->category
            ]);
        } else {
            echo json_encode(["message" => "Category could not be updated"]);
        }
    }

    public function deleteCategory() {
 
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
            echo json_encode(["message" => "Category could not be deleted"]);
        }
    }
}
?>
