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
 * App\Models\Crew
 *
 * @property int $id
 * @property string $name
 * @property string|null $imdb_id
 * @property string|null $known_for_department
 * @property string|null $place_of_birth
 * @property string|null $popularity
 * @property string|null $profile
 * @property string|null $still
 * @property string|null $adult
 * @property string|null $also_known_as
 * @property string|null $biography
 * @property string|null $birthday
 * @property string|null $deathday
 * @property string|null $gender
 * @property string|null $homepage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Episode[] $episode
 * @property-read int|null $episode_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movie
 * @property-read int|null $movie_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $season
 * @property-read int|null $season_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tv[] $tv
 * @property-read int|null $tv_count
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew query()
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereAlsoKnownAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereDeathday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereKnownForDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Crew whereStill($value)
 * @mixin \Eloquent
 */
class Crew extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'person';

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class, 'crew_tv', 'tv_id', 'person_id');
    }

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'crew_season', 'season_id', 'person_id');
    }

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'crew_episode', 'episode_id', 'person_id');
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'crew_movie', 'movie_id', 'person_id');
    }
}
