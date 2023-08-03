<?php
// $USER=$user_data;
    $corner_image="images/user_Male.jpg";
    
    if($USER['gender']=="female")
    {
        $corner_image="images/user_Female.jpg";
    }
    if(file_exists($USER['profile_image']))
    {
        $image_class=new Image();
        $corner_image=$image_class->get_thumb_profile($USER['profile_image']);
    }

?>


<div id="bar">
    <form method="get" action="search.php">

    <div style="margin: auto; width: 800px; font-size: 30px;">

        <a href="index.php" style="color: #D7FBE8;text-decoration: none;">SPORTify</a> 
                
        &nbsp; &nbsp;
        
            <input type="text" id="search_box" placeholder="Search for people" name="find">
        

        <a href="profile.php">
        <img src="<?php echo $corner_image; ?>" style="width: 50px; float: right;">
        </a>

        <a href="logout.php">
        <span style="font-size: 15px; float: right; margin:15px; color: #D7FBE8;">  Logout </span>
        </a>
                
    </div>
    </form>
</div>