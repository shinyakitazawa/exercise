<?php

namespace MyApp\Controller;

class Documents extends \MyApp\Controller {

    public function run() {

        $docModel = new \MyApp\Model\Documents();

        if (!isset($_SESSION['dispcategory'])) {
            $_SESSION['dispcategory'] = 'all';
        }
        
        if (!$this->isLoggedIn()) {
            header('Location: ' . SITE_URL);
        }

        $names = $docModel->GetCategory();
        $this->setValue('names', $names);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Token チェック
            // if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
            //     echo 'Invalid Token';
            //     exit;
            // }

            // アップロード処理
            if ($_POST['from'] == 'upload') {
                
                $ext = pathinfo($_FILES['upfile']['name'], PATHINFO_EXTENSION);
                $fname = $_POST['filename'] . '.' .$ext;
                // ファイル名をハッシュ化してアップロード
                $fnameHash = hash('ripemd160', $fname);
                $path = DOC_FOLDER . $fnameHash; 
                //アップロードが正しく完了したかチェック
                if(move_uploaded_file($_FILES['upfile']['tmp_name'], $path)){
                    // ファイル情報をInsert
                    $docModel->Insert($fname, $path);
                }else{
                    echo 'アップロード失敗';
                    return;
                }
            }

            // 削除処理
            if ($_POST['from'] == 'del') {
                $fnameHash = hash('ripemd160', $_POST['fname']);
                unlink(DOC_FOLDER . $fnameHash);
                $docModel->Delete($_POST['id']);
            }

            if ($_POST['from'] == 'pulldown') {
                $_SESSION['dispcategory'] = $_POST['dispcategory'];
            }
            // SELECT
            if ($_SESSION['dispcategory'] == 'all') {
                $docs = $docModel->Select();
                $this->setValue('docs', $docs);
            }
            else {
                $docs = $docModel->Select($_SESSION['dispcategory']);
                $this->setValue('docs', $docs);                
            }
        }
        // ダウンロード
        if ($_SERVER['REQUEST_METHOD'] === 'GET')
        {
            if (isset($_GET['download']))
            {
                $fname = $_GET['download'];
                $fnameHash = hash('ripemd160', $fname);
                $fpath = DOC_FOLDER . $fnameHash;

                if (file_exists($fpath)) {
                    header('Content-Description: File Transfer'); 
                    header('Content-Disposition: attachment; filename*=UTF-8\'\''.rawurlencode($fname));
                    header('Content-Type: application/force-download;');
                    readfile($fpath);
                    exit;        
                }
                else {
                    echo 'ファイルが見つかりません。';
                } 
            }
        }

    }
}


?>