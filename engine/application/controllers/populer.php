<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Populer
 *
 * @author marwansaleh
 */
class Populer extends MY_News {
    function _remap(){
        //$this->mobile();
        if ($this->is_mobile()){
            $this->mobile();
        }else{
            redirect('home');
        }
    }
    function mobile(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('MOBILE');
        
        $this->data['parameters'] = $parameters;
        
        //Load popular news
        $limit = isset($parameters['MOBILE_NEWS_NUM'])?$parameters['MOBILE_NEWS_NUM']:15;
        $this->data['limit'] = $limit;
        
        $this->data['adverts'] = $this->get_advert_active(FALSE);
        
        $this->data['subview'] = 'mobile/populer/index';
        $this->load->view('_layout_mobile', $this->data);
    }
}

/*
 * file location: engine/application/controllers/Populer.php
 */
