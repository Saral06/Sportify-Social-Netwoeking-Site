<div id="friends">
    <?php

        $image="images/user_Male.jpg";

        if($FRIEND_ROW['gender']=="female")
        {
            $image="images/user_Female.jpg";
        }
        if(file_exists($FRIEND_ROW['profile_image']))
        {
            $image=$image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
        }
    ?>

    <a href="profile.php?id=<?php echo $FRIEND_ROW['userid']; ?>" style='color: #1FAB89;text-decoration: none;'>
    <img id="friends_img" src= "<?php echo $image; ?>"> 
    <br> 
    <?php
        echo $FRIEND_ROW['first_name']." ".$FRIEND_ROW['last_name'];
    ?>
    </a>
    <br style="clear: both;">
</div>