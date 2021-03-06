 <?php

class BackuserController
{

    public function UserMenuAction($params) {
        $datausers = new User();

        $type = "user";
        $search = ["id","username","firstname","lastname","email","status","dateInserted"];
        $res = $datausers->getObj($search,$params[0],NB_ITEM_BACK);
        $pageNum = (int)$params[0];
        $pageMax = (int)$res[1];

        if(!empty($params[0]) && $pageNum>0 && $pageNum <= $pageMax ){
        $v = new View("menu");
        $v->assign("search", $search);
        $v->assign("result", $res[0]);
        $v->assign("nbPage", $res[1]);
        $v->assign("type", $type);
        } else {
            $v = new View("page404");
        }
    }

    public function UserMenuRestoreAction($params) {
        $datausers = new User();

        $type = "user";
        $search = ["id","username","firstname","lastname","email","status","dateInserted"];
        $res = $datausers->getArchive($search,$params[0],NB_ITEM_BACK);
        $pageNum = (int)$params[0];
        $pageMax = (int)$res[1];

        if(!empty($params[0]) && $pageNum>0 && $pageNum <= $pageMax ){
            $v = new View("menuRestore");
            $v->assign("search", $search);
            $v->assign("result", $res[0]);
            $v->assign("nbPage", $res[1]);
            $v->assign("type", $type);
        } else {
            $v = new View("page404");
        }
    }

    public function UserAddAction() {
        $user = new User();
        $v = new View('userAdd');
        $v->assign("formRegister", $user->getFormRegisterback());
    }

    public function UserActionAddAction() {
        $v = new View("userActionAdd");
    }

    public function UserUpdateAction($params) {
        $v = new View("userUpdate");

        $user=((new User())->populate(['id' => $params[0]]));
        $id = $params[0];
        $username = $user->getUsername();
        $firstname = $user->getfirstname();
        $lastname = $user->getlastname();
        $email = $user->getEmail();

        $v->assign("formUpdate", $user->getFormUpdate($id,$username,$firstname,$lastname,$email));
    }

    public function UserActionUpdateAction($params) {
        $v = new View("userActionUpdate");
        $user=((new User())->populate(['id' => $params[0]]));

        $username = $user->getUsername();
        $pwdUpdate = $user->getPwd();
        $v->assign("idUpdate",$params[0]);
        $v->assign("usernameUpdate",$username);

        $v->assign("pwdUpdate",$pwdUpdate);
    }

    public function UserActionDeleteAction($params) {
        $v = new View("userActionDelete");
        $v->assign("idDelete",$params);
    }

    public function UserActionRestoreAction($params) {
        $v = new View("userActionRestore");
        $v->assign("idRestore",$params);
    }

    public function UserActionConnectionAction() {
        $v = new View("userActionConnection");
    }

    public function UserConnectionAction() {
        $user = new User();
        $v = new View("userConnection");
        $v->assign("formConnection", $user->getFormConnection());
    }

    public function UserLogoutAction() {
        $v = new View("userLogout");
    }

    public function UserSettingAction() {
        $v = new View("userSetting");
        // Création de la page esgi-aire.com/user/setting
    }

    public function UserActionSettingAction() {
        $v = new View("userActionSetting");
    }


}
