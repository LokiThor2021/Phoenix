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
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MediaLanguage
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage query()
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MediaLanguage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MediaLanguage extends Model
{
    use Auditable;
}
