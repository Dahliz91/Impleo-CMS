<?php
    /**
     * @author		Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright	Copyright (c) 2010, Johan Dahlberg
     * @license		Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link		http://www.impleocms.se
     * @package		Impleo CMS
     *
     * @subpackage	Core Package
     * @since		v1.0 2010-03-10::20.43
     * @version		v1.0 2010-03-10::20.43
     */

class DB {
    public function __construct() {
        $this->config = Zend_Registry::get('config');
        $this->db = Zend_Registry::get('db');
    }
}