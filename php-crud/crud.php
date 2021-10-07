<?php
require_once "./core/db-connect.php";
$db=new DB();
if(isset($_POST['btnAdd'])):
$result=$db->insert(
["curso"=>$_POST['curso'],"estado_id"=>$_POST['estado_id']],"tbl_cursos"
);
 if($result>0){

     header('Location:index.php?s=1');
 }
     else{
        header('Location:index.php?s=0');
     }
 
endif;