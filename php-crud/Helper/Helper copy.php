<?php
/** User: Rodrino */
namespace app\Helper;

/**
 * Class Helper
 * 
 * @author Rodrino Adolfo Kupessala <rkupessala@gmail.com>
 * @package App/Helper
 * @copyright 2021 Rosoft
 * @license MIT
 */
  class Helper{

    public string $user;
    public static $elements=null;
    public static function logme($uid,$timestamp,$action,$query,$result,$content){
      $file = fopen($_SERVER['DOCUMENT_ROOT']."/logs/log.csv", "a");
      $currTime = time();
    //  $line = Hash::encrypt($currTime) .  "," .Hash:: encrypt($uid) .  "," . Hash::encrypt($timestamp) .  "," .Hash:: encrypt($action) .  "," . Hash::encrypt($query) .  "," . Hash::encrypt($result) . "," . Hash::encrypt($content) . PHP_EOL;
      fwrite($file, $line); # $line is an array of string values here
      fclose($file);
    }public static function readLog(){
      $csvFile = file($_SERVER['DOCUMENT_ROOT']."/logs/log.csv", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      $csv = array_map('str_getcsv', $csvFile);
      return $csv;
    }
    public static function getInput($args=null){
      if(!isset($args['name'])):
          $args['name']='';
      endif;
         if(!isset($args['id'])):
              $args['id']='';
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

Helper::$elements.="<div class='$args[classdiv] p-2'><label $args[hidden] for='$args[id]'>$args[label]</label>
<input name='$args[name]' $args[hidden] $args[required] id='$args[id]' value='$args[value]' class='$args[class]' type='$args[type]' >
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
         if(!isset($args['id'])):
              $args['id']='';
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

   return   Helper::$elements.="<div class='$args[classdiv]'><label for='$args[id]'>$args[label]</label>
<select name='$args[name]' id='$args[id]'  class='$args[class]' $args[multiple] data-placeholder='$desc'>
$option
</select>
</div>
";
  }
  public static function builtContent($dados='',$titleContent='',$info=''){
     
    return "<section class='content'>
    <div class='container-fluid'>
      <div class='row'>
        <div class='col-md-12'>
          <div class='card'>
            <div class='card-header'>
              <h3 class='card-title'></h3>
            </div><div class='card-body'>

    <div class='card card-primary m-auto'>
  <div class='card-header'>
    <h3 class='card-title '>$info</h3>
  </div>$dados  </div>
      
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>";
  }
  public static function buliderForm($action='',$method='',$class='',$entype='',$row='',$titleForm=''){
    return Helper::$elements;
   
  }
}
  
