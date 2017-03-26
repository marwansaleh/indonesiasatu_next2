<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Click
 *
 * @author marwansaleh
 */
class Click extends MY_News {
    function __construct() {
        parent::__construct();
    }
    
    function run($id, $url_togo){
        $this->load->model('advert/advert_m');
        
        //update counter
        $item = $this->advert_m->get($id);
        if ($item){
            $this->advert_m->save(array('counter'=>$item->counter + 1), $id);
        }
        $url = base64_decode(urldecode($url_togo));
        
        redirect($url);
    }
}

/*
 * file location: engine/application/controllers/click.php
 */
