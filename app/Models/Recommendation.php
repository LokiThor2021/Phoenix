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
 * App\Models\Recommendation
 *
 * @property int $id
 * @property string $title
 * @property string|null $poster
 * @property string|null $vote_average
 * @property string|null $release_date
 * @property string|null $first_air_date
 * @property int|null $movie_id
 * @property int|null $recommendation_movie_id
 * @property int|null $tv_id
 * @property int|null $recommendation_tv_id
 * @property-read \App\Models\Movie|null $movie
 * @property-read \App\Models\Tv|null $tv
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereFirstAirDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation wherePoster($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendationMovieId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereRecommendationTvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereReleaseDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereTvId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recommendation whereVoteAverage($value)
 * @mixin \Eloquent
 */
class Recommendation extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tv::class);
    }
}
