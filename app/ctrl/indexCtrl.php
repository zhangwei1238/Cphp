<?php
namespace app\ctrl;
use app\model\catModel;
class indexCtrl extends \core\cphp{
	public function index(){
		$model = new catModel();
		$ret = $model->lists();
		$this->assign('data',$ret);
		$this->display('index.html');
	}

	public function add(){
		$id = get('id');
		$model = new catModel();
		$ret = $model->getOne($id);
		p($ret);
	}
}