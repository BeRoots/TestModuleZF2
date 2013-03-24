<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Test\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Test\Form\Form;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Session\Container;

class IndexController extends AbstractActionController
{
    private $brtsViewHelper;
    private $translateHelper;
    
 /*   public function __construct()
    {
//        var_dump(get_class_methods($d));
    //    $myHelper = $this->getServiceLocator()->get('viewhelpermanager')->get('myviewhelper');
        $o = (string) 'viewhelpermanager';
	$viewhelpermanager = self::getServiceLocator($o);
        $o = (string) 'myviewhelper';
        $x = $viewhelpermanager::get($this->myToString($o));
    }*/
    private function setAsset()
    {
        // recuperation des helpers à utiliser dans ce controller
        $this->brtsViewHelper = $this->getServiceLocator()->get('viewhelpermanager')->get('myviewhelper');
        $this->translateHelper = $this->getServiceLocator()->get('viewhelpermanager')->get('translate')->getTranslator();

        $this->brtsViewHelper->setMetaRobots(true);
        $this->brtsViewHelper->setAsset(array(
            'addMootools'       => array(
                'css' => '/asset/mootools/css/mootools.css',
                'js1' => '/asset/mootools/mootools-core-1.3.2-full-compat.js',
                'js2' => '/asset/mootools/mootools-more-1.3.2.1.js',
            ),
            'addDomready'    => array(
                'mootools'           => '/js/MMdomreadyV1.js?shadowbox=off',
                'mootools_shadowbox' => '/js/MMdomreadyV1.js?shadowbox=on',
            ),
            'addMooflow'        => 'notbuild',
            'addShadowbox'      => array(
                'css1' => '/asset/shadowbox-build-3.0b/shadowbox.css',
                'css2' => '/asset/shadowbox-build-3.0b/shadowbox_ie_lte_6.css',
                'js1' => '/asset/shadowbox-build-3.0b/shadowbox.js',
                'js2' => '/js/shadowboxInit.js',
            ),
            'addJsFile'         => array(
                'appendFile' => array(
                    0 => '/js/taille_police.js',
                ),
                'predendFile' => array()
            ),
            'addJsScript'       => array(),
            'addVbscriptScript' => array(),
            'addCss'            => array()
        ));        
    }
    public function indexAction()
    {
        $this->setAsset();
        $this->brtsViewHelper->setPageTitle($this->translateHelper->translate('index'));

        $viewModel = new ViewModel();
        return $viewModel;
    }
    public function helpAction()
    {
        $this->setAsset();
        $this->brtsViewHelper->setPageTitle($this->translateHelper->translate('Aide'));

        $viewModel = new ViewModel();
        return $viewModel;
    }
    public function clientAction()
    {
        $this->setAsset();
        $this->brtsViewHelper->setPageTitle($this->translateHelper->translate('Contact'));

        $form = new Form\Contact();
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $formData = $request->getPost();
            $form->setData($formData);
            if ($form->isValid()) {
//               $formData = $form->getData();
//               $message = new Message();
//               $message->addTo('contact@gmail.com');
//               $message->setFrom($formData['web_identity']['email']);
//               $message->setSubject($formData['simple_message']['subject']);
//               $message->setBody($formData['simple_message']['message']);
//               try {
//                   $email = new Smtp($this->getServiceLocator()->get('SmtpOptions'));
//                   $email->send($message);
//               } catch(\RuntimeException $e) {
//                    $this->plugin('flashmessenger')->addErrorMessage("Le formulaire est actuellement indisponible, merci d'utiliser l'adresse email contact@zend-framework-2.fr.");
//                    return $this->plugin('redirect')->toRoute('contact');
//               }
               
               $this->plugin('flashmessenger')->addValidMessage('Merci pour cet email. Une réponse est envoyée généralement sous 24h.');
               return $this->plugin('redirect')->toRoute('test', array('action' => 'client'));
            } else {
                $form->setData($formData);
                $this->plugin('flashmessenger')->addErrorMessage('Merci de remplir tous les champs du formulaire.');
            }
        }
        
        $viewModel = new ViewModel(array(
            'form' => $form
        ));
        return $viewModel;
    }
}
