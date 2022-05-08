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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Peer
 *
 * @property int $id
 * @property string|null $peer_id
 * @property string|null $md5_peer_id
 * @property string|null $info_hash
 * @property string|null $ip
 * @property int|null $port
 * @property string|null $agent
 * @property int|null $uploaded
 * @property int|null $downloaded
 * @property int|null $left
 * @property int|null $seeder
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $torrent_id
 * @property int|null $user_id
 * @property int $connectable
 * @property-read \App\Models\Torrent|null $seed
 * @property-read \App\Models\Torrent|null $torrent
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\PeerFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Peer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereConnectable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereDownloaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereInfoHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereMd5PeerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer wherePeerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereSeeder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereTorrentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereUploaded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Peer whereUserId($value)
 * @mixin \Eloquent
 */
class Peer extends Model
{
    use HasFactory;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A Torrent.
     */
    public function torrent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class);
    }

    /**
     * Belongs To A Seed.
     */
    public function seed(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Torrent::class, 'torrents.id', 'torrent_id');
    }

    /**
     * Updates Connectable State If Needed.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Exception
     *
     * @var resource
     */
    public function updateConnectableStateIfNeeded(): void
    {
        if (\config('announce.connectable_check') == true) {
            $tmp_ip = $this->ip;

            // IPv6 Check
            if (filter_var($tmp_ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                $tmp_ip = '['.$tmp_ip.']';
            }

            if (! \cache()->has('peers:connectable:'.$tmp_ip.'-'.$this->port.'-'.$this->agent)) {
                $con = @fsockopen($tmp_ip, $this->port, $_, $_, 1);

                $this->connectable = \is_resource($con);
                \cache()->put('peers:connectable:'.$tmp_ip.'-'.$this->port.'-'.$this->agent, $this->connectable, now()->addSeconds(config('announce.connectable_check_interval')));

                if (\is_resource($con)) {
                    \fclose($con);
                }
            }
        }
    }
}
