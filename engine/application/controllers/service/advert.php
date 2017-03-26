<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Attachment
 *
 * @author marwansaleh 1:31:58 PM
 */
class Advert extends REST_Api {
    
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    function index_post(){
        $this->load->model(array('advert/advert_m'));
        
        $id = $this->post('id');
        $name = $this->post('name');
        $type = $this->post('type');
        $link_url = $this->post('link_url');
        $new_window = $this->post('new_window');
        $all_pages = $this->post('all_pages');
        $active = $this->post('active');
        
        $result = array('status' => FALSE);
        
        $upload_path = config_item('advert');
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = 2000;
        
        if (!file_exists($upload_path)){
            mkdir($upload_path, 0777, TRUE);
        }

        $this->load->library('upload', $config);
        
        $upload = $this->upload->do_upload('userfile');
        if (!$id && !$upload) {
            $result['message'] = $this->upload->display_errors("","");
        } else {
            $inserted_data = array(
                'name'          => $name,
                'type'          => $type,
                'link_url'      => $link_url,
                'new_window'    => $new_window,
                'all_pages'     => $all_pages,
                'active'        => $active
            );
            
            if (!$id){
                $inserted_data['inserted'] = time();
            }
            
            if ($upload){
                $upload_data = $this->upload->data();
                $inserted_data['file_name'] = $upload_path . $upload_data['file_name'];
                $inserted_data['file_type'] = $upload_data['file_type'];
                
                //remove old file first
                if ($id){
                    $old_item = $this->advert_m->get($id);
                    if ($old_item && file_exists($old_item->file_name)){
                        unlink($old_item->file_name);
                    }
                }
            }
            
            
            $id = $this->advert_m->save($inserted_data, $id);
            if ($id){
                $result['status'] = TRUE;
                $item = $this->advert_m->get($id);
                if ($item->file_name){
                    $item->file_name = site_url($item->file_name);
                }
                $result['item'] = $item;
            }else{
                $result['message'] = $this->advert_m->get_last_message();
            }
        }
        
        $this->response($result);
    }
    
    function uploaddelete_delete($upload_id){
        $this->load->model(array('advert/advert_m'));
        
        $result = array('status' => FALSE);
        
        $upload_file = $this->advert_m->get($upload_id);
        
        if (file_exists($upload_file->file_name)){
            if (unlink($upload_file->file_name)){
                $this->advert_m->save(array('file_name'=>'','file_type'=>''), $upload_id);
                $result['status'] = TRUE;
            }else{
                $result['message'] = 'Gagal menghapus file dari server';
            }
        }else{
            $result['message'] = 'File tidak ditemukan';
        }
        
        $this->response($result);
    }
}

/**
 * Filename : advert.php
 * Location : application/controllers/service/advert.php
 */
