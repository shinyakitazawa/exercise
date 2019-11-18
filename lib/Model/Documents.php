<?php

namespace MyApp\Model;

class Documents extends \MyApp\Model {

    public function Select($category = null) {

        $cond = "";
        if ($category !== null) {
            $cond = "AND documents.category = :category";
        }
        
        $stmt = $this->db->prepare("
            SELECT documents.id as id,
                   documents.filename as name,
                   names.name as category,
                   documents.created as created,
                   documents.modified as modified
            FROM documents
            LEFT JOIN names
            ON documents.category = names.category
            AND documents.userid = names.userid
            WHERE documents.userid = :userid
        " . $cond);
        if ($category !== null) {
            $res = $stmt->execute([
                ':category' => $category,
                ':userid' => $_SESSION['me']->id
            ]);
        }
        else {
            $res = $stmt->execute([
                ':userid' => $_SESSION['me']->id
            ]);
        }
        
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $docs = $stmt->fetchAll();
        
        if (!empty($docs)) {
            return $docs;
        }
        
        return false;        
    }

    public function GetCategory() {
        $stmt = $this->db->prepare("
            SELECT category, name
            FROM  names
            WHERE userid = :userid
        ");
        $res = $stmt->execute([
            ':userid' => $_SESSION['me']->id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $names = $stmt->fetchAll();
        
        if (!empty($names)) {
            return $names;
        }
        
        return false;        
    }

    public function Insert($fname, $path) {

        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("
                INSERT INTO documents 
                (userid, category, filename, path, created, modified)
                VALUES (:userid, :category, :name, :path, now(), now())
            ");
            $res = $stmt->execute([
                ':userid' => $_SESSION['me']->id,
                ':category' => $_POST['category'],
                ':name' => $fname,
                ':path' => $path
            ]);
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo $e->getMessage();
        }
    }

    public function Delete($id) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("
                DELETE FROM documents 
                WHERE id=:id
                AND userid = :userid
            ");
            $res = $stmt->execute([
                ':id' => $id,
                ':userid' => $_SESSION['me']->id
            ]);
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo $e->getMessage();
        }
    }
} 

?>