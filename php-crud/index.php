
<?php
require_once "./Helper/Helper.php";
require_once "./core/db-connect.php";
require_once "./css.php";
use Helper\Helper;
$helper=new Helper();
$db=new DB();
Helper::rowBegin();
Helper::getInput(
     
    ["name"=>"curso",
 
    "label"=>'Curso:',
        "class"=>'form-control',
        "classdiv"=>'col-6',
        "value"=>'',
        "type"=>'text',
        "required"=>'required'
    ]
);
Helper::getSelect(

    ["name"=>"estado_id",
 
    "label"=>'Estado:',
        "class"=>'form-control select2',
        "classdiv"=>'col-6',
        "value"=>'',
        "list"=>$db->select('tbl_estado')
        ]
 );
 Helper::rowEnd();
Helper::getInput(

    ["name"=>"btnAdd",
   
  
        "class"=>'btn btn-primary',
        "classdiv"=>'mb-auto p-2',
        "value"=>'Guardar',
        "type"=>'submit',
        "aditional"=>'<hr>'
    ]
);



echo Helper::builderForm("crud.php","post","","form-inline","row",'Titulo');

$td='';

foreach($db->select("tbl_cursos") as $curso):

 $td.= "<tr><td>".htmlspecialchars($curso['curso_id'])."</td>";
 $td.= "<td>".htmlspecialchars($curso['curso'])."</td>";



 $td.= "<td><a href='eduficha?id=".htmlspecialchars($curso['curso_id'])."' class=''><i class='fas fa-eye'></i></a>|<a href='crud.php?idEdit=".htmlspecialchars($curso['curso_id'])."' class=''><i class='fas fa-user-edit'></i></a>| <a href='crud.php?id=".htmlspecialchars($curso['curso_id'])."' class=''><i class='fas fa-user-times'></i></a> ".htmlspecialchars("")."</td></tr>";
endforeach;
echo Helper::buildTable( [ "th"=>        
"ID,Curso,Acao
","td"=>$td]);
