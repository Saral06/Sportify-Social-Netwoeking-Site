    <div id="post">
        <div>

        <?php

            $image="images/user_Male.jpg";
        
            if($ROW_user['gender']=="female")
            {
                $image="images/user_Female.jpg";
            }
            $image_class=new Image();
            if(file_exists($ROW_user['profile_image']))
            {
                $image=$image_class->get_thumb_profile($ROW_user['profile_image']);
            }
            ?>
            <img src= "<?php echo $image; ?>" style="width: 75px; margin-right: 4px; border-radius: 50%">
                                        
        </div>
        <div style="width :100%;">
            <div style="font-weight: bold; color: #1FAB89; ">
                <?php
                    echo htmlspecialchars($ROW_user['first_name'])." ".htmlspecialchars($ROW_user['last_name']);

                    if($ROW['is_profile_image'])
                    {
                        $pronoun="his";
                        if($ROW_user['gender']=="female")
                        {
                            $pronoun="her";
                        }
                        echo "<span style='font-weight: normal; color:#aaa;'> Updated $pronoun Profile Image</span>";
                    }
                    if($ROW['is_cover_image'])
                    {
                        $pronoun="his";
                        if($ROW_user['gender']=="female")
                        {
                            $pronoun="her";
                        }
                        echo "<span style='font-weight: normal; color:#aaa;'> Updated $pronoun Cover Image</span>";
                    }
                ?>
            </div>
            <?php 
                echo htmlspecialchars($ROW['post']);
            ?>
            <br><br>

            <?php 
                if(file_exists($ROW['image']))
                {
                    $post_image=$image_class->get_thumb_post($ROW['image']);
                    echo "<img src='$post_image' style='width:60%;'>";
                }
            ?>

            
        </div>
    </div>
