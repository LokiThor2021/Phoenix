<div class="bg-neutral-600 py-1 border-b border-neutral-600 text-sm ">
    <div class="max-w-7xl app-container mx-auto">
        <ul class="text-left">
            <li class="inline-block mr-3">
                <a href="{{ \route('users.show', ['username' => $user->username]) }}">
                    <span style="color:{{ $user->group->color }};">
                        <strong>{{ $user->username }}</strong>
                        @if ($user->getWarning() > 0)
                            <i class="{{ \config('other.font-awesome') }} fa-exclamation-circle text-red-600"
                               aria-hidden="true" title="{{ \__('common.active-warning') }}"></i>
                        @endif
                    </span>
                </a>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('common.upload') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-arrow-up text-green-500"></i>
                    {{ $user->getUploaded() }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('common.download') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-arrow-down text-red-500"></i>
                     {{ $user->getDownloaded() }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('common.ratio') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-sync-alt text-blue-500"></i>
                     {{ $user->getRatioString() }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('common.buffer') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-angle-double-up text-gray-400"></i>
                    {{ $user->untilRatio(config('other.ratio')) }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('torrent.seeding') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-upload text-green-500"></i>
                    <a href="{{ \route('user_active', ['username' => $user->username]) }}"
                       title="{{ \__('torrent.my-active-torrents') }}">
                    </a>
                    {{ $user->getSeeding() }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('torrent.leeching') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-download text-red-500"></i>
                    <a href="{{ \route('user_active', ['username' => $user->username]) }}"
                       title="{{ \__('torrent.my-active-torrents') }}">
                    </a>
                    {{ $user->getLeeching() }}
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="DL Slots">
                    <i class="{{ \config('other.font-awesome') }} fa-wifi text-blue-500"></i>
                    @if (\config('announce.slots_system.enabled') == true)
                        {{ $user->group->download_slots ?? '∞' }}
                    @endif
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('common.warnings') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-skull-crossbones text-gray-400"></i>
                    <a href="#" title="{{ \__('torrent.hit-and-runs') }}">
                         {{ $user->getWarning() }}
                    </a>
                </span>
            </li>
            <li class="inline-block mr-3">
                <span title="{{ \__('bon.bon') }}">
                    <i class="{{ config('other.font-awesome') }} fa-coins text-yellow-500"></i>
                    <a href="{{ route('bonus') }}" title="{{ __('user.my-bonus-points') }}">
                        {{ $user->getSeedbonus() }}
                    </a>
                </span>
            </li>
            <li class="inline-block mr-3">
                <span class="{{ \__('common.fl_tokens') }}">
                    <i class="{{ \config('other.font-awesome') }} fa-star text-amber-600"></i>
                    <a href="{{ \route('users.show', ['username' => $user->username]) }}"
                       title="{{ \__('user.my-fl-tokens') }}">
                    {{ $user->fl_tokens }}
                    </a>
                </span>
            </li>
            <li class="inline-block mr-3">
                <a href="{{\route('invites.create')}}" title="My Invites">
                    <i class="fas fa-leaf text-blue-500"></i>
                    {{$user->invites}}
                </a>
            </li>
            <li class="inline-block mr-3">
                <a href="{{\route('rss.index')}}" title="RSS">
                    <i class="fas fa-rss text-grey-600"></i>
                </a>
            </li>
            <li class="inline-block mr-3">
                <a href="{{\route('user_security',[$user->username])}}#twostep" title="My 2FA Status">
                    <i class="fas fa-shield text-green-600"></i> 2FA
                </a>
            </li>
            <li class="inline-block ml-3 float-right">
                <span style="color:{{ $user->group->color }}; background-image:{{ $user->group->effect }};">
                    <i class="{{ $user->group->icon }}"></i>
                    <strong> {{ $user->group->name }}</strong>
                </span>
            </li>
        </ul>
    </div>
</div>