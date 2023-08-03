<?php

    class Signup
    {
        private $error="";

        public function evaluate($data)
        {
            foreach($data as $key=>$value)
            {
                if(empty($value))
                {
                    $this->error.=$key." is empty!<br>";
                }

                if($key=="first_name")
                {
                    if(!preg_match("/^[a-zA-Z]+$/",$value))
                    {
                        $this->error.="First name should contain only alphabets without space!<br>";
                    }
                }

                if($key=="last_name")
                {
                    if(!preg_match("/^[a-zA-Z]+$/",$value))
                    {
                        $this->error.="Last name should contain only alphabets without space!<br>";
                    }
                }

                if($key=="email")
                {
                    if(!filter_var($value,FILTER_VALIDATE_EMAIL))
                    {
                        $this->error.="Invalid email address!<br>";
                    }
                }

            }

            // no error
            if($this->error=="")
            {
                $this->create_user($data);
            }
            else
            {
                return $this->error;
            }
        }

        public function create_user($data)
        {
            $first_name=ucfirst($data['first_name']);
            $last_name=ucfirst($data['last_name']);
            $gender=$data['gender'];
            $email=$data['email'];
            $password=hash("sha1",$data['password']);


            $url_address=strtolower($first_name)."_".strtolower($last_name);
            $userid=$this->create_userid();

            $query="insert into users
            (userid,first_name,last_name,gender,email,password,url_address) 
            values 
            ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";

            // echo $query;
            $DB=new Database();
            $DB->save($query);
        }

        private function create_userid()
        {
            $length=rand(4,19);
            $number="";
            for($i=0;$i<$length;$i++)
            {
                $new_rand=rand(0,9);
                $number.=$new_rand;
            }

            return $number;
        }
    }

?>