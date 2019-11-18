<?php

namespace MyApp\Model;

class MasterMente extends \MyApp\Model {

    public function Select() {
        $stmt = $this->db->prepare("
            SELECT *
            FROM names
            WHERE userid = :userid
        ");
        $res = $stmt->execute([
            ':userid' => $_SESSION['me']->id
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $datas = $stmt->fetchAll();
        
        if (!empty($datas)) {
            return $datas;
        }
        
        return false;        
    }

    public function Insert($code, $name) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("
                INSERT INTO names 
                VALUES (:category, :userid, :name)
            ");
            $res = $stmt->execute([
                ':category' => $code,
                ':userid' => $_SESSION['me']->id,
                ':name' => $name
            ]);
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo $e->getMessage();
        }
    }

    public function Delete($code) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("
                DELETE FROM names 
                WHERE category=:code
                AND userid =:userid
            ");
            $res = $stmt->execute([
                ':code' => $code,
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