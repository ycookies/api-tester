<?php

namespace Dcat\Admin\ApiTester\Http\Controllers;

use Dcat\Admin\Admin;
use Dcat\Admin\ApiTester\Actions\Tree\EditApiInfo;
use Dcat\Admin\ApiTester\Actions\Runapidoc;
use Dcat\Admin\ApiTester\Models\ApiTester;
use Dcat\Admin\Form;
use Dcat\Admin\Form\NestedForm;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Widgets\Form as WidgetsForm;
use Dcat\Admin\Widgets\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dcat\Admin\Widgets\Modal;

class ApiTesterController extends AdminController {

    /**
     * @desc index page
     * @param Content $content
     * @return Content
     * author eRic
     * dateTime 2022-12-31 17:35
     */
    public function index(Content $content) {

        // 行里面有多个列,列里面再嵌套行
        $content->row(function (Row $row) {
            $row->column(4, function (Column $column) {
                //$column->row(Runapidoc::make()->render());
            });
            $row->column(8, function (Column $column) {
                $column->append(function (){
                    return  <<<HTML
                <div class="btn-group pull-right" style="margin-bottom: 5px;">
                {$this->modal1()}
                <button type="button" class="btn btn-success eye-apidoc" data-projcode=""><i class="feather icon-eye"></i> 查看文档</button>
</div>
HTML;
                });
                //$column->row();
            });
        });
        //$content->row('<br>');
        $content->row(function (Row $row) {
            $row->column(4, function (Column $column) {
                $tab = new Tab();
                //$type = request('_t', 1);
                $tab->add('接口列表', $this->treeView()->render());
                //$tab->add('历史', '');

                $card = Card::make('项目接口列表', $tab);
                $column->row($card);
                $column->row('<br>');

                $column->row(Card::make('作者展示', Admin::view('ycookies.api-tester::author')));
            });
            $row->column(8, function (Column $column) {
                if (Request()->has('id')) {
                    $id    = Request()->get('id');
                    $infos = ApiTester::find($id);
                    if ($infos) {
                        $form = new WidgetsForm($infos->toArray());
                    } else {
                        $form = new WidgetsForm();
                    }
                } else {
                    $form = new WidgetsForm();
                }


                $form->setFormId('api-tester-add-form');
                $form->action(admin_url('ycookies/api-tester/handle')); // $menuModel::selectOptions()
                $form->row(function (Form\Row $form) {
                    $form->width(3)->select('parent_id', '分组')->options(ApiTester::getParentInfo());
                    $form->width(8)->text('title', '接口名称')->required();
                    $form->hidden('proj_id')->value(Request()->get('proj_id'));
                });
                $form->row(function (Form\Row $form) {
                    $form->width(3)->select('method', '请求方式')->options(ApiTester::$methods)->required();
                    $form->width(8)->url('uri', '接口地址')->required('uri');
                });
                $form->row(function (Form\Row $form) {
                    $form->textarea('descs', '接口描述')->value('暂无');
                    $form->table('api_param', '请求参数', function (NestedForm $table) {
                        $table->text('field_name', '字段名')->prepend('')->required();
                        $table->select('field_type', '数据类型')->options(['string','integer','number','boolean','file']);
                        $table->text('field_default', '默认值')->prepend('');
                        $table->text('field_desc', '字段描述')->prepend('');
                    });
                });
                $form->disableResetButton();
                $form->width(9, 2);
                // 接口信息表单
                $column->append(Card::make('接口信息', $form));

                /* 响应信息面板 */
                $column->append($this->respinfo());
            });

        });
        $content->row('<br>');

        $this->loadScript();
        // 引入静态资源
        Admin::requireAssets('@ycookies.api-tester');

        // 返回视图
        return $content
            ->title('接口文档')
            ->breadcrumb(['text' => '接口文档', 'url' => ''])
            ->description('可管理接口并做测试');
    }

    protected function loadScript(){
        $urls = url('/admin/ycookies/api-tester/proj/apidoc').'?docId=dsxiaopen';
        Admin::script(
            <<<JS
    $('.eye-apidoc').on('click',function(e) {
      window.location.href = '{$urls}'
    })
JS
        );
    }

    /**
     * @desc 展示文档
     * @param Request $request
     * author eRic
     * dateTime 2022-12-31 20:39
     */
    public function apidoc(Request $request){

        return view('ycookies.api-tester::apidoc.index');
    }

    /**
     * @desc 生成文档
     * @return Modal
     * author eRic
     * dateTime 2022-12-31 20:35
     */
    protected function modal1()
    {

        $form = new WidgetsForm();
        $form->action(admin_url('ycookies/api-tester/run'));
        return Modal::make()
            ->id('run-apidoc')
            ->title('生成文档')
            ->body($form)
            ->button('<button type="button" class="btn btn-info"><i class="feather icon-box"></i> 生成文档</button>');
    }

    /**
     * @desc 生成文档
     * author eRic
     * dateTime 2022-12-31 20:22
     */
    public function run(Request $request) {

        return JsonResponse::make()->success('成功！')->script(
            <<<JS
            $('#run-apidoc').modal('hide');
JS
        );
    }

