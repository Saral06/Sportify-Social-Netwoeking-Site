<?php
    
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

        $post=new Post();
        $id=$_SESSION['sportify_userid'];

        $result=$post->create_post($id,$_POST,$_FILES);
        
        if($result=="")
        {
            header("Location: index.php");
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

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Timeline | SPORTify </title>
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
                <!-- friends area-->
                <div style="min-height: 400px; flex: 1;">
                    <div id="friends_bar">


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

                        <a href="profile.php" style="color: #1FAB89; text-decoration: none;">
                        <?php
                        echo $user_data['first_name']." ".$user_data['last_name'];
                        ?>
                        </a>
                    </div>
                    
                </div>
                <!-- posts area -->
                <div style="min-height: 400px;flex: 2.5; padding: 20px; padding-right: 0px;">

                    <div style="border: solid thin #aaa; padding: 10px; background-color: white;">
                    <form method="post" enctype="multipart/form-data">
                        <textarea name="post" placeholder="What's on your mind?"></textarea>
                        <input type="file" name="file">
                        <input type="submit" id="post_button" value="POST">
                        <br>
                    </form>
                    </div>

                    <!-- posts -->
                    <div id="post_bar">

                        <!-- post1 -->
                        <?php
                                // print_r($posts);
                                $DB=new Database();
                                $user_class=new User();
                                $image_class=new Image();
                                
                                $followers=$user_class->get_following($_SESSION['sportify_userid'],"user");

                                // print_r($followers);
                                $followers_ids=false;
                                if(is_array($followers))
                                {
                                    $followers_ids=array_column($followers,"userid");
                                    $followers_ids=implode("','",$followers_ids);
                                }
                                // var_dump($followers_ids);
                                if($followers_ids)
                                {
                                    $myuserid=$_SESSION['sportify_userid'];
                                    $sql="select * from posts where userid='$myuserid' or userid in('".$followers_ids."') order by id desc limit 30";
                                    
                                    $posts=$DB->read($sql);
                                    if($posts)
                                    {
                                        foreach($posts as $ROW)
                                        {
                                            $user=new User();
                                            $ROW_user=$user->get_data($ROW['userid']);

                                            include("post.php");
                                        }
                                    }
                                }
                                
                            
                        ?>
                    </div>
                        
                </div>
            </div>
        </div>

    </body>
</html>