<?php

namespace Dcat\Admin\ApiTester\Http\Controllers;

use Dcat\Admin\ApiTester\Repositories\CgkjProj;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\ApiTester\Actions\SwitchGridView;
use Illuminate\Http\Request;
use Dcat\Admin\Http\JsonResponse;

class CgkjProjController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->title('项目管理')
            ->description('')
            ->breadcrumb(['text' => '项目管理', 'url' => ''])
            ->body($this->grid());
    }

    /**
     * @desc
     * author eRic
     * dateTime 2022-12-31 10:40
     */
    public function grid(){
        return Grid::make(new CgkjProj(), function (Grid $grid) {
            if (request()->get('_view_') !== 'list') {
                // 设置自定义视图
                $grid->view('ycookies.api-tester::subview.projbox');
                $grid->actions(function ($actions){
                    $actions->disableDelete();
                });
                //$grid->setActionClass(Grid\Displayers\Actions::class);
            }

            $grid->tools([
                //$this->buildPreviewButton('btn-primary'),
                //new SwitchGridView(),
            ]);

            //$grid->disableCreateButton();

            $grid->column('user_id');
            $grid->column('code');
            $grid->column('name');
            $grid->column('description');
            $grid->column('status');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid_old()
    {
        return Grid::make(new CgkjProj(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('user_id');
            $grid->column('code');
            $grid->column('name');
            $grid->column('description');
            $grid->column('status');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new CgkjProj(), function (Show $show) {
            $show->field('id');
            $show->field('user_id');
            $show->field('code');
            $show->field('name');
            $show->field('description');
            $show->field('status');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Form::make(new CgkjProj(), function (Form $form) {
            $form->display('id');
            $form->image('logo')->default(asset('vendor/dcat-admin-extensions/ycookies/api-tester/img/proj_logo.jpg'));
            $form->text('user_id');
            $form->text('code');
            $form->text('name');
            $form->text('description');
            $form->switch('status');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    // 获取接口文档
    public function jsonBuild(Request $request){
        $docId = $request->get('docId');
        if(empty($docId)){
            return JsonResponse::make()->error('文档ID不能为空')->refresh();
        }
        ///Users/yangg/Downloads/www/dcat/public/vendor/dcat-admin-extensions/ycookies/api-tester/json/CaseOpen.json
        $jsonfile = public_path('vendor/dcat-admin-extensions/ycookies/api-tester/json/'.$docId.'.json');
        if(!file_exists($jsonfile)){
            return JsonResponse::make()->error('未找到文档')->refresh();
        }
        $json_content = file_get_contents($jsonfile);
        if(empty($json_content)){
            return JsonResponse::make()->error('文档内容异常')->refresh();
        }
        header('Content-Type: application/json');
        echo $json_content;
        exit;
    }
}
