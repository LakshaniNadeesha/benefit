<?php

class Notification extends Controller {
    function index(){
        if(!Auth::logged_in()){
            $this->redirect('login');
        }
        $user = new NotificationModel();
        $notifications = $user->findAll();
        $notifications = $notifications[0];
        print_r($notifications);
        $this->view('',['notifications'=>$notifications]);
    }
}
