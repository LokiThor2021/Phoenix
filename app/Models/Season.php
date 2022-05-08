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

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Season
 *
 * @property int $id
 * @property int $tv_id
 * @property int $season_number
 * @property string|null $name
 * @property string|null $overview
 * @property string|null $poster
 * @property string|null $air_date
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cast[] $cast
 * @property-read int|null $cast_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Crew[] $crew
 * @property-read int|null $crew_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Episode[] $episodes
 * @property-read int|null $episodes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $person
 * @property-read int|null $person_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Torrent[] $torrents
 * @property-read int|null $torrents_count
 * @property-read \App\Models\Tv $tv
 * @method static \Illuminate\Database\Eloquent\Builder|Season newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Season newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Season query()
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereAirDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereSeasonNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereTvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Season whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Season extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'seasons';

    /**
     * Has Many Torrents.
     */
    public function torrents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Torrent::class, 'tmdb', 'tv_id')->whereHas('category', function ($q) {
            $q->where('tv_meta', '=', true);
        });
    }

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tv::class);
    }

    public function episodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Episode::class)
            ->oldest('episode_number');
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class);
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class);
    }
}
