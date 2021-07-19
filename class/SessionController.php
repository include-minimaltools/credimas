<?php

require_once 'class/SESSION.php';
require_once 'database/USER.php';

class SessionController extends Controller
{
    private $userSession;
    private $username;
    private $userId;

    private $session;
    private $sites;
    private $defaultSites;

    private $user;

    function __construct()
    {
        parent::__construct();
        $this->init();
    }

    private function init()
    {
        $this->session = new SESSION();

        $json = $this->getJSONFileConfig();
        
        $this->sites = $json['sites'];
        $this->defaultSites = $json['default-sites'];

        $this->validateSession();
    }

    private function getJSONFileConfig()
    {
        return json_decode(
            file_get_contents('config/access.json'),
            true);
    }

    public function ValidateSession()
    {
        if($this->existsSession())
        {
            $role = $this->getUserSessionData()->ROLE;

            if($this->isPublic())
            {
                $this->redirectDefaultSiteByRole($role);
            }
            else
            {
                if($this->isAuthorized($role))
                {
                    
                }
                else
                {
                    $this->redirectDefaultSiteByRole($role);
                }
            }
        }
        else
        {
            if($this->isPublic())
            {

            }
            else
            {
                header('location: ' . constant('URL') . '');
            }
        }
    }

    private function existsSession()
    {
        if(!$this->session->Exists()) return false;
        if($this->session->getCurrentUser() == NULL) return false;

        $userid = $this->session->getCurrentUser();
        
        if($userid)
            return true;
        else
            return false;
    }

    function getUserSessionData()
    {
        $id = $this->session->GetCurrentUser();
        if($id == null)
            return new User();
        $this->user = new USER();
        $this->user->Get($id);
        return $this->user;
    }

    private function isPublic()
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace( "/\?.*/", "", $currentURL);

        foreach ($this->sites as $key => $site) 
            if($currentURL === $site['site'] && $site['access'] == 'public') 
                return true;
        
        return false;
    }

    private function getCurrentPage()
    {
        $Link = trim($_SERVER['REQUEST_URI']);
        $url = explode('/', $Link);
        return $url[2];
    }

    private function redirectDefaultSiteByRole($role)
    {
        $url = '';
        
        foreach ($this->sites as $key => $site) 
        {
            foreach ($site['role'] as $key => $roleAvailable) {
                if($roleAvailable == $role)
                {
                    $url = '/' . $site['site'];
                    break;    
                }
            }
        }
        // for($i = 0; $i < sizeof($this->sites); $i++)
        //     if($this->sites[$i]['role'] == $role)
        //     {
        //         $url = '/' . $this->sites[$i]['site'];
        //         break;
        //     }

        header('location:' . constant('URL') . $url);
    }

    private function isAuthorized($role)
    {
        $currentURL = $this->getCurrentPage();
        $currentURL = preg_replace('/\?.*/', "", $currentURL);

        foreach ($this->sites as $key => $site) 
        {
            if($site['site'] == $currentURL)
                foreach ($site['role'] as $key => $roleAvailable) {
                    if($role == $roleAvailable)
                        return true;
                }
            
        }
        
        return false;
    }

    public function AuthorizeAccess($role)
    {
        $this->redirect($this->defaultSites[$role], []);
    }

    public function Initialize($user)
    {
        $this->session->setCurrentUser($user->ID);
        $this->AuthorizeAccess($user->ROLE);
    }

    public function Logout()
    {
        $this->session->CloseSession();
    }
}

?>