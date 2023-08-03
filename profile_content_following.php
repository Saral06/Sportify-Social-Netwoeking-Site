<div style="min-height: 400px;width: 100%; background-color: white;text-align:center">
    <div style="padding: 20px;"> 
        <?php

            $user_class=new User();
            $image_class=new Image();
            $post_class=new Post();

            $following=$user_class->get_following($user_data['userid'],"user");
            
            if(is_array($following))
            {
                foreach($following as $follower)
                {
                    // print_r($follower);
                    $FRIEND_ROW=$user_class->get_user($follower['userid']);
                    // print_r($FRIEND_ROW);
                    echo "<div style='float:left; padding:20px;'>";
                    include("user.php");
                    echo "</div>";
                }
            }
            else
            {
                echo "This user isnt following anyone!";
            }
        ?>
    </div>
</div> 