<?php
ob_start();
if (empty($arr_dados)) {
    exit();
}
$arr_arquivo = $arr_dados["arr_arquivo"];

header("Content-Description: File Transfer"); 
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename='".$arr_arquivo["nome_arquivo"]."'"); 
while (ob_get_level()) {
    ob_end_clean();
}
readfile("repository/bancodearquivos/".$arr_arquivo["caminho"]);
exit();