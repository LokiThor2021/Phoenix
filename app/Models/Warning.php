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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Warning
 *
 * @property int $id
 * @property int $user_id
 * @property int $warned_by
 * @property int|null $torrent
 * @property string $reason
 * @property string|null $expires_on
 * @property int $active
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $deletedBy
 * @property-read \App\Models\User $staffuser
 * @property-read \App\Models\Torrent|null $torrenttitle
 * @property-read \App\Models\User $warneduser
 * @method static \Database\Factories\WarningFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warning newQuery()
 * @method static \Illuminate\Database\Query\Builder|Warning onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Warning query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereExpiresOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereTorrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warning whereWarnedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Warning withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Warning withoutTrashed()
 * @mixin \Eloquent
 */
class Warning extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;

    /**
     * Belongs To A Torrent.
     */
    public function torrenttitle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class, 'torrent');
    }

    /**
     * Belongs To A User.
     */
    public function warneduser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A USer.
     */
    public function staffuser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'warned_by')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A USer.
     */
    public function deletedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
