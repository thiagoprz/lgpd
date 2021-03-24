<?php

namespace Thiagoprz\Lgpd\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CrudTools\Models\ModelCrud;



/**
 * Class LgpdTerm
 * @package App\Models
 * @property int $id
 * @property string $version
 * @property string $term
 * @property string $publishing_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property LgpdTermItem[] $lgpdTermItems
 */
class LgpdTerm extends Model
{
    use ModelCrud;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lgpd_terms';

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
    protected $fillable = ['version', 'term', 'publishing_date'];

    /**
     * Attributes that are available to the search() method.
     *
     * @see ModelCrud::search()
     * @var array
     */
    static $searchable = [
		'version' => 'string',
		'term' => 'string',
		'publishing_date' => 'datetime',
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

    /**
     * Default search order
     */
    static $search_order = ['publishing_date' => 'DESC'];

    /**
     * Model validations
     */
    static $validations = [
        'create' => [
            'term' => 'required|string|min:50',
        ],
        'update' => [
            'term' => 'required|string|min:50',
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
     * @var string[]
     */
    public $search_with = [
        'lgpdTermItems',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publishing_date' => 'datetime',
    ];

    /**
     * Boot
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function(LgpdTerm $lgpdTerm) {
            if (!$lgpdTerm->publishing_date) { // If not set will be turned into a immediatly mandatory acceptance term
                $lgpdTerm->publishing_date = date('Y-m-d H:i:s');
            }
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lgpdTermItems()
    {
        return $this->hasMany(LgpdTermItem::class);
    }

    /**
     * @return LgpdTerm|null
     */
    public static function activeTerm(): ?LgpdTerm
    {
        return self::with('lgpdTermItems')->where('publishing_date', '<=', Carbon::now())->orderBy('publishing_date', 'DESC')->first();
    }
}
