<?php
class IndexController extends \Phalcon\Mvc\Controller{
   public function indexAction(){
	   $this->view->setVar('HwIt', '我');
   }
   
}

