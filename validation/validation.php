<?php 
class Validation
{
    public $error;
        function convert($s)
        {
            if ($s > 1000000000) {
                $m = number_format($s / 1000000000, 2);
                $m = (string)$m . "b";
                return $m;
            } elseif ($s > 1000000000000) {
                $m = number_format($s / 1000000000000, 2);
                $m = (string)$m . "t";
                return $m;
            } elseif ($s > 1000000) {
                $m = number_format($s / 1000000, 2);
                $m = (string)$m . "m";
                return $m;
            } elseif ($s > 1000) {
                $m = number_format($s / 1000, 2);
                $m = (string)$m . "k";
                return $m;
            }
        }
        function validateName($pst)
        {
            foreach($pst as $k=>$v)
            {
                if($k=='firstname' || $k=='lastname')
                {
                    if(empty($pst[$k]))
                    {
                        $this->error[$k]="Please Enter $k";
                    }
                    if(is_numeric($pst[$k]) || preg_match('/[^a-z_+-0-9]/i',$pst[$k]))
                    {       
                        $this->error[$k]="Please Enter Correct $k";
                    }
                    for($i=0;$i<strlen($pst[$k]);$i++)
                    {
                        if($pst[$k][$i]==" ")
                        {
                            $this->error[$k]="Please Don't Enter space in $k";
                            break;
                        }
                    }
                }
            }
            return $this->error;
        }
        function validateEmail($email,$password)
        {
            if(empty($email))
            {
                $this->error['email'] = "Email is required";
            }
            else
            {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $this->error['email']="Please enter Valid Email";
                }
            }
            if(empty($password))
            {
                $this->error['password']="Password is Required";
            }
            else
            {   $password=trim($password);
                if(empty($password))
                {
                    $this->error['password']="Please don't enter spaces in password";
                }
                
            }
            return $this->error;
        }
        function validateCoins($pst,$key)
        {
            if(empty($pst[$key]))
            {
                $this->error[$key]="Please enter valid coins";
            }
            elseif(!isset($_SESSION['login']))
            {
                $this->error[$key]="Please first login to $key coins <a href='user/user_login.php'>LOGIN</a>";
            }
            return $this->error;
        }
}



?>