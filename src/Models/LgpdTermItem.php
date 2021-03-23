<?php

namespace Thiagoprz\Lgpd\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CrudTools\Models\ModelCrud;



/**
 * Class LgpdTermItem
 * @package App\Models
 * @property int $id
 * @property string $term
 * @property int $lgpd_term_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LgpdTermItem extends Model
{
    use ModelCrud;



    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lgpd_term_items';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['term', 'lgpd_term_id'];

    /**
     * Attributes that are available to the search() method.
     *
     * @see ModelCrud::search()
     * @var array
     */
    static $searchable = [
		'term' => 'string',
		'lgpd_term_id' => 'string',
	];

    /**
     * Default search order
     */
    static $search_order = ['id' => 'ASC'];

    /**
     * Model validations
     */
    static $validations = [
        'create' => [
            'term' => 'required|string|min:3|max:400',
        ],
        'update' => [
            'term' => 'required|string|min:3|max:400',
        ],
    ];

    /**
     * Forbade access to return a non paginated result through search method using "no_pagination" param on request?
     */
    static $noPaginationForbidden = false;

    /**
     * Number of records to display per page
     */
    static $paginationForSearch = 10;
}
