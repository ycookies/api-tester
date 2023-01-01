<?php

namespace Dcat\Admin\ApiTester\Actions;
use Dcat\Admin\Actions\Action;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Http\Request;
//use App\Portal\Forms\CacheClearFrom;

class Runapidoc extends Action
{
    /**
     * @return string
     */
	protected $title = '<button type="button" class="btn btn-success ">生成文档</button>';

    public function render()
    {
        $modal = Modal::make()
            ->id('admin-setting-config') // 导航栏显示弹窗，必须固定ID，随机ID会在刷新后失败
            ->title('生成接口文档')
            ->body('1232')
            ->button(
                <<<HTML
                <div class="btn-group pull-right">
  {$this->title()}
</div>
HTML
            );

        return $modal->render();

    }
    public function handle(Request $request)
    {
        return $this->response()->success('成功！');
    }

    public function confirm()
    {
        return '你确定要清除缓存吗？';
    }
}
