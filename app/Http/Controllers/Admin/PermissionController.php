<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\PermissionModel;
use App\Models\UserProfileModel;
use Illuminate\Http\Request;

class PermissionController extends AdminController
{
  protected $model = PermissionModel::class;

  function index()
  {
    return view('admin.pages.listDefault');
  }

  function list()
  {  
    $baseUrl = '/admin/permisson'; 
    
    $list = $this->model::query()
      ->with(['userProfile'])
      ->orderBy('name')
      ->withTrashed()
      ->get();

      // dd($list);

    // $inputTailwind = 'h-10 pl-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md'; 

    return view('admin.pages.listDefault', [
      'data' => $list,
      'config' => [
        'title' => 'Permissoẽs de acesso',
        'baseUrl' => $baseUrl,
        // 'payloadComboBox' => [
        //   'userProfile' => UserProfileModel::query()->orderBy('name')->get(['id', 'name']),
        // ],
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            ['headerName' => 'ID', 'field' => 'id', 'flex' => '20'],
            ['headerName' => 'Perfil', 'field' => 'user_profile.name', 'flex' => '20'], 
            $this->getBtnActionTmpl(),
          ],
        ],
        'form' => [
          'attrs' => [
            'name' => 'formUserProfile',
            'action' => "{$baseUrl}/save",
            'method' => 'POST',
          ],
          'fields' => [
            [
              'attrs' => [
                'name' => 'id',
                'type' => 'hidden'
              ],
            ],
            // [
            //   'label' => 'Perfil',
            //   'attrs' => [
            //     'name' => 'user_profile_id',
            //     'type' => 'select',
            //     'maxLength' => 255,
            //     'class' => $inputTailwind,
            //     'autocomplete' => 'none',
            //   ],
            //   'populate' => [
            //     'target' => 'userProfile',
            //     'label' => 'name',
            //   ],
            // ], 
          ],
        ],
      ],
    ]);
  }
  
  // funcao para salvar
  function save(Request $request) {
		$dataModel = (object) parent::save($request)->toArray();
		$dataModel->permission = PermissionModel::find($dataModel->permission_id);

		return $dataModel;
	}
}
