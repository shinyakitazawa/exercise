<?php


    $nameModel = new \MyApp\Model\MasterMente\NameTable();

    // 追加処理
    if ($_POST['from'] == 'add') {
        if (!isset($_POST['code'])){
            $code = "";
            $str = array_merge(range('a', 'z'));
            for ($i = 0; $i < 3; $i++) {
                $code .= $str[rand(0, count($str)-1)];
            }
            $nameModel->Insert($code, $_POST['name']);
        }
        else {
            $nameModel->Insert($_POST['code'], $_POST['name']);
        }
        
    }

    // 削除処理
    if ($_POST['from'] == 'del') {
        $nameModel->Delete($_POST['code']);
    }

    $datas = $nameModel->Select();
    $this->setValue('names', $datas);
?>