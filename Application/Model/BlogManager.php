<?php

class BlogManager
{

    private $connectionParam = [
        'host' => '',
        'port' => '',
        'user' => '',
        'password' => '',
        'dbname' => ''
    ];
    private $db;

    public function __construct($appConfig = null)
    {
        $this->connectionParam = $appConfig['connection']['params'];
        $this->db = new mysqli(
            $this->connectionParam['host'], 
            $this->connectionParam['user'], 
            $this->connectionParam['password'], 
            $this->connectionParam['dbname']
        );
        if (mysqli_connect_errno())
        {
            printf("Connect failed: %s\n", mysqli_connect_error());
            if (strpos(mysqli_connect_error(), "Unknown database") !== NULL)
            {
                $this->install();
            }
            exit();
        }
    }
    
    private function install()
    {
        $conn = new mysqli(
            $this->connectionParam['host'], 
            $this->connectionParam['user'], 
            $this->connectionParam['password']
        );
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "CREATE DATABASE " . $this->connectionParam['dbname']
            // . " CHARACTER SET utf8 COLLATE utf8_unicode_ci "
        ;
        if ($conn->query($sql) === TRUE)
        {
            echo "<br/> Database created successfully <br/>";
            $sql = file_get_contents('../data/schema.mysql.sql');
            if (mysqli_multi_query($conn, $sql))
            {
                echo "<br/> Database installed successfully <br/>";
            } else
            {
                echo "<br/> Error installing database: <br/>" . $conn->error;
            }
        } else
        {
            echo "<br/> Error creating database: <br/>" . $conn->error;
        }
        $conn->close();
    }
    
    public function findAllPublishedPosts()
    {
        $order = "";
        if(isset($GLOBALS["order"])) $order = " ORDER by " . $GLOBALS["order"];
        $posts = array();
        $query =  " SELECT post.*, username as author  "
                . " FROM post " . $order ;
        // printf($query);
        $result = $this->db->query($query);
        if ($result) {
            // Cycle through results
            while ($row = $result->fetch_assoc()) {
                $posts[] = array(
                    'id' => $row['id'],
                    'status' => $row['status'],
                    'email' => $row['email'],
                    'content' => $row['content'],
                    'username' => $row['username'],
                    'date_created' => $row['date_created'],
                );
            }
            // Free result set
            $result->close();
        } else echo($this->db->error);
        return $posts;
    }

    public function findOnePostById($id) {
        $post = array();
        $query = ""
                . "SELECT post.*, username as author "
                . "FROM post "
                . "WHERE post.id = '%s'";
        $query = sprintf($query, $this->db->real_escape_string($id));
        if ($result = $this->db->query($query))
        {
            $row = $result->fetch_assoc();
            $post = array(
                'id' => $row['id'],
                'status' => $row['status'],
                'email' => $row['email'],
                'content' => $row['content'],
                'username' => $row['username'],
                'date_created' => $row['date_created'],
            );
            $result->close();
        } else die($this->db->error);
        return $post;
    }
        
    public function addPost($username, $content, $email) {
        $query =  "INSERT INTO post(`email`, `content`, `status`, `username`) VALUES ( '%s', '%s', 0, '%s')";
        $query = sprintf($query, 
            $this->db->real_escape_string($email),  
            $this->db->real_escape_string($content),  
            $this->db->real_escape_string($username) 
        );
        if ($result = $this->db->query($query)) return true;
        else die($this->db->error);
    }

    public function updatePost($id, $content, $status) {
        $query =  "UPDATE post SET content = '%s', `status` = %d where id = %d";
        $query = sprintf($query, $this->db->real_escape_string($content), $status, $id);
        if ($result = $this->db->query($query)) return true;
        else die($this->db->error);
    }
        
}
