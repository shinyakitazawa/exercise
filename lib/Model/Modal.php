<?php

namespace MyApp\Model;

class Modal extends \MyApp\Model {

    public function GetCategory() {
        $stmt = $this->db->prepare("
            SELECT category, name
            FROM names
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

} 

?>