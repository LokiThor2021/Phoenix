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
 * App\Models\Movie
 *
 * @property int $id
 * @property string|null $tmdb_id
 * @property string|null $imdb_id
 * @property string $title
 * @property string $title_sort
 * @property string|null $original_language
 * @property int|null $adult
 * @property string|null $backdrop
 * @property string|null $budget
 * @property string|null $homepage
 * @property string|null $original_title
 * @property string|null $overview
 * @property string|null $popularity
 * @property string|null $poster
 * @property string|null $release_date
 * @property string|null $revenue
 * @property string|null $runtime
 * @property string|null $status
 * @property string|null $tagline
 * @property string|null $vote_average
 * @property int|null $vote_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Cast[] $cast
 * @property-read int|null $cast_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Collection[] $collection
 * @property-read int|null $collection_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $countries
 * @property-read int|null $countries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Crew[] $crew
 * @property-read int|null $crew_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Genre[] $genres
 * @property-read int|null $genres_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Recommendation[] $recommendations
 * @property-read int|null $recommendations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Torrent[] $torrents
 * @property-read int|null $torrents_count
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereBackdrop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOriginalLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOriginalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereOverview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereRevenue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereRuntime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitleSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTmdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereVoteAverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereVoteCount($value)
 * @mixin \Eloquent
 */
class Movie extends Model
{
    protected $guarded = [];

    public $table = 'movie';

    public function genres(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function cast(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cast::class, 'cast_movie', 'cast_id', 'movie_id');
    }

    public function crew(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Crew::class, 'crew_movie', 'person_id', 'movie_id');
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function countries(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function collection(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Collection::class)->take(1);
    }

    public function recommendations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Recommendation::class, 'movie_id', 'id');
    }

    public function torrents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Torrent::class, 'tmdb', 'id')->whereHas('category', function ($q) {
            $q->where('movie_meta', '=', true);
        });
    }
}
