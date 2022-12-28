<?php

namespace Dcat\Admin\ApiTester\Actions\Tree;

use Dcat\Admin\Tree\RowAction;
use Dcat\Admin\Actions\Response;
use Dcat\Admin\Traits\HasPermissions;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Dcat\Admin\Widgets\Form as WidgetsForm;
use Dcat\Admin\ApiTester\Models\ApiTester;

class EditApiInfo extends RowAction
{
    /**
     * @return string
     */
	protected $title = 'Title';

    /**
     * Handle the action request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function handle(Request $request)
    {
    	//
    	$key = $this->getKey();
    	/*info('key:'.$key);
    	$infos = ApiTester::find($key)->toArray();
    	info($infos);
        $form = new WidgetsForm($infos);
        $form->setFormId('api-tester-add-form');*/
        return $this->response()->redirect('ycookies/api-tester?id='.$key);
    }

    /**
     * 重写title方法
     * @desc
     * @return string|void
     * author eRic
     * dateTime 2022-12-24 16:42
     */
    public function title() {
        $icon = 'icon-edit'; //$this->getRow()->show ? 'icon-eye-off' : 'icon-eye';

        return "&nbsp;<i class='feather $icon'></i>&nbsp;";
    }

    /**
     * @return string|void
     */
    protected function href()
    {
        // return admin_url('auth/users');
    }

    /**
	 * @return string|array|void
	 */
	public function confirm()
	{
		// return ['Confirm?', 'contents'];
	}

    /**
     * @param Model|Authenticatable|HasPermissions|null $user
     *
     * @return bool
     */
    protected function authorize($user): bool
    {
        return true;
    }
}
