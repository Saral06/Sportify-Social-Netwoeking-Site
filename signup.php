<?php

    include("classes/connect.php");
    include("classes/signup.php");

    $first_name="";
    $last_name="";
    @$gender="";
    $email="";


    if($_SERVER['REQUEST_METHOD']=='POST')
    {

        $signup=new Signup();
        $result = $signup->evaluate($_POST);

        if($result!="")
        {
            echo "<div style='text-align:center; font-size:14px; color: red; background-color:#62D2A2'>";
            echo "<br>The following errors occured<br><br>";
            echo $result;
            echo "<br></div>";
        }
        else
        {
            header("Location: login.php");
            die;
        }

        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        @$gender=$_POST['gender'];
        $email=$_POST['email'];
    }


    
?>

<html>

<head>
    <title> SPORTify | SIGN-UP </title>
</head>  

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
    *{
        font-family: 'Poppins', sans-serif;
    }

    body{
        background-image: linear-gradient(315deg, #59ffa7 0%, #fff 100%);
    }

    #bar{
        height:100px;
        background-color:#1FAB89; 
        color:#D7FBE8;
        padding-top: 10px;
        padding-left: 15px;
        margin-bottom: 10px;
        padding-bottom: 10px;
        /* box-shadow: 0 0.4rem 1.4rem 0 #D7FBE8; */
    }
    #signup_button
    {
        color: #1FAB89;
        background-color: #9DF3C4 ;
        width: 80px;
        text-align: center;
        padding: 10px;
        border-radius: 5px;
        float: right;
        margin-right: 20px;
        margin-bottom: 10px;
    }
    #bar2
    {
        border: solid 2px #1FAB89;
        font-weight: bold;
        padding: 10px;
        padding-top: 45px;
        background-color: white; 
        width: 600px; 
        margin: auto; 
        margin-top: 50px;
        text-align: center;
        color: #1FAB89;
        font-size: 25px;
        border-radius: 20px;
        box-shadow: 0 0.4rem 1.4rem 0 #019b49;
    }
    #text
    {
        height: 40px;
        width: 400px;
        border-radius: 20px;
        border: solid 1px #1FAB89;
        padding: 20px;
        font-size: 14px;
    }
    #button
    {
        height: 40px;
        width: 400px;
        border-radius: 20px;
        color: #1FAB89;
        font-size: 18px;
        border: solid 2px #1FAB89;
        background-color: #9DF3C4 ;
        font-weight: bold;
    }
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

<body style="font-family: tahoma; background-color: #D7FBE8">
    <div id="bar"> 
        <div style="font-size: 36px; font-weight: bolder;">SPORTify</div>
        <form>
        <div id="signup_button"><a href="login.php" style="text-decoration:none; color:#1FAB89">LOGIN</a></input></div> 
        </form>
    </div>

    <div id="bar2">
        SIGN UP to SPORTify<br><br>

        <form method="post" action="">
            
            <input
            value="<?php echo $first_name;?>" name="first_name" type="text" id="text" placeholder="First Name"
            ><br><br>
            <input value="<?php echo $last_name;?>"  name="last_name" type="text" id="text" placeholder="Last Name"><br><br>

            <div style="font-size: 18px; text-align: left; margin-left: 100px; font-weight: normal;">
            Gender: &nbsp;

            <input type="radio" name="gender" value="male"
            <?php if (isset($gender) && $gender == "male") echo "checked"; ?> >Male
            <input type="radio" name="gender" value="female" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> >Female
            <input type="radio" name="gender" value="other"
            <?php if (isset($gender) && $gender == "other") echo "checked"; ?> >Other
            </div>
            <br>
            <input value="<?php echo $email;?>" name="email" type="text" id="text" placeholder="Email"><br><br>
            <input name="password" type="password" id="text" placeholder="Password"><br><br>
            <input name="confirm_password" type="password" id="text" placeholder="Confirm Password"><br><br>
            <input type="submit" id="button" value="SIGN UP">
            <br><br><br>

        </form>
    </div>
</body>

</html>
