<?php
class LoginController extends \Phalcon\Mvc\Controller{
   public function indexAction(){
     
   }
   
   public function CAction(){
	 $user = new Users();
	 
	//查询所有
	$Result=$user->find();
	$num=count($Result);
	for($i=0;$i<$num;$i++){
		echo $Result[$i]->name,'&nbsp;&nbsp;&nbsp;',$Result[$i]->email,'<br/>';
	}
	echo 'users表记录数: ', count($num),'<br/>';
	 //print_r($user);
   }
}

