<?php
if(isset($_SESSION['user_id']))
{
    header("Location: ".PATH_RELATIVE."home");
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['pwd']) && $_POST['username'] != '' && $_POST['pwd'] != '') {
/*        $subject = $_POST['username'];
        $subject_pwd = $_POST['pwd'];
        $pattern = '/[][( ){}<>\/+"*%&=?`^\'!$_:;,.]/';
        if (preg_match($pattern, $subject, $matches) == 0 && preg_match($pattern, $subject_pwd, $matches) == 0) {*/
            $user = new User();
            $username = $_POST['username'];
            $password = $_POST['pwd'];
            if ($user->populate(['username' => $username])) { // Si identifiant dans bdd

                $user = $user->populate(['username' => $username]);

                if (password_verify($password, $user->getPwd())) { // Si mdp correspond celui identifiant

                    $status = $user->getStatus();
                    if ($status == 'Admin') {
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $user->getId();
                        $_SESSION['admin'] = '1';
                    } else
                    {
                        session_unset();
                        session_destroy();
                        session_start();
                        $_SESSION['username'] = $username;
                        $_SESSION['user_id'] = $user->getId();
                        $_SESSION['admin'] = 0;
                    }
                    header("Location: ".PATH_RELATIVE."home");

                } else
                    $error[] = "errorPwd";
            } else
                $error[] = "unknownUser";
/*        } else
            $error[] = 15;*/
    } else
        $error[] = "required";
}
?>

<div class="top-image">
    <!--<img src="images/header.png" width="100%" alt="header">-->
    <h1 class="slide-label">Connexion</h1>
</div>

<section class="un" id="Login">
    <div class="container">
        <div class="col1 firstcol">
            <h2 class="text-center">Formulaire de connexion</h2>

            <?php $this->includeModal("form", $formConnectionFront);

            if(isset($error)) {
                ?>
                <div class="info-error">
                    <?php
                    foreach ($error as $e) {
                        echo $msgError[$e];
                    }
                    ?>
                </div>
                <?php
            }
            ?>
            <a href="pwdForgot">Oublie du mot de passe</a>
        </div>
    </div>
</section>
