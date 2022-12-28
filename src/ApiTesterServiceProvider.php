<?php

namespace Dcat\Admin\ApiTester;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class ApiTesterServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
        'js/prism.js',
    ];
	protected $css = [
		'css/index.css',
        'css/prism.css',
	];

    // 定义菜单
    protected $menu = [
        [
            'title' => '接口文档',
            'uri'   => 'ycookies/api-tester',
            'icon'  => 'feather icon-award',
        ]
    ];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//
		
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
