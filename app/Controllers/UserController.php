<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends Controller
{
	use ResponseTrait;

	public function index()
	{
		return view('user/index');
    }

    public function data(){
		$userModel = new UserModel();
		$data = array();
		try {
			$i = 1;
			$dataRole = $userModel->orderBy('user_id', 'desc')->findAll();
			foreach ($dataRole as $role) {
				$row = array();
				$row['no'] = $i;
				$row['user_id'] = $role['user_id'];
				$row['fullname'] = $role['fullname'];
				$row['username'] = $role['username'];
				$row['email'] = $role['email'];
				$row['phone'] = $role['phone'];
				$row['profile_picture'] = $role['profile_picture'];
				$row['role_id'] = $role['role_id'];

				$data[] = $row;
				$i++;
			}

			$http_code = 200;
			$response = [
				'code' => $http_code,
				'title' => 'success',
				'message' => 'data user has been loaded',
				'data' => $data
			];

		} catch(\Exception $e){
			$http_code = 500;
			$response = [
				'code' => $http_code,
				'title' => 'error',
				'message' => $e->getMessage(),
				'data' => $data
			];
		}

		return $this->setResponseFormat('json')->respond($response, $http_code);
	}
}

