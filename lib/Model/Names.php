<?php

namespace MyApp\Model;

class Names extends \MyApp\Model {
    public function CreateNames($userid) {

        $stmt = $this->db->prepare("select count(*) from names where userid = :userid");
        $res = $stmt->execute([
            ':userid' => $userid
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $count = $stmt->fetchColumn();
        
        if ((int)$count == "0") {
            try {
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("
                    INSERT INTO names VALUES
                    ('doc', :userid, 'ドキュメント'),
                    ('pic', :userid, '画像'),
                    ('mem', :userid, 'メモ');              
                ");
                $res = $stmt->execute([
                    ':userid' => $userid
                ]);
                $this->db->commit();
            } catch (Exception $e) {
                $this->db->rollBack();
                echo $e->getMessage();
            }
        }
    }
} 

?>