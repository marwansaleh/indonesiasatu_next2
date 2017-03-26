<?php

class Info extends MY_Controller{
    function index(){
        echo phpinfo();
    }
    
    function phpbindir(){
        echo "PHPBINDIR: ". PHP_BINDIR;
    }
    
    function log($filename){
        $log_file = rtrim(sys_get_temp_dir(),'/') .'/' . $filename;
        $log = $this->read_log(10,$log_file);
        
        echo '<pre>'.$log.'</pre>';
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

