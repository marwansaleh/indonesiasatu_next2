<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Comment_m
 *
 * @author Marwan
 * @email amazzura.biz@gmail.com
 */
class Comment_m extends MY_Model {
    protected $_table_name = 'article_comments';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'date desc';
    
}

/*
 * file location: /application/models/article/comment_m.php
 */