    /**
     * @desc 响应信息面板
     * @return Card
     * author eRic
     * dateTime 2022-12-24 14:12
     */
    public function respinfo() {
        $tab = new Tab();
        $tab->add('响应内容', '<pre class="line-numbers language-json"><code class="language-json"></code></pre>', true, 'tab-1');
        $tab->add('响应头', '<pre class="line-numbers language-json"><code class="language-json"></code></pre>', false, 'tab-2');

        return Card::make('接口响应', $tab);
    }

    /**
     *  左则目录导航
     */
    protected function treeView() {

        return new Tree(ApiTester::class, function (Tree $tree) {
            $tree->query(function ($model) {
                $proj_id = Request()->get('proj_id');
                return $model->where('proj_id', $proj_id);
            });
            $tree->disableCreateButton();
            $tree->disableQuickCreateButton();
            $tree->disableEditButton();
            $tree->maxDepth(3);// 可以嵌套的层级 最多3级

            $tree->actions(function (Tree\Actions $actions) {
                //$actions->edit(false);
                $actions->prepend(new EditApiInfo());
                $actions->disableEdit();
                $actions->disableQuickEdit();
                //$actions->disableDelete();
            });

            $tree->branch(function ($branch) {
                $payload = "&nbsp;<strong>{$branch['title']}</strong>";

                if (!isset($branch['children'])) {
                    if (url()->isValidUrl($branch['uri'])) {
                        $uri = $branch['uri'];
                    } else {
                        $uri = admin_base_path($branch['uri']);
                    }
                    $uri     = Str::limit($uri, 10);
                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$uri\" class=\"dd-nodrag\">$uri</a>";
                }

                return $payload;
            });
        });
    }


    /**
     * 接口信息提交处理
     * @desc
     * @param Request $request
     * @return JsonResponse
     * author eRic
     * dateTime 2022-12-24 14:15
     */
    public function handle(Request $request) {
        $request->validate([
            'proj_id' => 'required|integer',
            'title'   => 'required',
            'uri'     => 'required',
            'method'  => 'required',
            //'descs'  => 'required',
        ], [
            'proj_id.required'   => '项目ID 不能为空',
            'parent_id.required' => '父级 不能为空',
            'title.required'     => '接口名称 不能为空',
            'uri.required'       => '接口地址 不能为空',
            'method.required'    => '请求方法 不能为空',
            'descs'              => '接口描述 不能为空',
        ]);
        if (!empty($request->api_param)) {
            $request->validate([
                'api_param.*.field_name' => 'required',
                'api_param.*.field_type' => 'required',
            ], [
                'api_param.*.field_name.required' => '字段名 不能为空',
                'api_param.*.field_type.required' => '数据类型 不能为空',
            ]);
        }


        $all = $request->all();
        // 去除掉删除的
        $api_param = [];
        if (!empty($all['api_param'])) {
            foreach ($all['api_param'] as $key => $items) {
                if (!empty($items['_remove_']) && $items['_remove_'] == 1) {
                } else {
                    $api_param[$key] = $items;
                }
            }
        }

        $insdata = [
            'proj_id'   => $all['proj_id'],
            'title'     => $all['title'],
            'uri'       => $all['uri'],
            'method'    => $all['method'],
            'descs'     => !empty($all['descs']) ? $all['descs'] : '',
            'parent_id' => !empty($all['parent_id']) ? $all['parent_id'] : 0,
            'api_param' => !empty($api_param) ? json_encode($api_param, JSON_UNESCAPED_UNICODE) : '',
        ];

        ApiTester::addOrUpdate(['proj_id' => $all['proj_id'], 'uri' => $request->uri, 'method' => $all['method']], $insdata);
        $method     = $all['method'];
        $coll       = new  ApiTesterHandle();
        $uri        = $all['uri'];
        $user       = '';
        $parameters = !empty($api_param) ? $api_param : [];

        $response   = $coll->call($method, $uri, $parameters, $user);
        $resdata    = json_encode($response->original, JSON_UNESCAPED_UNICODE);
        $resheaders = json_encode($response->headers, JSON_UNESCAPED_UNICODE);

        return JsonResponse::make()->success('成功！')->script(
            <<<JS
            $('#tab_tab-1 pre code').html('');
            $('#tab_tab-2 pre code').html('');
            $('#tab_tab-1 pre code').html('$resdata');
            $('#tab_tab-2 pre code').html('$resheaders');
            Prism.highlightAll();
JS
        );

    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id) {
        return Show::make($id, new ApiTester(), function (Show $show) {
            $show->field('id');
            $show->field('parent_id');
            $show->field('order');
            $show->field('title');
            $show->field('uri');
            $show->field('method');
            $show->field('type');
            $show->field('descs');
            $show->field('head_param');
            $show->field('api_param');
            $show->field('resp_param');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form() {
        return Form::make(new ApiTester(), function (Form $form) {
            $form->display('id');
            $form->text('parent_id');
            $form->text('order');
            $form->text('title');
            $form->text('uri');
            $form->text('method');
            $form->text('type');
            $form->text('descs');
            $form->text('head_param');
            $form->text('api_param');
            $form->text('resp_param');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}