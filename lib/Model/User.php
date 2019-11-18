<?php

namespace MyApp\Model;

class User extends \MyApp\Model {
    public function Login($values) {

        $stmt = $this->db->prepare("select * from users where email = :email");
        $res = $stmt->execute([
            ':email' => $values
        ]);
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
        $user = $stmt->fetch();
        
        if (!empty($user) && password_verify($_POST['password'],  $user->password)) {
            return $user;
        }
        
        return false;
    }
} 

?>