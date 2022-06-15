<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\PermissionModel; 

class PermissionController extends AdminController
{
  protected $model = PermissionModel::class;

  function index()
  {
    return view('admin.pages.listDefault');
  }

  // listagem dos usuarios e atributos do form
  function list()
  {     
    $list = $this->model::orderBy('name')->withTrashed()->get(); 
    $baseUrl = '/admin/permisson'; 

    // $inputTailwind = 'h-10 pl-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md';

    return view('admin.pages.listDefault', [
      'config' => [
        'title' => 'Permissoẽs de acesso',
        'baseUrl' => $baseUrl,
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            ['headerName' => 'ID', 'field' => 'id', 'flex' => '20'],
            ['headerName' => 'Nome', 'field' => 'name', 'flex' => '20'],
            ['headerName' => 'Key', 'field' => 'key', 'flex' => '20'],
            ['headerName' => 'Icon', 'field' => 'icon', 'flex' => '20'],
            ['headerName' => 'Sequência', 'field' => 'sequence', 'flex' => '20'], 
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
            [
              'label' => 'Nome:',
              'attrs' => [
                'name' => 'name',
                'type' => 'text',
                'min' => 1,
                'maxLength' => 32,
                // 'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Key:',
              'attrs' => [
                'name' => 'key',
                'type' => 'text',
                
                'max' => 32,
                // 'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Icon:',
              'attrs' => [
                'name' => 'icon',
                'type' => 'text',
                'min' => 1,
                'max' => 32,
                // 'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Sequência:',
              'attrs' => [
                'name' => 'sequence',
                'type' => 'number',
                'min' => 1,
                'max' => 32,
                // 'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ], 
          ],
        ],
      ],
    ]);
  } 
}
