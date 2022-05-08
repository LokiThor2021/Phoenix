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
 * App\Models\Network
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $logo
 * @property string|null $homepage
 * @property string|null $headquarters
 * @property string|null $origin_country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movie
 * @property-read int|null $movie_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tv[] $tv
 * @property-read int|null $tv_count
 * @method static \Illuminate\Database\Eloquent\Builder|Network newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Network newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Network query()
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereHeadquarters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Network whereOriginCountry($value)
 * @mixin \Eloquent
 */
class Network extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'networks';

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class);
    }

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
