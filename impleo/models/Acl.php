<?php
    /**
     * @author		Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright	Copyright (c) 2010, Johan Dahlberg
     * @license		Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link		http://www.impleocms.se
     * @package		Impleo CMS
     *
     * @subpackage	Core Package
     * @since		v1.0 2010-03-10::20.42
     * @version		v1.0 2010-03-10::20.42
     */

class Acl extends DB {
    /**
     * Fetch user roles from DB
     */
    public function getRoles() {
            $table = $this->config->database->prefix . 'core_aclroles';

            $select =  $this->db->select()
                                ->from( $table )
                                ->order(array('parent_id ASC'));
            $result = $this->db->query($select);
            return $result->fetchAll();
    }
}