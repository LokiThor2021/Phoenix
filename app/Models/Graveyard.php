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
 * App\Models\Graveyard
 *
 * @property int $id
 * @property int $user_id
 * @property int $torrent_id
 * @property int $seedtime
 * @property int $rewarded
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Torrent|null $torrent
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\GraveyardFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard query()
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereRewarded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereSeedtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereTorrentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Graveyard whereUserId($value)
 * @mixin \Eloquent
 */
class Graveyard extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'graveyard';

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }
}
