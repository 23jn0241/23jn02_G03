<?php
require_once '../helpers/userDAO.php';

if($_SERVER['REQUEST_METHOD']==='POST'){

    $username=$_POST['username'];
    $email=$_POST['email'];
    $age=$_POST['age'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];
    if(!empty($_POST['type'])){
        $type=$_POST['type'];
    }else{
        $type=0;
    }
    
    if(preg_match('/@/',$email)===0){
        $errs['email']='メールアドレスの形式が正しくありません';
    }
    if(!preg_match('/\A.{7,}\z/',$password)){
        $errs['password']='パスワードは8文字以上で入力してください';
    }else if($password !== $password2){
        $errs['password']='パスワードが一致しません';
    }
    if($username ===''){
        $errs['username']='お名前を入力してください';
    }
    if(empty($errs)){
        $user=new User();
        $user->username=$username;
        $user->email=$email;
        $user->type=$type;
        $user->password=$password;
        $user->age=$age;
        
        $userDAO=new userDAO();
        $userDAO->insert($user);
        header('Location: ../ログイン画面/login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>新規アカウント登録</title>
    <link href="user.css" rel="stylesheet">
</head>

<body>
<?php include "../header/header.php" ?> 
    <h2>新規アカウント登録</h2>
    <p>以下の項目を入力し、登録ボタンをクリックしてください(*は必須)</p>
    <form action="" method="POST">
        <table>
            <div class="input-group">
                <label for="username">新規ユーザー名*</label>
                <input type="text" placeholder="例)電子太郎" name="username" minlength="1" required>
                <span style="color:red"><?=@$errs['username'] ?></span>
            </div></br>

            <div class="input-group">
                <labal for="email">新規メールアドレス*</label>
                <input type="text" placeholder="例)aaa@aaa.aa.aa" name="email" autofocus required>
                <span style="color:red"><?= @$errs['email'] ?></span>
            </div></br>

            <div class="input-group">
                <label for="password">新規パスワード(半角英数字8文字以上)*</label>
                <input type="password" placeholder="例)abcd0123" name="password" minlength="8"  required>
                <span style="color:red"><?= @$errs['password'] ?></span>
            </div></br>

            <div class="input-group">
                <label for="password2">パスワード(再入力)*</label>
                <input type="password" name="password2" minlength="8"  required>
                <span style="color:red"><?= @$errs['password'] ?></span>
            </div></br>

            <div class="input-group">
                <label for="sei">性別 <br>
                    <div class="rabel">
                        <label for="r_male">男性 <input id="r_male" type="radio" name="type" value=1></label>
		                <label for="r_female">女性 <input id="r_female" type="radio" name="type" value=2></label>
                    </div>
                </label>
            </div>

            <div class="input-group">
                <label for="age">年齢</label></br>
                <div class="rabel">
                    <input type="number" step="1" name="age" minlength="1">
                </div>
            </div></br>
        </table>
        <input type="submit" value="新規登録">
    </form>

</body>

</html>