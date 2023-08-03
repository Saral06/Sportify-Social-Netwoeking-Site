<?php

    // $_SESSION['sportify_userid']="";
    
    include("classes/autoload.php");

    // check whether login or not
    $login=new Login();
    $user_data=$login->check_login($_SESSION['sportify_userid']);

    $USER=$user_data;

    $profile_data="";
    if(isset($_GET['id'])&&is_numeric($_GET['id']))  //white lisitng as selecting specific id's
    {
        $profile=new Profile();
        $profile_data=$profile->get_profile($_GET['id']);

        if(is_array($profile_data))
        {
            $user_data=$profile_data[0];
        }
    }

    // Posting
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        // var_dump($_FILES);

        if(isset($_POST['first_name']))
        {
             $settings_class = new Settings();
             $settings_class->save_settings($_POST,$_SESSION['sportify_userid']);
        }
        else
        {   
            $post=new Post();
            $id=$_SESSION['sportify_userid'];

            $result=$post->create_post($id,$_POST,$_FILES);
            
            if($result=="")
            {
                header("Location: profile.php");
                die;
            }
            else
            {
                echo "<div style='text-align:center; font-size:14px; color: red; background-color:#62D2A2'>";
                echo "<br>The following errors occured<br><br>";
                echo $result;
                echo "<br></div>";
            }
        }

        
        
    }

    

    // collect posts
    $post=new Post();
    $id=$user_data['userid'];

    // print_r($id);

    $posts=$post->get_posts($id);
    // print_r($posts);

    // collect friends
    $user=new User();
    $id=$user_data['userid'];

    $friends=$user->get_friends($id);

    $image_class=new Image();

?>


<!DOCTYPE html>
<html>
    <head>
        <title> Profile | SPORTify </title>
    </head>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
    *{
        font-family: 'Poppins', sans-serif;
    }
        #bar
        {
            height: 50px;
            background-color: #1FAB89;
            color: #D7FBE8 ;
        }

        #textbox
        {
            margin: 10px;
            width: 100%;
            height: 20px;
            border-radius: 20px;
            border: none;
            border: solid 2px #62D2A2;
            padding: 4px;
            padding-left: 10px;
            font-size: 14px;
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
            margin-top:-200px;
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
            margin-top: 20px;
            background-color: white;
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
            outline: none;
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
            width: 50px;
            min-width: 50px;
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
        /* .nav_bg{
            background-color: #62D2A2;
        } */
    </style>

    <body style="font-family: tahoma; background-color: #D7FBE8;">

        <!-- top bar -->
        <!-- <br> -->
        <?php
            include("header.php");
        ?>

        <!-- cover photo -->
        <div style="width:800px; margin: auto;min-height: 400px;">
            <div style="background-color: white; text-align: center; color: #1FAB89;">

            <?php

                $image="images/cover_photo3.jpg";
                if(file_exists($user_data['cover_image']))
                {
                    $image=$image_class->get_thumb_cover($user_data['cover_image']);
                }

            ?>
                <img src=<?php echo $image; ?> style= "width:100%;">

                <span style="font-size: 12px; color: #1FAB89;">


                    <?php

                        $image="images/user_Male.jpg";
                        if($user_data['gender']=="female")
                        {
                            $image="images/user_Female.jpg";   
                        }
                        if(file_exists($user_data['profile_image']))
                        {
                            $image=$image_class->get_thumb_profile($user_data['profile_image']);
                        }

                    ?>
                    
                    <img src=<?php echo $image; ?> id="profile_pic">
                    <br>

                    <a href="change_profile_image.php?change=profile" style="color: #62D2A2;text-decoration: none;">Change Profile Image</a> |
                    <a href="change_profile_image.php?change=cover" style="color: #62D2A2;text-decoration: none;">Change Cover</a>
                </span>
                <br>
                    <div style="font-size: 20px;"> 
                        <a href="profile.php?id=<?php echo $user_data['userid'] ?>" style="text-decoration: none; color:#1FAB89">
                        <?php 
                            echo $user_data['first_name']." ".$user_data['last_name']
                        ?>
                        </a>

                        <?php

                            $mylikes="";
                            if($user_data['likes']>1)
                            {
                                $mylikes="(".$user_data['likes']." Followers)";
                            }
                            else if($user_data['likes']==1)
                            {
                                $mylikes="(".$user_data['likes']." Follower)";
                            }
                        ?>
                        <br>
                        <a href="like.php?type=user&id=<?php echo $user_data['userid']; ?>">
                        <input type="button" id="post_button" value="FOLLOW <?php echo $mylikes ?>" style="background-color:#62D2A2; color:#D7FBE8; width:auto; margin-right:10px">
                        </a>
                        <br>

                    </div>
                <br>
                


                <a href="index.php"><div id="menu_button" style="color: #1FAB89;">Timeline</div></a>
                <a href="profile.php?section=about&id=<?php echo $user_data['userid'] ?>" style="color: #1FAB89;"><div id="menu_button">About</div></a> 
                <a href="profile.php?section=followers&id=<?php echo $user_data['userid'] ?>" style="color: #1FAB89;"><div id="menu_button">Followers</div></a> 
                <a href="profile.php?section=following&id=<?php echo $user_data['userid'] ?>" style="color: #1FAB89;"><div id="menu_button">Following</div></a> 
                <a href="profile.php?section=photos&id=<?php echo $user_data['userid'] ?>" style="color: #1FAB89;"><div id="menu_button">Photos</div></a> 
                <?php
                if($user_data['userid']==$_SESSION['sportify_userid'])
                echo '
                    <a href="profile.php?section=settings&id='.$user_data['userid'].'" style="color: #1FAB89;"><div id="menu_button">Settings</div></a>';
                ?>

            </div>

            <!-- below cover area -->

            <?php
                $section="default";
                if(isset($_GET['section']))
                {
                    $section=$_GET['section'];
                }
                if($section=="default")
                {
                    include("profile_content_default.php");
                }
                else if($section=="photos")
                {
                    include("profile_content_photos.php");
                }
                else if($section=="followers")
                {
                    include("profile_content_followers.php");
                }
                else if($section=="following")
                {
                    include("profile_content_following.php");
                }
                else if($section=="settings")
                {
                    include("profile_content_settings.php");
                }
                else if($section=="about")
                {
                    include("profile_content_about.php");
                }
            ?>
            
        </div>

        <!-- <script>
            const btn = document.getElementById('menu_button');
            function onClick(){
                btn.style.backgroundColor = "green";
            }

            btn.addEventListener('click', onClick, false);
        </script> -->
    </body>
</html>