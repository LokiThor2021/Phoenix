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
 * App\Models\Person
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
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAlsoKnownAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereDeathday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereKnownForDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereStill($value)
 * @mixin \Eloquent
 */
class Person extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'person';

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class, 'person_tv', 'tv_id', 'person_id');
    }

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'person_season', 'season_id', 'person_id');
    }

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_person', 'episode_id', 'person_id');
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'person_movie', 'movie_id', 'person_id');
    }
}
