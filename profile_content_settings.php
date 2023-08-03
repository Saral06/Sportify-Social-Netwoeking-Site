<style>

    input[type="radio"] 
    {
        appearance: none;
        padding: 8px;
        background-color: #9DF3C4;;
        border-radius:50%;
        /* background-color: #9DF3C4; */
        /* accent-color: #1FAB89; */
    }
    input[type=radio]:checked 
    {
        background-color: #1FAB89;
    }

</style>

<div style="min-height: 400px;width: 100%; padding-right: 20px; background-color: white;text-align:center">
    <div style="padding: 20px; max-width:350px; display:inline-block; color:#1FAB89;">

    <form method="post" enctype="multipart/form-data">
        <br>
        <?php

            $settings_class=new Settings();

            $settings=$settings_class->get_settings($_SESSION['sportify_userid']);

            if(is_array($settings))
            {
                echo "<input type='text' id='textbox' name='first_name' value='".htmlspecialchars($settings['first_name'])."' placeholder=' First Name'>";
                echo "<input type='text' id='textbox' name='last_name' value='".htmlspecialchars($settings['last_name'])."' placeholder='Last Name'>";
                $gender=$settings['gender'];

        ?>
                <div style="font-size: 18px; text-align: left; margin-left: 10px; font-weight: normal; margin-top:10px; margin-bottom:10px;">
                Gender: &nbsp;

                <input type="radio" name="gender" value="male"
                <?php if (isset($gender) && $gender == "male") echo "checked"; ?> >Male
                <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> >Female
                <input type="radio" name="gender" value="other"
                <?php if (isset($gender) && $gender == "other") echo "checked"; ?> >Other
                </div>

            <?php

                echo "<input type='text' id='textbox' name='email' placeholder='Email' value='".htmlspecialchars($settings['email'])."' >";
                echo "<input type='password' id='textbox' name='password' placeholder='Password' '>";
                echo "<input type='password' id='textbox' name='password2' placeholder='Confirm Password' '>";

                echo "<br>About Me:<br>
                <textarea id='textbox' name='about' style='height:200px;'>".htmlspecialchars($settings['about'])."</textarea>
";
                echo '
                <input type="submit" id="post_button" value="SAVE">';
            }

        ?>
        </form>
    </div>
</div>