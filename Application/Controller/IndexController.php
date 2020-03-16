<?php

class IndexController
{
    private $blogManager;
    private $userManager;

    public function __construct($blogModel, $userModel)
    {
        $this->blogManager = $blogModel;
        $this->userManager = $userModel;
    }

    public function aboutAction()
    {
        $View = new BlogView($this->blogManager);
        $View->renderView();
    }

    public function loginAction()
    {
        if ($this->userManager->is_logined())
        {
            $this->redirectAction();
        }
        
        $View = new BlogView($this->blogManager);
        $View->renderView();
    }

    public function loginsubmittedAction($request)
    {
        $res = $this->userManager->login($request['email'], $request['password']);
        if ($res) $this->redirectAction();
        else $this->redirectAction("/?action=login&error=error");
    }

    public function logoutAction()
    {
        $this->userManager->logout();
        $this->redirectAction();
    }
    
    public function redirectAction($route="/")
    {
        header("location: $route");
        exit;
    }

}
