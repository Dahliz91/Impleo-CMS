<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::14.05
     * @version			v1.0 2010-03-11::21.42
     */

class Impleo_ControllerAction extends Zend_Controller_Action {
    public $view;
    public $user;

    /**
     * The init function
     */
    public function init() {
        // Authentication and Authorization
        $acl = Zend_Registry::get('ACL');
        $this->_loadUser();
        $role = isset($this->user->role) ? $this->user->role : 'Guests';

        // MVC
        $view = Zend_Layout::getMvcInstance()->getView();
        $this->view = $view;
        $view->addHelperPath("Impleo/View/Helper", "Impleo_View_Helper");

        // Check if authenticated
        $this->_checkAuth();

        // Load version settings
	$oVersion = new Impleo_Version();
        $sVersion = $oVersion->getVersion();
        $this->view->system->version = $sVersion;
        $sVersionID = $oVersion->getVersionID();
        $this->view->system->versionID = $sVersionID;

        // Load Config
        $this->config = Zend_Registry::get('config');
        $this->view->config = $this->config;

        // Load any Flashmessages if sent!
        $this->flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->flashMessenger->getMessages();

        $this->loadMeta();
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
        $access = true;

        if( $accesspoint == '' ) {
            $route = $this->_getParam('route');
            $accesspoint = ("$route");
        }

        $acl = Zend_Registry::get('ACL');
        // Temp
        $access = $acl->isAllowed($role, $accesspoint);

        if( $access == true || $access == 1 ) {
            return $access;
        } else {
            $this->_redirect( $this->config->system->url . $redirect, array(), $message );
        }
    }

    /**
     * Check if user is allowed to access resource
     * 
     * @param <type> $role
     * @param <type> $accesspoint
     */
    public function _isAllowed( $role, $accesspoint ) {
        $acl = Zend_Registry::get('ACL');
        
        if( !$acl->has($accesspoint) ) {
            return '-1';
        } else {
            return $acl->isAllowed( $role, $accesspoint );
        }
    }

    /**
     * Load the User Identity
     */
    public function _loadUser() {
        $auth = Zend_Auth::getInstance();
        if( $auth->hasIdentity() ) {
            $this->user = $this->view->user = $auth->getIdentity();
        }
    }

    /**
     * Redirect with a status message
     *
     * @param object $url
     * @param object $message [optional]
     * @param array $options [optional]
     */
    public function _redirect( $url, array $options = array(), $message = '' ) {
        if( $message != '' ) {
            $this->_helper->FlashMessenger( $message );
        }

        $this->_helper->redirector->gotoUrl( $this->config->system->url . $url, $options );
    }

    /**
     * Setting the access permissions
     *
     * @param <type> $role
     * @param <type> $accesspoint
     * @param <type> $permission
     */
    public function _setAccess($role, $accesspoint, $permission = 'allow') {
        $acl = Zend_Registry::get('ACL');
        if( !$acl->has($accesspoint) ) {
            $acl->add( new Zend_Acl_Resource($accesspoint) );
        }

        /**
         * @todo $permission seems to be a none existing function
         */
        //$acl->$permission($role, $accesspoint);
        $acl->isAllowed($role, $accesspoint);
    }

    /**
     * Load Meta tags
     */
    public function loadMeta() {
        $this->view->doctype('HTML5');
        $this->view->headTitle()->setSeparator(' :: ');
        $this->view->headTitle('Impleo CMS');
        $this->view->headMeta()->appendName('description', 'test');
        $this->view->headMeta()->appendName('keywords', 'test');

        $this->view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $this->view->jQuery()->addStylesheet($this->config->system->url . '/modules/jquery/css/black-tie/jquery-ui-1.8rc3.custom.css')
                   ->setLocalPath($this->config->system->url . '/modules/jquery/jquery-1.4.2.min.js')
                   ->setUiLocalPath($this->config->system->url . '/modules/jquery/jquery-ui-1.8rc3.custom.min.js');
    }

    /**
     * @todo adding functions headScript, headStyle and so on.
     */
}