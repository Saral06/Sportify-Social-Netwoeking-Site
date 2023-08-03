<?php

    class User
    {
        public function get_data($id)
        {
            $query="select * from users where userid='$id' limit 1";
            $DB=new Database();
            $result=$DB->read($query);

            if($result)
            {

                $row=$result[0];
                return $row;
            }
            else
            {
                return false;
            }
        }

        public function get_user($id)
        {
            $query="select * from users where userid='$id' limit 1";
            
            $DB=new Database();
            $result=$DB->read($query);

            if($result)
            {
                return $result[0];
            }
            else
            {
                return false;
            }

        }

        public function get_friends($id)
        {
            $query="select * from users where userid!='$id'";
            $DB=new Database();
            $result=$DB->read($query);

            if($result)
            {

                $row=$result;
                return $row;
            }
            else
            {
                return false;
            }
        }

        public function get_following($id,$type)
        {
            $DB=new Database();
            $type=addslashes($type);

            if(is_numeric(($id)))
            {
                // get following details

                $sql="select * from likes where type='$type' && contentid='$id' limit 1";
                // print_r($sql);
                $result=$DB->read($sql);
                // print_r($result);
                if(is_array($result))
                {
                    $following=json_decode($result[0]['following'],true);
                    return $following;
                }
            }
            return false;
        }

        public function follow_user($id,$type,$sportify_userid)
        {         
                // increment type likes
                $DB=new Database();
                // save likes details

                $sql="select * from likes where type='$type' && contentid='$sportify_userid' limit 1";
                // print_r($sql);
                $result=$DB->read($sql);
                // print_r($result);
                var_dump(is_array($result));
                if(is_array($result)&& strlen(trim($result[0]["following"])))
                {
                    
                    $likes=json_decode($result[0]['following'],true);
                    // print_r($likes);
                    // var_dump($likes);
                    
                    $user_ids=array_column($likes,"userid");
                    print_r($user_ids);
                    // $likes=json_decode($result[0]['following'],true);

                    if(!in_array($id,$user_ids)) //entry exist therefore unlike
                    {
                        $arr["userid"]=$id;
                        $arr["date"]=date("Y-m-d H:i:s");

                        $likes[]=$arr;

                        $likes_string=json_encode($likes);

                        $sql="update likes set following='$likes_string' where type='$type' && contentid='$sportify_userid' limit 1";
                        // print_r($sql);
                        $DB->save($sql);
                        
                    }
                    else
                    {
                        $key=array_search($id,$user_ids);
                        unset($likes[$key]);
                        $likes_string=json_encode($likes);
                       

                        $sql="update likes set following='$likes_string' where type='$type' && contentid='$sportify_userid' limit 1";
                        // print_r($sql);
                        $DB->save($sql);

                    }
                
                }
                else
                {
                    $arr["userid"]=$id;
                    $arr["date"]=date("Y-m-d H:i:s");

                    $arr2[]=$arr;

                    $following=json_encode($arr2);
                    $sql="update likes set following='$following' where type='$type' && contentid='$sportify_userid' limit 1";
                    $DB->save($sql);

                }
                // die; 
        }

    
    }


?>