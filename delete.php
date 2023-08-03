<?php
    
    include("classes/autoload.php");

    // check whether login or not
    $login=new Login();
    $user_data=$login->check_login($_SESSION['sportify_userid']);
    $USER=$user_data;

    $Post=new Post();

    $error="";
    if(isset($_GET['id']))
    {
        
        $ROW=$Post->get_one_post($_GET['id']);
        
        if(!$ROW)
        {
            $error="No such post was found!<br>";
        }
        else
        {
            if($ROW['userid']!=$_SESSION['sportify_userid'])
            {
                $error="Access Denied! You can't delete someone else's file!<br>";
            }
        }
    }
    else
    {
        $error="No such post was found!<br>";
    }

    // if something was posted
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $Post->delete_post($_POST['postid']);
        header("Location: profile.php");
        die;
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Delete | SPORTify </title>
    </head>

    <style>
        #bar
        {
            height: 50px;
            background-color: #1FAB89;
            color: #D7FBE8 ;
        }

        #search_box
        {
            width: 400px;
            height: 20px;
            border-radius: 5px;
            border: none;
            /* border: solid 2px #62D2A2; */
            padding: 6px;
            font-size: 14px;
            background-image: url(images/search.png);
            background-repeat: no-repeat;
            background-position: 385px;
        }

        #profile_pic
        {
            width: 150px;
            /* margin-top:-200px; */
            border-radius: 50%;
            border: solid 2px #1FAB89;
        }
        #menu_button
        {
            width: 100px;
            display: inline-block;
            margin: 2px;
            /* padding: 30px; */
        }

        #friends_img
        {
            width: 75px;
            float: left;
            margin: 8px;
        }

        #friends_bar
        {
            text-align: center;
            font-size: 20px;
            margin-top: 20px;
            /* background-color: white; */
            min-height: 400px;
            color: #1FAB89;
            padding: 8px;
        }

        #friends
        {
            clear: both;
            font-size: 12px;
            font-weight: bold;
            color: #1FAB89;
        }

        textarea
        {
            width: 100%;
            height: 60px;
            border: none;
            font-family: "tahoma";
            font-size: 14px;
        }

        #post_button
        {
            float: right;
            background-color: #1FAB89;
            color: #D7FBE8;
            border: none;
            padding: 4px;
            font-size: 14px;
            border-radius: 2px;
            width: 80px;
        }

        #post_bar
        {
            margin-top: 20px;
            background-color: white;
            padding: 10px;
        }

        #post
        {
            padding: 4px;
            font-size: 13px;
            display: flex;
            margin-bottom: 20px;
        }
    </style>
    <body style="font-family: tahoma; background-color: #D7FBE8;">

        <!-- top bar -->
        <!-- <br> -->
        <?php
            include("header.php");
        ?>

        <!-- cover area-->
        <div style="width:800px; margin: auto;min-height: 400px; ">

            <!-- below cover area -->
            <div style="display: flex;">

                <!-- posts area -->
                <div style="min-height: 400px;flex: 2.5; padding: 20px; padding-right: 0px;">

                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                        <form method="post">
                            <?php 

                                if($error!="")
                                {
                                    echo $error;
                                }
                                else
                                {
                                    if($ROW)
                                    {
                                        echo "Are you sure you want to delete this post?? <br><br>";
                                    
                                        $user=new User();
                                        $ROW_user=$user->get_user($ROW['userid']);

                                        include("post_delete.php");

                                        echo "<input type='hidden' name='postid' value='$ROW[postid]'>";

                                        echo "<input type='submit' id='post_button'
                                        value='DELETE'>";
                                    }
                                }
                            ?>
                            <br>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>