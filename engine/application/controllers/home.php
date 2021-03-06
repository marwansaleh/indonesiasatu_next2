<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Home
 *
 * @author marwansaleh
 */
class Home extends MY_News {
    function __construct() {
        parent::__construct();
        
        $this->data['main_slider'] = TRUE;
        //$this->data['mainmenus'] = $this->_mainmenu(0); //no submenu
        $this->data['active_menu'] = 'home';
    }
    
    function _remap(){
        //$this->mobile();
        if ($this->is_mobile()){
            $this->mobile();
        }else{
            $this->index();
        }
    }
    
    function index(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters(array('LAYOUT'));
        $this->data['parameters'] = $parameters;
        
        $widgets = explode(',',$parameters['LAYOUT_HOME_WIDGETS']);
        foreach ($widgets as $widget){
            $this->data['widgets'] [] = trim($widget);
        }
        $widgets = $this->data['widgets'];
        if (in_array(WIDGET_NEWSGROUP, $widgets)){
            //Load popular news
            $this->data['popular_news'] = $this->_popular_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
            //Load popular news
            $this->data['recent_news'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
            //Load popular news
            $this->data['commented_news'] = $this->_commented_news(isset($parameters['LAYOUT_NEWSGROUP_NUM'])?$parameters['LAYOUT_NEWSGROUP_NUM']:5);
        }
        if (in_array(WIDGET_NEWSLATEST, $widgets)){
            //Load latest post
            $this->data['latest_post'] = $this->_latest_news(isset($parameters['LAYOUT_NEWSLATEST_NUM'])?$parameters['LAYOUT_NEWSLATEST_NUM']:6);
        }
        if (in_array(WIDGET_STOCKS, $widgets)){
            //Load rates
            $this->data['rates'] = $this->_get_rates();
        }
        if (in_array(WIDGET_NEWSPHOTO, $widgets)){
            //store photo news
            $this->data['photo_news'] = $this->_photo_news(isset($parameters['LAYOUT_NEWSPHOTO_NUM'])?$parameters['LAYOUT_NEWSPHOTO_NUM']:10);
        }
        if (in_array(WIDGET_SELECTED_CATEGORY, $widgets)){
            //get category name
            $selected_category_name = $parameters['LAYOUT_WIDGET_SELECTED_CATEGORY'];
            $selected_category = NULL;
            if ($selected_category_name){
                $selected_category_name_arr = explode(',', $selected_category_name);
                
                $selected_category = array();
                $index_selected_cat = 1;
                foreach ($selected_category_name_arr as $catname){
                    //get the category
                    $category = $this->category_m->get_by(array('slug'=>$catname),TRUE);
                    if ($category){
                        $category->articles = $this->_article_categories($category->id, $index_selected_cat==1 ? 3 : 1);
                        $selected_category [] = $category;
                    }
                    $index_selected_cat++;
                }
                if (count($selected_category)==0){
                    $category_item = $this->category_m->get_select_where('id,name',NULL,TRUE);
                    $category_item->articles = $this->_article_categories($category_item->id, 3);
                    $selected_category [] = $category_item;
                }
            }
            
            $this->data['selected_news_category'] = $selected_category;
        }
        
        $this->data['inspirasi'] = $this->_inspiration();
        
        //Load slider news
        $this->data['slider_news'] = $this->_slider_news(5);
        //Load highlight news
        $this->data['highlight_news'] = $this->_highlight_news(4);
        
        $this->data['embun_pagi'] = $this->_get_article_by_category_slug('embun-pagi');
        $this->data['teropong'] = $this->_get_article_by_category_slug('teropong');
        
        //Load popular news
        $this->data['latest_news'] = $this->_latest_news(isset($parameters['LAYOUT_HOME_LATEST_NUM'])?$parameters['LAYOUT_HOME_LATEST_NUM']:8);
        
        //Load categories in home
        $home_categories = $this->_home_category(isset($parameters['LAYOUT_HOME_CAT_NUM'])?$parameters['LAYOUT_HOME_CAT_NUM']:3);
        $this->data['categories'] = array();
        
        //Get number of articles within selected categories
        $category_articles_num = isset($parameters['LAYOUT_HOME_CAT_ARTICLE_NUM'])?$parameters['LAYOUT_HOME_CAT_ARTICLE_NUM']:3;
        foreach ($home_categories as $category){
            //Get articles for this category
            $category->articles = $this->_article_categories($category->id, $category_articles_num);
            $this->data['categories'][] = $category;
        }
        
        //get article "politik"
        $selected_left_under = isset($parameters['LAYOUT_HOME_LEFT_UNDER_CAT'])?$parameters['LAYOUT_HOME_LEFT_UNDER_CAT'] : 'politik';
        $category_politic = $this->category_m->get_by(array('slug'=>$selected_left_under),TRUE);
        if ($category_politic){
            $category_politic->articles = $this->_article_categories($category_politic->id, isset($parameters['LAYOUT_HOME_LEFT_UNDER_NUM'])?$parameters['LAYOUT_HOME_LEFT_UNDER_NUM'] : 5);
            $this->data['politics'] = $category_politic;
        }
        
        //get refleksi
        $cat_refleksi = $this->category_m->get_by(array('slug'=>'refleksi'),TRUE);
        $cat_refleksi->articles = $this->_article_categories($cat_refleksi->id, 6);
        $this->data['category_refleksi'] = $cat_refleksi;
        
        //get gaya hidup
        $cat_gayahidup = $this->category_m->get_by(array('slug'=>'gaya-hidup'),TRUE);
        if ($cat_gayahidup){
            $cat_gayahidup->articles = $this->_article_categories($cat_gayahidup->id, 6);
            $this->data['category_gayahidup'] = $cat_gayahidup;
        }
        
        //get internasional
        $cat_internasional = $this->category_m->get_by(array('slug'=>'internasional'),TRUE);
        if ($cat_internasional){
            $cat_internasional->articles = $this->_article_categories($cat_internasional->id, 5);
            $this->data['category_internasional'] = $cat_internasional;
        }
        //get daerah
        $cat_daerah = $this->category_m->get_by(array('slug'=>'daerah'),TRUE);
        if ($cat_daerah){
            $cat_daerah->articles = $this->_article_categories($cat_daerah->id, 4);
            $this->data['category_daerah'] = $cat_daerah;
        }
        //get hiburan
        $cat_hiburan = $this->category_m->get_by(array('slug'=>'hiburan'),TRUE);
        if ($cat_hiburan){
            $cat_hiburan->articles = $this->_article_categories($cat_hiburan->id, 4);
            $this->data['category_hiburan'] = $cat_hiburan;
        }
        //get olahraga
        $cat_olahraga = $this->category_m->get_by(array('slug'=>'olahraga'),TRUE);
        if ($cat_olahraga){
            $cat_olahraga->articles = $this->_article_categories($cat_olahraga->id, 5);
            $this->data['category_olahraga'] = $cat_olahraga;
        }
        
        //get sastra
        $cat_sastra = $this->category_m->get_by(array('slug'=>'sastra'),TRUE);
        if ($cat_sastra){
            $cat_sastra->articles = $this->_article_categories($cat_sastra->id, 5);
            $this->data['category_sastra'] = $cat_sastra;
        }
        //get property
        $cat_property = $this->category_m->get_by(array('slug'=>'properti'),TRUE);
        if ($cat_property){
            $cat_property->articles = $this->_article_categories($cat_property->id, 3);
            $this->data['category_property'] = $cat_property;
        }
        
        //set iklan on the left
        $this->data['iklan_kiri'] = array(
            userfiles_baseurl(config_item('advert').'iklan-galuh-mas.jpg'),
            userfiles_baseurl(config_item('advert').'galuhmas-02.jpg'),
            userfiles_baseurl(config_item('advert').'galuhmas-03.jpg'),
            userfiles_baseurl(config_item('advert').'galuhmas-04.jpg'),
            userfiles_baseurl(config_item('advert').'galuhmas-05.jpg')
        );
        
        //set iklan gabung
        $this->data['iklan_gabung'] = userfiles_baseurl(config_item('advert').'iklan-gabung-20160330.jpg');
        //$this->data['iklan_kiri2'] = userfiles_baseurl(config_item('advert').'iklan-travel.jpg');
        
        //get managable advert
        $this->data['adverts'] = $this->get_advert_active(TRUE);
        
        $this->data['subview'] = 'frontend/home/index';
        $this->load->view('_layout_main', $this->data);
    }
    
    
    function mobile(){
        //Load layout parameters for home page
        $parameters = $this->get_sys_parameters('MOBILE');
        
        $this->data['parameters'] = $parameters;
        
        //Load popular news
        $limit = isset($parameters['MOBILE_NEWS_NUM'])?$parameters['MOBILE_NEWS_NUM']:15;
        $this->data['limit'] = $limit;
        //get managable advert
        $this->data['adverts'] = $this->get_advert_active(TRUE);
        
        $this->data['subview'] = 'mobile/home/index';
        $this->load->view('_layout_mobile', $this->data);
    }
    
    private function _inspiration(){
        //get category id for inspiration
        $category_id = $this->category_m->get_value('id', array('slug' => 'inspirasi'));
        if (!$category_id){
            $category = $this->category_m->get_select_where('id',array('parent'=>0, 'is_menu'=>1, 'is_home'=>1), TRUE);
            if ($category){
                $category_id = $category->id;
            }
        }
        //get the article
        $inspiration = $this->article_m->get_select_where('*', array('category_id'=>$category_id, 'published'=>1), TRUE);
        
        if ($inspiration && $inspiration->ext_attributes){
            $inspiration->ext_attributes = json_decode($inspiration->ext_attributes);
        }
        return $inspiration;
    }
    
    private function _get_article_by_category_slug($slug){
        $slected_article = new stdClass();
        
        //get category id for inspiration
        $categories = $this->category_m->get_select_where('id',array('slug' => $slug));
        if (!$categories){
            return NULL;
        }
        //get all inherent categories
        $categories_inherits = $this->category_m->get_select_where('id',array('parent'=>$categories[0]->id));
        if ($categories_inherits){
            $categories = array_merge($categories, $categories_inherits);
        }
        
        $category_ids = array();
        foreach ($categories as $cat){
            $category_ids [] = $cat->id;
        }
        $this->db->where_in('category_id', $category_ids);
        $article = $this->article_m->get_by(array('published'=>ARTICLE_PUBLISHED), TRUE);
        
        if (!$article){
            return NULL;
        }
        $slected_article->category = $this->category_m->get($article->category_id);
        $slected_article->article = $article;
        
        return $slected_article;
    }
}

/*
 * file location: engine/application/controllers/home.php
 */
