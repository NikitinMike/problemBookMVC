<?php
class BlogController
{
    private $blogManager;
    private $userManager;

    public function __construct($blogModel, $userModel)
    {
        $this->blogManager = $blogModel;
        $this->userManager = $userModel;
    }

    public function nextPageAction($request)
    {        
        var_dump($request);
    }

    public function indexAction($request)
    {        
        $View = new BlogView($this->blogManager);
        $View->renderView($this->blogManager->findAllPublishedPosts());
    }

    public function listAction($request)
    {
        $posts = $this->blogManager->findAllPublishedPosts();
        $View = new BlogView($this->blogManager);
        $View->renderView($posts);
    }

    public function postAction($request)
    {
        $post = $this->blogManager->findOnePostById($request['id']);
        $View = new BlogView($this->blogManager);
        $View->renderView($post);
    }
    
    public function addAction($request)
    {
        $View = new BlogView($this->blogManager);
        $View->renderView($request);
    }
    
    public function addpostsubmittedAction($request)
    {
        $res = $this->blogManager->addPost($request['username'], $request['content'], $request['email']);
        if ($res) $this->redirectAction();
        else $this->redirectAction("/?action=add&error=error");
    }
    
    public function redirectAction($route="/")
    {
        header("location: $route");
        exit;
    }
}