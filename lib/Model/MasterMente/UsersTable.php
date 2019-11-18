<?php

namespace MyApp\Model\MasterMente;

class UsersTable extends \MyApp\Model {

    public function Select() {
        $stmt = $this->db->prepare("
            SELECT *
            FROM users
        ");
        $res = $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $datas = $stmt->fetchAll();
        
        if (!empty($datas)) {
            return $datas;
        }
        
        return false;        
    }

    public function Insert($usersInfo) {
        try {
            $this->db->beginTransaction();
            $stmt = $this->db->prepare("
                INSERT INTO users
                (email, password, authority, created, modified)
                VALUES (:email, :password, :auth, now(), now())
            ");
            $res = $stmt->execute([
                ':email' => $usersInfo['userid'],
                ':password' => password_hash($usersInfo['password'], PASSWORD_DEFAULT),
                ':auth' => $usersInfo['authority']
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
                DELETE FROM users 
                WHERE id=:id
            ");
            $res = $stmt->execute([
                ':id' => $id,
            ]);
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo $e->getMessage();
        }
    }
} 

?>