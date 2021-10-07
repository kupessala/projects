<?php
namespace Helper;
class Helper{
    public static $elements=null;
    public static function getInput($args=null){
        if(!isset($args['name'])):
            $args['name']='';
        endif;
           
          if(!isset($args['class'])):
                $args['class']='';
          endif;
           if(!isset($args['classdiv'])):
                $args['classdiv']='';
           endif;
           if(!isset($args['type'])):
                $args['type']='';
                endif ;
           if(!isset($args['value'])):
                $args['value']='';
            endif;
            if(!isset($args['label'])):
                $args['label']='';
            endif;
            if(!isset($args['aditional'])):
                $args['aditional']='';
            endif;
            if(!isset($args['required'])):
              $args['required']='';
          endif;
          if(!isset($args['hidden'])):
            $args['hidden']='';
        endif;
  
  Helper::$elements.="<div class='$args[classdiv]'><label $args[hidden] for='$args[name]'>$args[label]</label>
  <input name='$args[name]' $args[hidden] $args[required] id='$args[name]' value='$args[value]' class='$args[class]' type='$args[type]' >
  </div>$args[aditional]
  ";
    }
    /**
  * Esta função retorna os slect option dos formulário
  *@author Rodrino Adolfo Kupessala <rkupessala@email.com>
  * @param [type] $args
  * @return void
  */
    public static function getSelect($args=null,$id=null,$desc=null){
        if(!isset($args['name'])):
            $args['name']='';
        endif;
           
          if(!isset($args['class'])):
                $args['class']='';
          endif;
           if(!isset($args['classdiv'])):
                $args['classdiv']='';
           endif;
           if(!isset($args['type'])):
                $args['type']='';
                endif ;
           if(!isset($args['value'])):
                $args['value']='';
            endif;
            if(!isset($args['label'])):
                $args['label']='';
            endif;
  
            if(!isset($args['list'])):
                $args['list']='';
            endif;
            if(!isset($args['multiple'])):
              $args['multiple']='';
          endif;
            $option='';
            foreach($args['list'] as $v):
                if($args['value']==$v['0']):
                $option .="$args[value] <option seleted value='$v[0]' class='alert alert-primary'>$v[1]</option>";
                else:
                  $option .="$args[value] <option value='$v[0]' class='alert alert-primary'>$v[1]</option>";
              endif;
            
        endforeach;
  
     return   Helper::$elements.="<div class='$args[classdiv]'><label for='$args[name]'>$args[label]</label>
  <select name='$args[name]' id='$args[name]'  class='$args[class]' $args[multiple] data-placeholder='$desc'>
  $option
  </select>
  </div>
  ";
    }public static function builderForm($action='',$method='',$class='',$entype='',$row='',$titleForm=''){
        return "<form action='$action' method='$method'>".Helper::$elements."</form>";
       
      }

       /**
 * Esta função retorna uma tabela
 *@author Rodrino Adolfo Kupessala <rkupessala@email.com>
 * @param [type] $args
 * @return void
 */
public static function buildTable($args=null){
    if(!isset($args['th'])):
      $args['th']='';
    else:
     //$args['th']='null';
  endif;
  if(!isset($args['td'])):
    $args['td']='';
  else:
   // $args['td'].=$args['td'];
  endif;
  $th_='';
    foreach(explode(',', $args['th'])as $th ):
  $th_.="<th>$th</th>";
    endforeach;
    return "
   
  <table id='example1' class='table table-bordered table-striped'>
                    <thead>
                    <tr>
                    $th_
                    </tr>
                    </thead>
                    <tbody>
               
                    $args[td] 
                
                    <tbody>
                    <tfoot>
                    <tr>
                    $th_
                    </tr>
                    </tfoot>
                  </table>
  
    ";
  }
  public static function redirect($url=null){
    echo "<script>
       
    window.location.href='$url'
    </script>";
  }
  public static function rowBegin(){
Helper::$elements.="<div class='row'>";
  }
  public static function rowEnd(){
    Helper::$elements.= "</div>";
      }
}