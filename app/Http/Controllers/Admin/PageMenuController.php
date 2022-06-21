<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\PageMenuModel; 
use App\Models\SectionMenuModel;
use Illuminate\Http\Request;

class PageMenuController extends AdminController
{
  protected $model = PageMenuModel::class;

  function index()
  {
    return view('admin.pages.listDefault');
  }

  // listagem dos usuarios e atributos do form
  function list() { 

    $list = $this->model::query()
    ->with(['sectionMenu'])
    ->withTrashed()
    ->get();   
    
    $baseUrl = '/admin/pageMenu';   
    
    $inputTailwind = 'h-10 pl-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md';

    return view('admin.pages.listDefault', [
      'config' => [
        'title' => 'Páginas do Menu',
        'baseUrl' => $baseUrl,
        'payloadComboBox' => [
          'sectionMenu' => SectionMenuModel::query()->orderBy('name')->get(['id', 'name']),
        ],
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            ['headerName' => 'ID', 'field' => 'id', 'flex' => '20'],
            ['headerName' => 'Nome', 'field' => 'name', 'flex' => '20'],
            ['headerName' => 'Seção', 'field' => 'section_menu.name', 'flex' => '20'],
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
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Seção:',
              'attrs' => [
                'name' => 'section_menu_id',
                'type' => 'select',
                'maxLength' => 255,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
              'populate' => [
                'target' => 'sectionMenu',
                'label' => 'name',
              ],
            ], 
            [
              'label' => 'Key:',
              'attrs' => [
                'name' => 'key',
                'type' => 'text',
                
                'max' => 32,
                'class' => $inputTailwind,
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
                'class' => $inputTailwind,
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
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],         
          ],
        ],
      ],
    ]);
  } 

  // funcao para salvar
  function save(Request $request) {
		$dataModel = (object) parent::save($request)->toArray();
		$dataModel->section_menu = SectionMenuModel::find($dataModel->section_menu_id);

		return $dataModel;
	}
}
