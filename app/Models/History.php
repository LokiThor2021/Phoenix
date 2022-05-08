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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\History
 *
 * @property int $id
 * @property int $user_id
 * @property int $torrent_id
 * @property string|null $agent
 * @property string $info_hash
 * @property int|null $uploaded
 * @property int|null $actual_uploaded
 * @property int|null $client_uploaded
 * @property int|null $downloaded
 * @property int|null $actual_downloaded
 * @property int|null $client_downloaded
 * @property int $seeder
 * @property int $active
 * @property int $seedtime
 * @property int $immune
 * @property int $hitrun
 * @property int $prewarn
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $completed_at
 * @property-read \App\Models\Torrent|null $torrent
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\HistoryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|History newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History query()
 * @method static \Illuminate\Database\Eloquent\Builder|History whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereActualDownloaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereActualUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereClientDownloaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereClientUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCompletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereDownloaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereHitrun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereImmune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereInfoHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History wherePrewarn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereSeeder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereSeedtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereTorrentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History whereUserId($value)
 * @mixin \Eloquent
 */
class History extends Model
{
    use HasFactory;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'history';

    /**
     * The Attributes That Are Mass Assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'info_hash',
    ];

    /**
     * The Attributes That Should Be Mutated To Dates.
     *
     * @var array
     */
    protected $casts = [
        'completed_at' => 'datetime',
    ];

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }
}
