<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::22.07
     * @version			v1.0 2010-03-11::22.06
     */

class Impleo_ControllerAdmin extends Impleo_ControllerAction {
    /**
     * The init function
     */
    public function init() {
        parent::init();

        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('login')
               ->setLayoutPath(APP_PATH . '/admin/templates/' . $this->config->general->admintemplate . '/');
    }

    /**
     * Check if user is authenticated
     *
     * @param <type> $accesspoint
     * @param <type> $redirect
     * @param <type> $message
     */
    public function _checkAuth( $accesspoint = '', $redirect = '/admin/login/', $message = 'You are not Authorized to view this Page' ) {
        $role = isset( $this->user->role ) ? $this->user->role : 'Guests';
        $access = false;

        if( $accesspoint == '' ) {
            $module = 'admin';
            $controller = $this->_getParam('controller');
            $action = $this->_getParam('action');
            $accesspoint = ("$module:$controller");
        }

        $acl = Zend_Registry::get('ACL');
        if( $acl->has($accesspoint) ) {
            if( $action == NULL ) {
                $access = $acl->isAllowed( $role, $accesspoint );
            } else {
                $access = $acl->isAllowed( $role, $accesspoint, $action );
            }
        } else {
            if( $role == 'Superadmins' ) {
                $access = true;
            }
        }

        if( $access == true || $access == 1 ) {
            return $access;
        } else {
            $this->_redirect( $this->config->system->url . $redirect, array(), $message );
        }
    }
}