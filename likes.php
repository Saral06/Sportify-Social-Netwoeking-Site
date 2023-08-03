<?php
    
    include("classes/autoload.php");

    // check whether login or not
    $login=new Login();
    $user_data=$login->check_login($_SESSION['sportify_userid']);
    $USER=$user_data;

    $Post=new Post();
    $likes=false;

    $error="";
    if(isset($_GET['id'])&&isset($_GET['type']))
    {
        $likes=$Post->get_likes($_GET['id'],$_GET['type']);
    }
    else
    {
        $error="No information was found!<br>";
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> People who Likes | SPORTify </title>
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
                        <?php 
                            $User=new User();
                            $image_class=new Image();

                            if(is_array($likes))
                            {
                                foreach ($likes as $row) 
                                {
                                    $FRIEND_ROW=$User->get_user($row['userid']);
                                    include("user.php");
                                }
                            }
                        ?>
                        <br style="clear: both;">
                    </div>

                </div>
            </div>
        </div>

    </body>
</html>