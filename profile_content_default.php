<div style="display: flex;">
                <!-- friends -->
                <div style="min-height: 400px; flex: 1;">
                    <div id="friends_bar">
                        Friends<br>
                        <?php
                            if($friends)
                            {
                                foreach($friends as $FRIEND_ROW)
                                {
                                    include("user.php");
                                }
                            }
                        ?>

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

                    <?php
                        if($posts)
                        {
                            // print_r($posts);
                            foreach($posts as $ROW)
                            {
                                $user=new User();
                                $ROW_user=$user->get_data($ROW['userid']);

                                include("post.php");
                            }
                        }
                    ?>

                    </div>
                </div>
            </div>