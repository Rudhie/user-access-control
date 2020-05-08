<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RoleModel;
use CodeIgniter\API\ResponseTrait;

class RoleController extends Controller
{
	use ResponseTrait;

	public function index()
	{
		return render('role/index');
	}

	public function data(){
		$roleModel = new RoleModel();
		$data = array();
		try {
			$i = 1;
			$dataRole = $roleModel->orderBy('role_id', 'desc')->findAll();
			foreach ($dataRole as $role) {
				$row = array();
				$row['no'] = $i;
				$row['role_id'] = $role['role_id'];
				$row['role_name'] = $role['role_name'];
				$row['status'] = $role['status'];

				$data[] = $row;
				$i++;
			}

			$http_code = 200;
			$response = [
				'code' => $http_code,
				'title' => 'success',
				'message' => 'data role has been loaded',
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

	public function store()
	{
		$validation = \Config\Services::validation();

		$role_name = $this->request->getPost('role_name');
		$status = $this->request->getPost('status');

		$data = [
			'role_name' => $role_name,
			'status' => $status == 'on' ? 'Y' : 'N'
		];
		
		if($validation->run($data, 'role') == false){
			$http_code = 400;
			$http_status = 'error';
			$http_message = $validation->getErrors();
		} else {
			try {
				$roleModel = new RoleModel();
				$roleModel->insert($data);

				$http_code = 201;
				$http_status = 'success';
				$http_message = 'Add new role is successfuly';

			} catch(\Exception $e){
				$http_code = 500;
				$http_status = 'error';
				$http_message = $e->getMessage();
			}
		}

		return $this->setResponseFormat('json')->respond(
			[
				'code' => $http_code,
				'title' => $http_status,
				'message' => $http_message
			], $http_code);
	}

	public function update($role_id){
		$validation = \Config\Services::validation();

		$role_name = $this->request->getPost('role_name');
		$status = $this->request->getPost('status');

		$data = [
			'role_name' => $role_name,
			'status' => $status == 'on' ? 'Y' : 'N'
		];

		if($validation->run($data, 'role') == false){
			$http_code = 400;
			$http_status = 'error';
			$http_message = $validation->getErrors();
		} else {
			try {
				$roleModel = new RoleModel();
				$roleModel->update($role_id, $data);

				$http_code = 201;
				$http_status = 'success';
				$http_message = 'Update role is successfuly';

			} catch(\Exception $e){
				$http_code = 500;
				$http_status = 'error';
				$http_message = $e->getMessage();
			}
		}

		return $this->setResponseFormat('json')->respond(
			[
				'code' => $http_code,
				'title' => $http_status,
				'message' => $http_message
			], $http_code);
	}

	public function destroy($role_id){
		try {
			$roleModel = new RoleModel();
			$roleModel->delete($role_id);
			
			$http_code = 201;
			$http_status = 'success';
			$http_message = 'Delete role is successfuly';
		
		} catch(\Exception $e){
			$http_code = 500;
			$http_status = 'error';
			$http_message = $e->getMessage();
		}
		
		return $this->setResponseFormat('json')->respond(
			[
				'code' => $http_code,
				'title' => $http_status,
				'message' => $http_message
			], $http_code);
	}
}
