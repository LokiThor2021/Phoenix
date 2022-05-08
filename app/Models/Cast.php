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
 * App\Models\Cast
 *
 * @property int $id
 * @property string $name
 * @property string|null $character
 * @property string|null $credit_id
 * @property string|null $gender
 * @property string|null $order
 * @property string|null $still
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Episode[] $episode
 * @property-read int|null $episode_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movie
 * @property-read int|null $movie_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Season[] $season
 * @property-read int|null $season_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tv[] $tv
 * @property-read int|null $tv_count
 * @method static \Illuminate\Database\Eloquent\Builder|Cast newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cast newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cast query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereCharacter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereCreditId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cast whereStill($value)
 * @mixin \Eloquent
 */
class Cast extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'cast';

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class, 'cast_tv', 'tv_id', 'cast_id');
    }

    public function season(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Season::class, 'cast_season', 'season_id', 'cast_id');
    }

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'cast_episode', 'episode_id', 'cast_id');
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'cast_movie', 'movie_id', 'cast_id');
    }
}
