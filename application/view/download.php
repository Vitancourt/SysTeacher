<?php
header("Content-Description: File Transfer"); 
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename='".$_GET["nome_arquivo"]."'"); 
echo readfile("repository/bancodearquivos/".$_GET["caminho"]);
exit();