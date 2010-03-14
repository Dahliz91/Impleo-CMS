<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-23::22.06
     * @version			v1.0 2010-03-12::08.27
     */

class Admin_IndexController extends Impleo_ControllerAdmin {
    /**
     * The init function
     */
    public function init() {
        parent::init();
        $this->_model = new User;
    }

    /*
     * The default action
     */
    public function indexAction() {
        if( $this->user->id ) {
            $this->_redirect($config->system->url . '/admin/dashboard');
        } else {
            $this->_redirect($config->system->url . '/admin/index/login');
        }
    }

    /*
     * The login action
     */
    public function loginAction() {
        if($this->user->id) $this->_redirect($config->system->url . '/admin/dashboard');
        $table = $this->config->database->prefix . 'core_users';
        if($this->getRequest()->isPost()) {
            $_model = new User;
            $values = $_POST;
            $adapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
            $adapter->setTableName($table);
            $adapter->setIdentityColumn('username');
            $adapter->setCredentialColumn('password');
            $adapter->setIdentity($values['username']);
            $adapter->setCredential(hash('MD5', $values['password']));

            $auth = Zend_Auth::getInstance();
            $result = $auth->authenticate($adapter);
            if($result->isValid()) {
                $auth->getStorage()->write($adapter->getResultRowObject(null, 'password'));
                $user = $auth->getIdentity();
                if($user->active == 0) {
                    $auth->clearIdentity();
                    $this->view->notificationMessages[0] = 'Your account is Suspended';
                    $this->view->failedAuthentication = true;
                } else {
                    $data = array('moddate' => DATE("Y-m-d H:i:s"));
                    //$where = $values['username];

                    $_model->update($data, $user->id);

                    $this->_redirect($config->system->url . '/admin/dashboard');
                }
            } else {
                $this->view->notificationMessages[0] = 'Username password combination not found';
            }
        }
    }

    /**
     * logoutAction()
     */
    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect($config->system->url . '/admin/index');
    }
}