<?php
require_once "./Helper/Helper.php";
use Helper\Helper;
Helper::getInput(
     
    ["name"=>"nomecompleto",
    "id"=>'nomecompleto',
    "label"=>'Nome completo:',
        "class"=>'form-control',
        "classdiv"=>'col-6',
        "value"=>'',
        "type"=>'text',
        "required"=>'required'
    ]
);
Helper::getInput(

    ["name"=>"btnAdd",
    "id"=>'btnadd',
  
        "class"=>'btn btn-primary',
        "classdiv"=>'mb-auto',
        "value"=>'Guardar',
        "type"=>'submit',
        "aditional"=>'<hr>'
    ]
);



echo Helper::buliderForm("eduSalvarPreinscricao","post","","form-inline","row",'Titulo');

