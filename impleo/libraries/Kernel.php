<?php
    /**
     * @author			Johan Dahlberg <johan.dahlberg@live.se>
     * @copyright		Copyright (c) 2010, Johan Dahlberg
     * @license			Creative Commons 3.0 (Attribution-NonCommercial-ShareAlike 3.0 Unported)
     * @link			http://www.impleocms.se
     * @package			Impleo CMS
     *
     * @subpackage		Core Package
     * @since			v1.0 2010-02-22::22.44
     * @version			v1.0 2010-02-25::22.09
     */

class Kernel {
    /**
     * Never used
     */
    public function __construct() {

    }

    /**
     * Set the project enviroment
     *
     * @param <type> $enviroment
     */
    public function setEnviroment($enviroment) {
        $this->_enviroment = $enviroment;
    }

    /**
     * Returning the enviroment
     *
     * @return <type> $_enviroment Return the project enviroment that is currently set
     */
    public function getEnviroment() {
        return $this->_enviroment;
    }

    /**
     * Initialize Kernel
     * @param <type> $configPath The path to the config file
     */
    public function initKernel($configPath) {
        // Setting up the enviroment
        if(!$this->_enviroment) {
            throw new Exception('Please set the enviroment using ::setEnviroment');
        }

        // Setting up the Autoloader - Eliminates the need for include/require e.g
        require_once('Zend/Loader/Autoloader.php');
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace(array('Impleo_'));

        // Load the Config
        if($configPath == '' ||!file_exists($configPath)) {
            throw new Exception('There is no valid configuratione file at the choosen location!');
        } else {
            $this->config = new Zend_Config_Xml($configPath, $this->getEnviroment());
            Zend_Registry::set('config', $this->config);
        }

        // Set error settings
        ini_set('display_startup_errors', $this->config->phpSettings->display_startup_errors);
        ini_set('display_errors', $this->config->phpSettings->display_errors);

        $frontController = $this->initMVC();
        $this->initDB();

        $this->initRoutes($frontController);
        $response = $this->dispatch($frontController);

        $this->render($response);
    }

    /**
     * Initialize DB
     */
    public function initDB() {
        // Fetch DB params
        $params = array(
            'host'      => $this->config->database->hostname,
            'username'  => $this->config->database->username,
            'password'  => $this->config->database->password,
            'dbname'    => $this->config->database->dbname
        );
        try {
            // Create DB connection
            $db = Zend_Db::factory($this->config->database->adapter, $params);
            $db->getConnection();
            Zend_Db_Table_Abstract::setDefaultAdapter($db);
            // Save DB connection to the registry
            Zend_Registry::set('db', $db);
        } catch (Zend_Db_Adapter_Exception $e) {
            // Perhaps a failed login credential, or perhaps the RDMS is not running
            echo "Caught exception: " . get_class($e) . "\n";
            echo "Message: " . $e->getMessage() . "\n";
        }
    }

    /**
     * @return <type> $frontController
     */
    public function initMVC() {
        // Setting up the frontController
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->throwExceptions((bool) $this->config->mvc->exceptions);
        $frontController->setControllerDirectory(array(
            'default'   => APP_PATH . '/controllers',
            'admin'     => APP_PATH . '/admin/controllers',
        ));

        /**
         * @todo should I implement Modules?
         */

        $router = $frontController->getRouter();
        $router->addDefaultRoutes();
        
        if($this->config->system->status == 'offline') {
            $options = array(
                'layout'     => 'maintenance',
                'layoutPath' => APP_PATH . '/templates/' . $this->config->general->template . '/',
                //'contentKey' => 'CONTENT',
            );
        } else {
            $options = array(
                'layout'     => 'default',
                'layoutPath' => APP_PATH . '/templates/' . $this->config->general->template . '/',
                //'contentKey' => 'CONTENT',
            );
        }
        Zend_Layout::startMvc($options);
        $view = new Zend_View();

        return $frontController;
    }

    /**
     * @param Zend_Controller_Front $frontController
     * @return <type> $router the router
     */
    public function initRoutes(Zend_Controller_Front $frontController) {
        // Retrieve the router from the frontController
        $router = $frontController->getRouter();
            //$router->addRoute('', new Zend_Controller_Router_Route('default'));
        $route = new Zend_Controller_Router_Route(
            ':action',
            array('module'  => 'default')
        );
        $router->addRoute(':action', $route);
        $router->addRoute('admin/', new Zend_Controller_Router_Route('admin'));

        return $router;
    }

    /**
     * @param Zend_Controller_Front $frontController
     * @return <type> the response
     */
    public function dispatch(Zend_Controller_Front $frontController) {
        $frontController->returnResponse(true);
        return $frontController->dispatch();
    }

    /**
     * @param Zend_Controller_Request_Abstract $response
     */
    public function render(Zend_Controller_Request_Abstract $response) {
        $response->sendHeaders();
        $response->outputBody();
    }
}