<?php

    include("classes/autoload.php");

    // check whether login or not
    $login=new Login();
    $user_data=$login->check_login($_SESSION['sportify_userid']);
    $USER=$user_data;
    

    if(isset($_SERVER['HTTP_REFERER']))
    {
        $return_to=$_SERVER['HTTP_REFERER'];
    }
    else
    {
        $return_to="profile.php";
    }

    if(isset($_GET['type'])&&isset($_GET['id']))
    {
        if(is_numeric($_GET['id']))
        {
            $allowed[]='post';
            $allowed[]='user';
            $allowed[]='comment';

            if(in_array($_GET['type'],$allowed))
            {
                $post=new Post();
                $user_class=new User();
               
                $post->like_post($_GET['id'],$_GET['type'],$_SESSION['sportify_userid']);
                
                if($_GET['type']=="user")
                {
                    $user_class->follow_user($_GET['id'],$_GET['type'],$_SESSION['sportify_userid']);
                }
                
            }
        }
        
    }

    header("Location: ".$return_to);
    die;

?>