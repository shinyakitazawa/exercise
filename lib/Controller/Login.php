<?php

namespace MyApp\Controller;

class Login extends \MyApp\Controller {
    public function run() {

        if ($this->isLoggedIn()) {
            header('Location: ' . SITE_URL);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {

            // Token Check
            if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
                echo 'Invalid Token';
                exit;
            }

            try {
                $userModel = new \MyApp\Model\User();
                $user = $userModel->Login($_POST['userid']);
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }

            try {
                $namesModel = new \MyApp\Model\Names();
                $names = $namesModel->CreateNames($user->id);
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }            
            // login処理
            if (!empty($user)) {
                session_regenerate_id(true);
                $_SESSION['me'] = $user;
                header('Location: ' . SITE_URL);
                exit;                
            } else {
                $this->setMessage('loginfail' , 'ユーザーIDとパスワードが一致しません。');
                return;
            }

            
        }
    }
}


?>