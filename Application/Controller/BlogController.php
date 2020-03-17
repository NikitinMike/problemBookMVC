<?php
class BlogController
{
    private $blogManager;

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
        if($request['id'])
            $res = $this->blogManager->updatePost($request['id'], trim($request['content']), isset($request['status'])?1:0);
        else
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