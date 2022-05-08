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
 * App\Models\Tv
 *
 * @property int $id
 * @property string|null $tmdb_id
 * @property string|null $imdb_id
 * @property string|null $tvdb_id
 * @property string|null $type
 * @property string $name
 * @property string $name_sort
 * @property string|null $overview
 * @property int|null $number_of_episodes
 * @property int|null $count_existing_episodes
 * @property int|null $count_total_episodes
 * @property int|null $number_of_seasons
 * @property string|null $episode_run_time
 * @property string|null $first_air_date
 * @property string|null $status
 * @property string|null $homepage
 * @property int|null $in_production
 * @property string|null $last_air_date
 * @property string|null $next_episode_to_air
 * @property string|null $origin_country
 * @property string|null $original_language
 * @property string|null $original_name
 * @property string|null $popularity
 * @property string|null $backdrop
 * @property string|null $poster
 * @property string|null $vote_average
 * @property int|null $vote_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cast[] $cast
 * @property-read int|null $cast_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $creators
 * @property-read int|null $creators_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Crew[] $crew
 * @property-read int|null $crew_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Network[] $networks
 * @property-read int|null $networks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Person[] $persons
 * @property-read int|null $persons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $seasons
 * @property-read int|null $seasons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Torrent[] $torrents
 * @property-read int|null $torrents_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tv newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tv newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tv query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereBackdrop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereCountExistingEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereCountTotalEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereEpisodeRunTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereFirstAirDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereInProduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereLastAirDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereNameSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereNextEpisodeToAir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereNumberOfEpisodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereNumberOfSeasons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereOriginCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereOriginalLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereOriginalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereTmdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereTvdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereVoteAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tv whereVoteCount($value)
 * @mixin \Eloquent
 */
class Tv extends Model
{
    protected $guarded = [];

    public $table = 'tv';

    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Has Many Torrents.
     */
    public function torrents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Torrent::class, 'tmdb', 'id')->whereHas('category', function ($q) {
            $q->where('tv_meta', '=', true);
        });
    }

    public function seasons(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Season::class)
            ->oldest('season_number');
    }

    public function persons(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class, 'cast_tv', 'cast_id', 'tv_id');
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class, 'crew_tv', 'person_id', 'tv_id');
    }

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function creators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Person::class);
    }

    public function networks(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Network::class);
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function recommendations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Recommendation::class, 'tv_id', 'id');
    }
}
