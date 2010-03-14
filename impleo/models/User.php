<?php
    /**
     * @author		Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright	Copyright (c) 2010, Johan Dahlberg
     * @license		Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link		http://www.impleocms.se
     * @package		Impleo CMS
     *
     * @subpackage	Core Package
     * @since		v1.0 2010-03-10::20.45
     * @version		v1.0 2010-03-12::15.34
     */

class User extends DB {
    public function init() {

    }

    /**
     * Fetch user by providing the Username
     * @param object $username
     */
    function getUserByUsername($username) {
        $table = $this->config->database->prefix . 'core_users';

        $username = addslashes($username);
        return $this->db->fetchRow("SELECT * FROM $table WHERE username='$username' OR email='$username'");
    }

    /**
     * Fetch user by providing the ID
     * @param object $userid
     */
    function getUserById($userid) {
        $table = $this->config->database->prefix . 'core_users';

        return $this->db->fetchAll("SELECT * FROM $table WHERE id='$userid'");
    }

    /**
     * update()
     *
     * @param object $data
     * @param object $id [optional]
     */
    public function update($data, $id = 0) {
        $table = $this->config->database->prefix . 'core_users';
        if($id == 0) {
            $id = $data['id'];
        }

        $where = array(
            'id'      => $id
        );
        if($this->db->update($table, $data, $where)) {
            return true;
        } else {
            return false;
        }
    }
}