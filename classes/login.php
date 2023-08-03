<?php

    class Login
    {
        private $error="";

        public function evaluate($data)
        {
            $email=addslashes($data['email']);
            $password=addslashes($data['password']);

            $query="select * from users where email='$email' limit 1" ;

            // echo $query;
            $DB=new Database();
            $result=$DB->read($query);
            
            if($result)
            {

                $row=$result[0];
                echo $this->hash_text($password);
                if($this->hash_text($password)==$row['password'])
                {
                    
                    // create session data
                    $_SESSION['sportify_userid']=$row['userid'];
                }
                else
                {
                    $this->error.="Wrong email or Password!<br>";
                }
            }
            else
            {
                $this->error.="Wrong email or Password!<br>"; //for obsucrity write wrong email or password
            }

            return $this->error;
        }

        private function hash_text($text)
        {
            $text=hash("sha1",$text);
            return $text;
        }

        public function check_login($id)
        {
            if(is_numeric($id))
            {
                $query="select * from users where userid='$id' limit 1" ;

                $DB=new Database();
                $result=$DB->read($query);
                
                if($result)
                {
                    $user_data=$result[0];
                    return $user_data;
                }
                else
                {
                    header("Location: login.php");
                    die;
                }
            }
            else
            {
                header("Location: login.php");
                die;
            }
        }
    }

?>