<div style="min-height: 400px;width: 100%; padding-right: 0px; background-color: white;text-align:center">
    <div style="padding: 20px;"> 
        <?php

            $user_class=new User();
            $image_class=new Image();
            $post_class=new Post();

            $followers=$post_class->get_likes($user_data['userid'],"user");
            if(is_array($followers))
            {
                foreach($followers as $follower)
                {
                    $FRIEND_ROW=$user_class->get_user($follower['userid']);
                    echo "<div style='float:left; padding:20px;'>";
                    include("user.php");
                    echo "</div>";
                }
            }
            else
            {
                echo "No followers!";
            }
        ?>
    </div>
</div> 