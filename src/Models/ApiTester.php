<?php

namespace Dcat\Admin\ApiTester\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;

class ApiTester extends Model implements Sortable {
    use HasDateTimeFormatter,
        ModelTree {
        allNodes as treeAllNodes;
        ModelTree::boot as treeBoot;
    }

    protected $table = 'api_tester';
    protected $guarded = [];
    //protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];

    public static $methodColors = [
        'GET'    => 'primary',
        'POST'   => 'success',
        'PUT'    => 'blue',
        'DELETE' => 'danger',
    ];

    public static $methods = [
        'GET'    => 'GET',
        'POST'   => 'POST',
        'PUT'    => 'PUT',
        'DELETE' => 'DELETE',
    ];

    /*public function __construct(array $attributes = [])
    {
        $this->connection = config('database.connection') ?: config('database.default');

        parent::__construct($attributes);
    }*/

    /**
     * Log belongs to users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(config('admin.database.users_model'));
    }

    public static function addOrUpdate($where, $data) {
        ApiTester::updateOrCreate($where, $data);
    }

    public static function getParentInfo() {
        $list = ApiTester::where('parent_id', 0)->select('id', 'title')->get();
        if ($list) {
            $arr = [];
            foreach ($list as $items) {
                $arr[$items->id] = $items->title;
            }
            return $arr;
        }
        return [];
    }
}
