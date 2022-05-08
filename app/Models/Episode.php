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
 * App\Models\Episode
 *
 * @property int $id
 * @property string $name
 * @property string|null $overview
 * @property string|null $production_code
 * @property int $season_number
 * @property int $season_id
 * @property string|null $still
 * @property int $tv_id
 * @property string|null $type
 * @property string|null $vote_average
 * @property int|null $vote_count
 * @property string|null $air_date
 * @property int|null $episode_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cast[] $cast
 * @property-read int|null $cast_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Crew[] $crew
 * @property-read int|null $crew_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GuestStar[] $guest_star
 * @property-read int|null $guest_star_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $person
 * @property-read int|null $person_count
 * @property-read \App\Models\Season|null $season
 * @method static \Illuminate\Database\Eloquent\Builder|Episode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereAirDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereEpisodeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereProductionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSeasonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereSeasonNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereStill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereTvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereVoteAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Episode whereVoteCount($value)
 * @mixin \Eloquent
 */
class Episode extends Model
{
    protected $guarded = [];

    protected string $orderBy = 'order';

    protected string $orderDirection = 'ASC';

    public $table = 'episodes';

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Season::class)
            ->oldest('season_id')
            ->oldest('episode_id');
    }

    public function person(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class)
            ->oldest('order');
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class, 'crew_episode', 'person_id', 'episode_id');
    }

    public function guest_star(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(GuestStar::class, 'episode_guest_star', 'person_id', 'episode_id');
    }
}
