    <div id="post">
        <div>

        <?php

            $image="images/user_Male.jpg";
        
            if($ROW_user['gender']=="female")
            {
                $image="images/user_Female.jpg";
            }
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
                    echo "<img src='$post_image' style='width:100%;'>";
                }
            ?>

            <br><br>

            <?php

                $likes="";

                $likes=($ROW['likes']>0)? " (".$ROW['likes'].")" : "";


            ?>
            <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>" style="color:#1FAB89; text-decoration: none;">Like<?php echo $likes?></a>&nbsp;&nbsp;<a href="" style="color:#1FAB89; text-decoration: none;">Comment</a>&nbsp;<span style="color: #aaa;">
                <?php
                    echo $ROW['date'];
                ?>
            </span>
            <?php

                $post=new Post();

                if($post->i_own_post($ROW['postid'],$_SESSION['sportify_userid']))
                {
                    echo "
                    <span style='color: #1FAB89; float:right;'>
                    <a href='edit.php?id=$ROW[postid]' style='color: #1FAB89;'>
                        Edit
                    </a>.
                    <a href='delete.php?id=$ROW[postid]' style='color: #1FAB89;'>
                        Delete
                    </a>
                    </span>";
                }
                ?>

                <?php
                    $i_liked=false;
                    if(isset($_SESSION['sportify_userid']))
                    {
                        $DB=new Database();

                        $sql="select likes from likes where type='post' && contentid='$ROW[postid]' limit 1";
                        $result=$DB->read($sql);
                        if(is_array($result))
                        {
                            $likes=json_decode($result[0]['likes'],true);

                            $user_ids=array_column($likes,"userid");

                            if(in_array($_SESSION['sportify_userid'],$user_ids))
                            {
                                $i_liked=true;
                            }
                        }
                    }

                    if($ROW['likes']>0)
                    {
                        echo "<br>";
                        echo "<a href='likes.php?type=post&id=$ROW[postid]'>";
                        if($ROW['likes']==1)
                        {
                            if($i_liked)
                            {
                                echo "<span style='float:left color: #1FAB89;text-decoration: none;'>"."You liked this post </span>";
                            }
                            else
                            {
                                echo "<span style='float:left; color: #1FAB89;text-decoration: none;'>"."1 person liked this post </span>";
                            }
                        }
                        else
                        {
                            if($i_liked)
                            {
                                $text="others";
                                if(($ROW['likes']-1)==1)
                                {
                                    $text="other";
                                }
                                echo "<span style='float:left; color: #1FAB89;text-decoration: none;'>"."You and ".($ROW['likes']-1)."  $text liked this post </span>";
                            }
                            else
                            {
                                echo "<span style='float:left; color: #1FAB89;text-decoration: none;'>".$ROW['likes']." people liked this post </span>";
                            }
                        }
                    }
                    echo "</a>";
                ?>
        </div>
    </div>
