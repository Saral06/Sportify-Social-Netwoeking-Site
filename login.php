<?php

session_start();

    include("classes/connect.php");
    include("classes/login.php");

    // $sql="select * from users";
    // $DB=new Database();
    // $result=$DB->read($sql);
    // foreach($result as $row)
    // {
    //     $id=$row['id'];
    //     $password=hash("sha1",$row['password']);
    //     $sql="update users set password='$password' where id='$id' limit 1";
    //     $DB->save($sql);
    // }
    // die;

    $email="";
    $password="";


    if($_SERVER['REQUEST_METHOD']=='POST')
    {

        $login=new Login();
        $result = $login->evaluate($_POST);

        if($result!="")
        {
            echo "<div style='text-align:center; font-size:14px; color: red; background-color:#62D2A2'>";
            echo "<br>The following errors occured<br><br>";
            echo $result;
            echo "<br></div>";
        }
        else
        {
            header("Location: profile.php");
            die;
        }

        $email=$_POST['email'];
        $password=$_POST['password'];
    }

    
?>

<html>

<head>
    <title> SPORTify | LOGIN </title>
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

</style>

<body style="font-family: tahoma; background-color: #D7FBE8">
    <div id="bar"> 
        <div style="font-size: 36px; font-weight: bolder;">SPORTify</div>
        <form>
        <div id="signup_button"><a href="signup.php" style="text-decoration:none;color:#1FAB89;">SIGN UP</a></input></div> 
        </form> 
    </div>

    <div id="bar2">
        LOGIN to SPORTify<br><br>
        <form method="post">
            <input name="email" value="<?php echo $email ?>" type="text" id="text" placeholder="Email"><br><br>
            <input name="password" value="<?php echo $password ?>" type="password" id="text" placeholder="Password"><br><br>
            <input type="submit" id="button" value="LOGIN">
            <br><br><br>
        </form>
    </div>
</body>

</html>
