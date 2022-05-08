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
 * App\Models\Company
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $headquarters
 * @property string|null $homepage
 * @property string|null $logo
 * @property string|null $origin_country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movie[] $movie
 * @property-read int|null $movie_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tv[] $tv
 * @property-read int|null $tv_count
 * @method static \Illuminate\Database\Eloquent\Builder|Company newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Company query()
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereHeadquarters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Company whereOriginCountry($value)
 * @mixin \Eloquent
 */
class Company extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'companies';

    public function movie(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }

    public function tv(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tv::class);
    }
}
