<?php

/**
 *
 */
class BackNewsController
{

    public function NewsMenuAction() {
        $v = new View("newsMenu");
    }

    public function NewsAddAction() {
        $news = new News();
        $v = new View('newsAdd');
        $v->assign("formNews", $news->getFormNews());
    }

    public function NewsActionAddAction($params) {
        $v = new View("newsActionadd");
    }

    public function NewsActionUpdateAction($params) {
        $v = new View("newsActionupdate");
        $news=((new News())->populate(['id' => $params[0]]));

//        $username = $user->getUsername();
//        $v->assign("idUpdate",$params[0]);
//        $v->assign("usernameUpdate",$username);
    }

//    public function UserUpdateAction($params) {
//        $v = new View("userUpdate");
//
//        $user=((new User())->populate(['id' => $params[0]]));
//        $id = $params[0];
//        $username = $user->getUsername();
//        $firstname = $user->getfirstname();
//        $lastname = $user->getlastname();
//        $email = $user->getEmail();
//
//        $v->assign("formUpdate", $user->getFormUpdate($id,$username,$firstname,$lastname,$email));
//    }

    public function NewsActionDeleteAction($params) {
        $v = new View("newsActionDelete");
        $v->assign("idDelete",$params);
    }

    public function NewsActionRestoreAction($params) {
        $v = new View("newsActionRestore");
        $v->assign("idRestore",$params);
    }


}