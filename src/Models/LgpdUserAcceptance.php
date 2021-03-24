<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CrudTools\Models\ModelCrud;



/**
 * Class LgpdUserAcceptance
 * @package App\Models
 * @property int $id
 * @property int $lgpd_term_id
 * @property int $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class LgpdUserAcceptance extends Model
{
    use ModelCrud;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lgpd_user_acceptance';

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
    protected $fillable = ['lgpd_term_id', 'user_id'];

    /**
     * Attributes that are available to the search() method.
     *
     * @see ModelCrud::search()
     * @var array
     */
    static $searchable = [
		'lgpd_term_id' => 'int',
		'user_id' => 'int',
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
            'lgpd_term_id' => 'required',
            'user_id' => 'required',
        ],
        'update' => [
            'lgpd_term_id' => 'required',
            'user_id' => 'required',
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

    /**
     * Check if a user has accepted a term
     * @param int $user_id
     * @param int $term_id
     * @return LgpdUserAcceptance|null
     */
    public static function userAccepted(int $user_id,int $term_id): ?LgpdUserAcceptance
    {
        return self::where('user_id', $user_id)
            ->where('lgpd_term_id', $term_id)
            ->first();
    }
}
