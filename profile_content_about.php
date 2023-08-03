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

                echo "<br>About Me:<br>
                <div id='textbox' style='height:200px; padding-top:10px;'>".htmlspecialchars($settings['about'])."</div>";
            }

        ?>
        </form>
    </div>
</div>