<?php

class Notification extends Controller {
    function index(){
        if(!Auth::logged_in()){
            $this->redirect('login');
        }
        $user = new NotificationModel();
        $notifications = $user->findAll();
        print_r($notifications);
        $this->view('/includes/header1',['notifications'=>$notifications]);
    }
}
