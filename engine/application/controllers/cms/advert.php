<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Advert
 *
 * @author marwansaleh
 */
class Advert extends MY_AdminController {
    function __construct() {
        parent::__construct();
        $this->data['active_menu'] = 'advert';
        $this->data['page_title'] = '<i class="fa fa-cogs"></i> Adverts';
        $this->data['page_description'] = 'List and update adverts';
        
        //load models
        $this->load->model(array('advert/advert_m'));
    }
    
    function index(){
        $page = $this->input->get('page', TRUE) ? $this->input->get('page', TRUE):1;
        
        $this->data['page'] = $page;
        $offset = ($page-1) * $this->REC_PER_PAGE;
        $this->data['offset'] = $offset;
        
        $where = NULL;
        
        //count totalRecords
        $this->data['totalRecords'] = $this->advert_m->get_count($where);
        //count totalPages
        $this->data['totalPages'] = ceil ($this->data['totalRecords']/$this->REC_PER_PAGE);
        $this->data['items'] = array();
        if ($this->data['totalRecords']>0){
            $items = $this->advert_m->get_offset('*',$where,$offset,  $this->REC_PER_PAGE);
            if ($items){
                foreach($items as $item){
                    $item->advert_type = advert_type($item->type);
                    $this->data['items'][] = $item;
                }
                $url_format = site_url('cms/advert/index?page=%i');
                $this->data['pagination'] = smart_paging($this->data['totalPages'], $page, $this->_pagination_adjacent, $url_format, $this->_pagination_pages, array('records'=>count($items),'total'=>$this->data['totalRecords']));
            }
        }
        $this->data['pagination_description'] = smart_paging_description($this->data['totalRecords'], count($this->data['items']));
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Adverts', site_url('cms/advert'), TRUE);
        
        $this->data['subview'] = 'cms/advert/index';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function edit(){
        
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        if (!$this->users->has_access('ADDS_MANAGEMENT')){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Sorry. You dont have access for this feature');
            redirect('cms/advert/index?page='.$page);
        }
        
        $item = $id ? $this->advert_m->get($id):$this->advert_m->get_new();
        
        $this->data['item'] = $item;
        
        //suporting data
        $this->data['advert_types'] = advert_type();
        
        //set breadcumb
        breadcumb_add($this->data['breadcumb'], 'Adverts', site_url('cms/advert'));
        breadcumb_add($this->data['breadcumb'], 'Update Item', NULL, TRUE);
        
        $this->data['back_url'] = site_url('cms/advert/index?page='.$page);
        $this->data['subview'] = 'cms/advert/edit';
        $this->load->view('_layout_admin', $this->data);
    }
    
    function delete(){
        $id = $this->input->get('id', TRUE);
        $page = $this->input->get('page', TRUE);
        
        if (!$this->users->has_access('ADDS_MANAGEMENT')){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Sorry. You dont have access for this feature');
            redirect('cms/advert/index?page='.$page);
        }
        
        //check if found data item
        $item = $this->advert_m->get($id);
        if (!$item){
            $this->session->set_flashdata('message_type','error');
            $this->session->set_flashdata('message', 'Could not find data item. Delete item failed!');
        }else{
            if ($this->advert_m->delete($id)){
                //delete the file
                if (file_exists($item->file_name)){
                    unlink($item->file_name);
                }
                $this->session->set_flashdata('message_type','success');
                $this->session->set_flashdata('message', 'Data item deleted successfully');
            }else{
                $this->session->set_flashdata('message_type','error');
                $this->session->set_flashdata('message', $this->advert_m->get_last_message());
            }
        }
        
        redirect('cms/advert/index?page='.$page);
    }
}

/*
 * file location: engine/application/controllers/cms/advert.php
 */
