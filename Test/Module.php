<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Test;

use Locale;
use Zend\Mvc\ModuleRouteListener;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ModuleManager\ModuleManager;
/*
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\LocatorRegisteredInterface;
use Zend\ModuleManager\Feature\ControllerPluginProviderInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
*/
use Zend\Session\Container;

class Module implements ViewHelperProviderInterface
{
/*
    public function init(ModuleManager $moduleManager){
    }
*/
    public function onBootstrap(EventInterface $e) // onInitApplication ;)
    {
        // container de session
        $sessionContainer = new Container('brtsSC');

        // teste si la langue en session existe
        if(!$sessionContainer->offsetExists('locale')){
//            $locale = $e->getApplication()->getServiceManager()->get('locale');
            // n'existe pas donc on ajoute la langue du navigateur
            $sessionContainer->offsetSet('locale', Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']));
            $sessionContainer->offsetSet('lang', mb_substr(Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2, 'utf-8'));
        }

        // mise en place du service de traduction
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $translator->setLocale($sessionContainer->locale)
                   ->setFallbackLocale('en_US');

        // Initialisation au bootstrap
//        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getControllerConfig()
    {
        return array(
            // Definitions des controllers ici
            'invokables' => array(
                'Test\Controller\Index' => 'Test\Controller\IndexController',
            )
        );
    }

    public function getControllerPluginConfig()
    {
        return array(
            // Definitions des aides d'action (plugin) ici
            'invokables' => array(
                'flashmessenger' => 'Application\Controller\Plugin\FlashMessenger',
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            // Définition des services ici
            'invokables' => array(
            ),
            'factories' => array(
            ),
            'abstract_factories' => array(
            )       
        );
    }
}