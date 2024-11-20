<?php
require_once 'DAO.php';

class User
{
    public int $userid;
    public string $username;
    public string $password;
    public string $email;
    public string $type;
    public int $age;
}

class UserDAO
{
    public function insert(User $user)
    {
        $dbh=DAO::get_db_connect();
        $sql="INSERT INTO users(user_name,password,email,type,age) VALUES(:user_name,:password,:email,:type,:age)";
        
        $stmt=$dbh->prepare($sql);

        #$password=password_hash($user->password,PASSWORD_DEFAULT);

        $stmt->bindValue(':user_name',$user->username,PDO::PARAM_STR);
        $stmt->bindValue(':password',$user->password,PDO::PARAM_STR);
        $stmt->bindValue(':email',$user->email,PDO::PARAM_STR);
        $stmt->bindValue(':type',$user->type,PDO::PARAM_STR);
        $stmt->bindValue(':age',$user->age,PDO::PARAM_INT);

        $stmt->execute();
    }
}
