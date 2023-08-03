<?php

    class Image
    {
        public function crop_image($original_file_name,$cropped_file_name,$max_width,$max_height)
        {
            if(file_exists($original_file_name))
            {
                $original_image=imagecreatefromjpeg($original_file_name);
                $original_width=imagesx($original_image);
                $original_height=imagesy($original_image);

                if($original_height>$original_width)
                {
                    // make width equal to max width
                    $ratio=$max_width/$original_width;
                    $new_width=$max_width;
                    $new_heigth=$original_height*$ratio;
                }
                else
                {
                    $ratio=$max_height/$original_height;
                    $new_width=$original_width*$ratio;
                    $new_heigth=$max_height;
                }
            }

            // addjust in case max width and height are different
            if($max_width!=$max_height)
            {
                if($max_height>$max_width)
                {
                    if($max_height>$new_heigth)
                    {
                        $adjustment=$max_height/$new_heigth;
                    }
                    else
                    {
                        $adjustment=$new_heigth/$max_height;
                    }
                    $new_width=$new_width*$adjustment;
                    $new_heigth=$new_heigth*$adjustment;
                }
                else
                {
                    if($max_width>$new_width)
                    {
                        $adjustment=$max_width/$new_width;
                    }
                    else
                    {
                        $adjustment=$new_width/$max_width;
                    }
                    $new_width=$new_width*$adjustment;
                    $new_heigth=$new_heigth*$adjustment;
                }
            }

            

            $new_image=imagecreatetruecolor($new_width,$new_heigth);

            imagecopyresampled($new_image,$original_image,0,0,0,0,$new_width,$new_heigth,$original_width,$original_height);

            imagedestroy($original_image);

            if($max_width!=$max_height)
            {
                if($max_width>$max_height)
                {
                    $diff=$new_heigth-$max_height;
                    if($diff<0)
                    {
                        $diff*=-1;
                    }
                    $y=round($diff/2);
                    $x=0;
                }
                else
                {
                    $diff=$new_width-$max_height;
                    if($diff<0)
                    {
                        $diff*=-1;
                    }
                    $x=round($diff/2);
                    $y=0;
                }
            }
            else
            {
                if($new_heigth>$new_width)
                {
                    $diff=$new_heigth-$new_width;
                    $y=round($diff/2);
                    $x=0;
                }
                else
                {
                    $diff=$new_width-$new_heigth;
                    $x=round($diff/2);
                    $y=0;
                }
            }

            $new_cropped_image=imagecreatetruecolor($max_width,$max_height);

            imagecopyresampled($new_cropped_image,$new_image,0,0,$x,$y,$max_width,$max_height,$max_width,$max_height);
            
            imagedestroy($new_image);
            imagejpeg($new_cropped_image,$cropped_file_name,90);
            imagedestroy($new_cropped_image);
        }

        public function resize_image($original_file_name,$resized_file_name,$max_width,$max_height)
        {
            if(file_exists($original_file_name))
            {
                $original_image=imagecreatefromjpeg($original_file_name);
                $original_width=imagesx($original_image);
                $original_height=imagesy($original_image);

                if($original_height>$original_width)
                {
                    // make width equal to max width
                    $ratio=$max_width/$original_width;
                    $new_width=$max_width;
                    $new_heigth=$original_height*$ratio;
                }
                else
                {
                    $ratio=$max_height/$original_height;
                    $new_width=$original_width*$ratio;
                    $new_heigth=$max_height;
                }
            }

            // addjust in case max width and height are different
            if($max_width!=$max_height)
            {
                if($max_height>$max_width)
                {
                    if($max_height>$new_heigth)
                    {
                        $adjustment=$max_height/$new_heigth;
                    }
                    else
                    {
                        $adjustment=$new_heigth/$max_height;
                    }
                    $new_width=$new_width*$adjustment;
                    $new_heigth=$new_heigth*$adjustment;
                }
                else
                {
                    if($max_width>$new_width)
                    {
                        $adjustment=$max_width/$new_width;
                    }
                    else
                    {
                        $adjustment=$new_width/$max_width;
                    }
                    $new_width=$new_width*$adjustment;
                    $new_heigth=$new_heigth*$adjustment;
                }
            }

            

            $new_image=imagecreatetruecolor($new_width,$new_heigth);

            imagecopyresampled($new_image,$original_image,0,0,0,0,$new_width,$new_heigth,$original_width,$original_height);

            imagedestroy($original_image);

            
            imagejpeg($new_image,$resized_file_name,90);
            imagedestroy($new_image);
        }

        // create thumbnail for cover image
        public function get_thumb_cover($filename)
        {
            $thumbnail=$filename."_cover_thumb.jpg";
            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            $this->crop_image($filename,$thumbnail,1366,488);

            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            else
            {
                return $filename;
            }
        }

        // create thumbnail for profile image
        public function get_thumb_profile($filename)
        {
            $thumbnail=$filename."_profile_thumb.jpg";
            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            $this->crop_image($filename,$thumbnail,600,600);

            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            else
            {
                return $filename;
            }
        }

        // create thumbnail for post image
        public function get_thumb_post($filename)
        {
            $thumbnail=$filename."_post_thumb.jpg";
            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            $this->crop_image($filename,$thumbnail,600,600);

            if(file_exists($thumbnail))
            {
                return $thumbnail;
            }
            else
            {
                return $filename;
            }
        }

        public function generate_filename($length)
        {
            $array=array(0,1,2,3,4,5,6,7,8,9,'q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','C','V','B','N','M');
            $text="";

            for($i=0;$i<$length;$i++)
            {
                $random=rand(0,61);
                $text.=$array[$random];
            }

            return $text;
        }
    }

?>