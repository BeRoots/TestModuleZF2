<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'test' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/[:action]',
                    'constraints' => array(
                        'action'       => '(index|help|client)'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Test\Controller',
                        'controller'    => 'Test\Controller\index',
                        'action'        => 'index'
                    )
                ),
                'may_terminate' => true
            )
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory'
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo'
            ),
        ),
    ),
/*    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),*/
    'view_manager' => array(
        'base_path' => '',
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'application/layout/layout'             => __DIR__ . '/../../'.APPLICATION_NAME.'/view/layout/layout.phtml',
            'application/chooselocale/updatelocale' => __DIR__ . '/../view/application/chooselocale/updatelocale.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
       ),
    ),
    'module_options' => array(
        'langListe' => 'fr/en'
    )
);
