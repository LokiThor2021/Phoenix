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
 * App\Models\UserActivation
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserActivationFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserActivation whereUserId($value)
 * @mixin \Eloquent
 */
class UserActivation extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
