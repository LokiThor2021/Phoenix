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
 * App\Models\GuestStar
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
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar query()
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereAdult($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereAlsoKnownAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereDeathday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereImdbId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereKnownForDepartment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar wherePlaceOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar wherePopularity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereProfile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GuestStar whereStill($value)
 * @mixin \Eloquent
 */
class GuestStar extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public $table = 'person';

    public function episode(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Episode::class, 'episode_guest_star', 'episode_id', 'person_id');
    }
}
