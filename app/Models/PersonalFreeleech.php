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

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PersonalFreeleech
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\PersonalFreeleechFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech query()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalFreeleech whereUserId($value)
 * @mixin \Eloquent
 */
class PersonalFreeleech extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'personal_freeleech';
}
