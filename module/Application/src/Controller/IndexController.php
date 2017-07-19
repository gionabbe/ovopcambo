<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Entity\User;

/**
 * This is the main controller class of the User Demo application. It contains
 * site-wide actions such as Home or About.
 */
class IndexController extends AbstractActionController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor. Its purpose is to inject dependencies into the controller.
     */
    public function __construct($entityManager)
    {
       $this->entityManager = $entityManager;
    }

    /**
     * This is the default "index" action of the controller. It displays the
     * Home page.
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * This is the "about" action. It is used to display the "About" page.
     */
    public function aboutAction()
    {
        $appName = 'OVOP User Role';
        $appDescription = 'This is the implementation of user role-based access control with RBAC of Zend Framework 3 in ovop project';

        // Return variables to view script with the help of
        // ViewObject variable container
        return new ViewModel([
            'appName' => $appName,
            'appDescription' => $appDescription
        ]);
    }

    /**
     * This is the "mission" action. It is used to display the "Mission" page.
     */
    public function missionAction()
    {
        $appName = 'OVOP Mission';
        $appDescription = 'This is the mission page of ovop project';

        // Return variables to view script with the help of
        // ViewObject variable container
        return new ViewModel([
            'appName' => $appName,
            'appDescription' => $appDescription
        ]);
    }

    /**
     * This is the "vision" action. It is used to display the "Vision" page.
     */
    public function visionAction()
    {
        $appName = 'OVOP Vision';
        $appDescription = 'This is the vision page of ovop project';

        // Return variables to view script with the help of
        // ViewObject variable container
        return new ViewModel([
            'appName' => $appName,
            'appDescription' => $appDescription
        ]);
    }

    /**
     * The "settings" action displays the info about currently logged in user.
     */
    public function settingsAction()
    {
        $id = $this->params()->fromRoute('id');

        if ($id!=null) {
            $user = $this->entityManager->getRepository(User::class)
                    ->find($id);
        } else {
            $user = $this->currentUser();
        }

        if ($user==null) {
            $this->getResponse()->setStatusCode(404);
            return;
        }

        if (!$this->access('profile.any.view') &&
            !$this->access('profile.own.view', ['user'=>$user])) {
            return $this->redirect()->toRoute('not-authorized');
        }

        return new ViewModel([
            'user' => $user
        ]);
    }
}

