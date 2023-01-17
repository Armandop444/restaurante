<?php
class DashboardController extends Controller {
    public function __construct($param){
        #mandar a llamar la vista y parametro
        parent::__construct("dashboard",$param,true);
    }
}

?>