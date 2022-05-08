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
 * App\Models\FreeleechToken
 *
 * @property int $id
 * @property int $user_id
 * @property int $torrent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Torrent|null $torrent
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\FreeleechTokenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken whereTorrentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeleechToken whereUserId($value)
 * @mixin \Eloquent
 */
class FreeleechToken extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
