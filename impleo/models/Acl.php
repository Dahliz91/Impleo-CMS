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
     * @version		v1.0 2010-03-12::15.36
     */

class Acl extends DB {
    public function init() {

    }

    /**
     * Fetch access right from DB
     *
     * @return <type> Access List
     */
    public function getAccess() {
        $table = $this->config->database->prefix . 'core_aclaccess';

        $select = $this->db->select()
                           ->from( $table );
        $result = $this->db->query( $select );
        return $result->fetchAll();
    }

    /**
     * Fetch access by providing ID
     * @param object $accessid
     */
    public function getAccessById($accessid) {
        $table = $this->config->database->prefix . 'core_aclaccess';

        return $this->db->fetchAll("SELECT * FROM $table WHERE id = '$accessid'");
    }

    /**
     * Fetch user roles from DB
     *
     * @return <type> Roles List
     */
    public function getRoles() {
            $table = $this->config->database->prefix . 'core_aclroles';

            $select =  $this->db->select()
                                ->from( $table )
                                ->order(array('parent_id ASC'));
            $result = $this->db->query($select);
            return $result->fetchAll();
    }

    /**
     * Fetch role by providing ID
     * @param object $roleid
     */
    public function getRoleById($roleid) {
        $table = $this->config->database->prefix . 'core_aclroles';

        return $this->db->fetchAll("SELECT * FROM $table WHERE id = '$roleid'");
    }
}