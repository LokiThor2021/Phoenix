<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D Community Edition is open-sourced software licensed under the GNU Affero General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D Community Edition
 *
 * @author     HDVinnie <hdinnovations@protonmail.com>
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 */

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TwoStepAuth
 *
 * @property int $id
 * @property int $userId
 * @property string|null $authCode
 * @property int $authCount
 * @property bool $authStatus
 * @property \Illuminate\Support\Carbon|null $authDate
 * @property \Illuminate\Support\Carbon|null $requestDate
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TwoStepAuthFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereAuthCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereAuthCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereAuthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereAuthStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereRequestDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoStepAuth whereUserId($value)
 * @mixin \Eloquent
 */
class TwoStepAuth extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'twostep_auth';

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Attributes That Are Not Mass Assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The Attributes That Should Be Mutated To Dates.
     *
     * @var array
     */

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'authCode',
        'authCount',
        'authStatus',
        'requestDate',
        'authDate',
    ];

    /**
     * The Attributes That Should Be Casted To Native Types.
     *
     * @var array
     */
    protected $casts = [
        'requestDate' => 'datetime',
        'authDate'    => 'datetime',
        'userId'      => 'integer',
        'authCode'    => 'string',
        'authCount'   => 'integer',
        'authStatus'  => 'boolean',    ];

    /**
     * Get a validator for an incoming Request.
     */
    public static function rules(array $merge = []): array
    {
        return \array_merge(
            [
                'userId'     => 'required|integer',
                'authCode'   => 'required|string|max:4|min:4',
                'authCount'  => 'required|integer',
                'authStatus' => 'required|boolean',
            ],
            $merge
        );
    }
}
