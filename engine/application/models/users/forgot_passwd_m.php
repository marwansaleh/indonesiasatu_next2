<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Forgot_passwd_m
 *
 * @author Marwan Saleh <marwan.saleh@ymail.com>
 */
class Forgot_passwd_m extends MY_Model {
    protected $_table_name = 'forgot_password';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'valid_time';
    
}

/*
 * file location: engine/application/models/users/Forgot_passwd_m.php
 */