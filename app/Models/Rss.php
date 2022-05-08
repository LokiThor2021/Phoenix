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
 * App\Models\Rss
 *
 * @property int $id
 * @property int $position
 * @property string $name
 * @property int $user_id
 * @property int $staff_id
 * @property int $is_private
 * @property int $is_torrent
 * @property array $json_torrent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $expected_fields
 * @property-read \stdClass|bool $object_torrent
 * @property-read \App\Models\User $staff
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\RssFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Rss newQuery()
 * @method static \Illuminate\Database\Query\Builder|Rss onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Rss query()
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereIsPrivate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereIsTorrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereJsonTorrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Rss whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Rss withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Rss withoutTrashed()
 * @mixin \Eloquent
 */
class Rss extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'rss';

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Attributes That Should Be Cast To Native Types.
     *
     * @var array
     */
    protected $casts = [
        'name'            => 'string',
        'json_torrent'    => 'array',
        'expected_fields' => 'array',
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
     * Belongs To A Staff Member.
     */
    public function staff(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Not needed yet. Just added for future extendability.
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Get the RSS feeds JSON Torrent as object.
     */
    public function getObjectTorrentAttribute(): \stdClass|bool
    {
        // Went with attribute to avoid () calls in views. Uniform ->object_torrent vs ->json_torrent.
        if ($this->json_torrent) {
            $expected = $this->expected_fields;

            return (object) \array_merge($expected, $this->json_torrent);
        }

        return false;
    }

    /**
     * Get the RSS feeds expected fields for form validation.
     */
    public function getExpectedFieldsAttribute(): array
    {
        // Just Torrents for now... extendable to check on feed type in future.
        return ['search'             => null, 'description' => null, 'uploader' => null, 'imdb' => null,
            'mal'                    => null, 'categories' => null, 'types' => null, 'resolutions' => null, 'genres' => null,
            'freeleech'              => null, 'doubleupload' => null, 'featured' => null, 'stream' => null, 'highspeed' => null,
            'sd'                     => null, 'internal' => null, 'bookmark' => null, 'alive' => null, 'dying' => null, 'dead' => null, ];
    }
}
