<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\PermissionModel;
use App\Models\UserProfileModel;
use Illuminate\Http\Request;

use function GuzzleHttp\json_encode;

class PermissionController extends AdminController {  
  protected $model = PermissionModel::class;

  function list() {  
    $list = UserProfileModel::query()->orderBy('name')->get();
    $baseUrl = '/admin/permission';  

    return view('admin.pages.listDefault', [ 
      'config' => [
        'title' => 'Permissoẽs',
        'baseUrl' => $baseUrl, 
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            [
              'headerName' => 'ID',
              'field' => 'id',
              'flex' => '20'
            ], 
            [
              'headerName' => 'Perfil',
              'field' => 'name',
              'flex' => '20'
            ], 
            [
              'headerName' => 'Nível',
              'field' => 'level',
              'flex' => '20'
            ],
            [
              'headerName' => 'Ações',
              'maxWidth' => 160,
              'renderDoT' => '
                <div class="flex items-center justify-center h-10"> 
                  <button class="flex items-center justify-center w-6 h-6 rounded mx-1 bg-green-400 text-white hover:bg-gray-400" type="button" onclick="actionModalPermission({{=it.rowIndex}})"><i class="fa-solid fa-pencil"></i></button>
                </div>
              ',
            ],
          ],
        ], 
      ],
    ]);
  } 

  function save(Request $request) {
    $payload = $request->all();

    foreach ($payload['permission'] as &$permision) {
      $permision['id'] = null;
      $permision['user_profile_id'] = $payload['user_profile_id'];

      $permisionModel = new PermissionModel();
      $permisionModel->fill($permision)->save();

      $permision = $permisionModel;
    }
    
    return json_encode($payload);
  }

  function getPermissionByProfile($id) {  
    $list = $this->model::query()->where('user_profile_id', $id)->get();

    return $list;
  }
}
