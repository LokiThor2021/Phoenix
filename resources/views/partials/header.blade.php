<div class="bg-neutral-700">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-row py-2.5">
            <div class="w-1/2 flex items-center">
                <a href="/">
                    <img src="{{\asset('img/logo.png')}}" alt="logo">
                </a>
            </div>
            <div class="w-1/2 divide-y divide-neutral-500 pr-1">
                <div class="flex flex-col pb-1.5">
                    <ul class="text-right text-xl">
                        <li class="inline-block mr-4" title="{{__('common.upload')}}">
                            <a href="{{\route('upload_form')}}">
                                <i class="fa fa-upload"></i>
                            </a>
                        </li>
                        <li class="inline-block mr-4" title="{{__('common.subscriptions')}}">
                            <a href="{{ \route('forum_subscriptions') }}">
                                <i class="fa fa-wifi"></i>
                            </a>
                        </li>
                        <li class="inline-block mr-4" title="{{__('common.rss-system')}}">
                            <a href="{{ \route('rss.index') }}">
                                <i class='fa fa-rss'></i>
                            </a>
                        </li>
                        {{-- TODO move to livewire--}}
                        @php $pm = \Illuminate\Support\Facades\DB::table('private_messages')->where('receiver_id', '=', $user->id)->where('read', '=', '0')->count() @endphp
                        <li class="inline-block mr-4" title="{{__('pm.inbox')}}">
                            <a href="{{ \route('inbox') }}">
                                <i class="fa fa-envelope"></i>
                                @if ($pm > 0)
                                    <div class="notify">
                                        <span class="heartbit"></span><span class="point fa-beat"></span></div>
                                @endif
                            </a>
                        </li>
                        <li class="inline-block mr-4" title="{{__('common.notifications')}}">
                            <a href="{{ \route('notifications.index') }}">
                                <i class="fa fa-bell"></i>
                                @if ($user->unreadNotifications->count() > 0)
                                    <div class="notify">
                                        <span class="heartbit"></span><span class="point fa-beat"></span></div>
                                @endif
                            </a>
                        </li>
                        <li class="inline-block mr-4" title="{{__('common.article')}}">
                            <a href="{{ \route('articles.index') }}">
                                <i class="fa fa-newspaper"></i>
                            </a>
                        </li>

                        <li class="inline-block mr-4" title="{{__('ticket.helpdesk')}}">
                            <a href="{{ \route('tickets.index') }}" class="icon-circle">
                                <i class="fa fa-life-ring"></i>
                                <!-- Notifications for Mods -->
                                @if ($user->group->is_modo)
                                    @php $tickets = \Illuminate\Support\Facades\DB::table('tickets')
                            ->whereNull('closed_at')->whereNull('staff_id')
                            ->orwhere(function($query) use ($user) {
                                $query->where('staff_id', '=', $user->id)
                                      ->Where('staff_read', '=', '0');
                            })->count()
                                    @endphp
                                    @if ($tickets > 0)
                                        <div class="notify">
                                            <span class="heartbit"></span><span class="point fa-beat"></span></div>
                                    @endif
                                    <!-- Notification for Users -->
                                @else
                                    @php $ticket_unread = \Illuminate\Support\Facades\DB::table('tickets')
                            ->where('user_id', '=', $user->id)
                            ->where('user_read', '=', '0')
                            ->count()
                                    @endphp
                                    @if ($ticket_unread > 0)
                                        <div class="notify">
                                            <span class="heartbit"></span><span class="point fa-beat"></span></div>
                                    @endif
                                @endif
                            </a>
                        </li>

                        @if ($user->group->is_modo)
                            <li class="inline-block mr-3" title="{{__('common.moderation')}}">
                                <a href="{{ \route('staff.moderation.index') }}" class="icon-circle">
                                    <i class="fa fa-tasks"></i>
                                    @php $modder = DB::table('torrents')->where('status', '=', '0')->count() @endphp
                                    @if ($modder > 0)
                                        <div class="notify">
                                            <span class="heartbit"></span><span class="point fa-beat"></span></div>
                                    @endif
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
                <div class="flex flex-col items-end pt-1.5">
                    <livewire:quick-search-dropdown/>
                </div>
            </div>
            <div class="flex flex-row w-20 px-2.5 items-center">
                <a href="#">
                    @if ($user->image !== null)
                        <img width="50px"
                             src="{{ \asset('files/img/' . $user->image) }}"
                             loading="lazy"
                             alt="{{ $user->username }}"
                             class="rounded-full border bg-neutral-600">
                    @else
                        <img width="50px"
                             src="{{ \asset('img/profile.png') }}"
                             loading="lazy"
                             alt="{{$user->username }}"
                             class="rounded-full border border-neutral-600">
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>