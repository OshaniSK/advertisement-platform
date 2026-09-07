<nav x-data="{ open: false, notificationsOpen: false }"
     class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Left Side --}}
            <div class="flex items-center">

                <a href="{{ route('advertisements.index') }}"
                   class="text-xl font-bold text-gray-800">
                    Advertisement
                    <span class="text-blue-600">Platform</span>
                </a>

                <div class="hidden sm:flex ml-10 space-x-8">

                    @if(auth()->user()->role === 'visitor')

                        <a href="{{ route('visitor.dashboard') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>

                        <a href="{{ route('advertisements.index') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Advertisements
                        </a>

                        <a href="{{ route('favorites.index') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            ❤️ Favorites
                        </a>

                    @elseif(auth()->user()->role === 'advertiser')

                        <a href="{{ route('advertiser.dashboard') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>

                        
                        <a href="{{ route('advertisements.create') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600 transition-transform duration-200 button">
                            Post Advertisement
                        </a>

                    @elseif(auth()->user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Dashboard
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                           class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                            Users
                        </a>

                    @endif

                </div>

            </div>


            {{-- Right Side --}}
            <div class="flex items-center">

                {{-- Notification Bell --}}
                <div class="relative mr-5">

                    @php
                        $unreadNotifications = auth()->user()
                            ->unreadNotifications()
                            ->count();
                    @endphp

                    <button
                        type="button"
                        @click="notificationsOpen = !notificationsOpen"
                        class="relative flex items-center justify-center
                               w-10 h-10
                               rounded-full
                               text-gray-600
                               hover:bg-gray-100
                               hover:text-gray-900
                               focus:outline-none"
                    >

                        {{-- Bell Icon --}}
                        <span class="text-2xl">
                            🔔
                        </span>


                        {{-- Unread Badge --}}
                        @if($unreadNotifications > 0)

                            <span
                                class="absolute
                                       -top-1
                                       -right-1
                                       min-w-[20px]
                                       h-5
                                       px-1
                                       flex
                                       items-center
                                       justify-center
                                       bg-red-600
                                       text-white
                                       text-xs
                                       font-bold
                                       rounded-full"
                            >
                                {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                            </span>

                        @endif

                    </button>


                    {{-- Notification Dropdown --}}
                    <div
                        x-show="notificationsOpen"
                        @click.outside="notificationsOpen = false"
                        class="absolute right-0 mt-2 w-80
                               bg-white
                               border border-gray-200
                               rounded-lg
                               shadow-lg
                               z-50"
                        style="display: none;"
                    >

                        <div class="px-4 py-3 border-b">

                            <div class="flex justify-between items-center">

                                <h3 class="font-semibold text-gray-800">
                                    Notifications
                                </h3>

                                @if($unreadNotifications > 0)

                                    <form
                                        method="POST"
                                        action="{{ route('notifications.readAll') }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="text-xs text-blue-600 hover:text-blue-800"
                                        >
                                            Mark all as read
                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>


                        {{-- Notifications List --}}
                        <div class="max-h-80 overflow-y-auto">

                            @forelse(
                                auth()->user()->notifications()->latest()->limit(10)->get()
                                as $notification
                            )

                                @php
                                    $data = $notification->data;

                                    $advertisementId =
                                        $data['advertisement_id'] ?? null;

                                    $senderId =
                                        $data['sender_id'] ?? null;

                                    $isUnread =
                                        is_null($notification->read_at);
                                @endphp


                                @if($advertisementId && $senderId)

                                    <a
                                        href="{{ route('messages.conversation', [
                                            'advertisement' => $advertisementId,
                                            'other_user' => $senderId
                                        ]) }}"
                                        class="block px-4 py-3 border-b
                                               hover:bg-gray-50
                                               {{ $isUnread ? 'bg-blue-50' : '' }}"
                                    >

                                @else

                                    <div
                                        class="px-4 py-3 border-b
                                               {{ $isUnread ? 'bg-blue-50' : '' }}"
                                    >

                                @endif

                                    <div class="flex items-start">

                                        <div class="text-xl">
                                            💬
                                        </div>

                                        <div class="ml-3">

                                            <p class="font-semibold text-sm text-gray-800">

                                                {{ $data['sender_name'] ?? 'New Notification' }}

                                            </p>

                                            @if(isset($data['advertisement_title']))

                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $data['advertisement_title'] }}
                                                </p>

                                            @endif

                                            @if(isset($data['message']))

                                                <p class="text-sm text-gray-600 mt-1">
                                                    {{ $data['message'] }}
                                                </p>

                                            @endif

                                            <p class="text-xs text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>

                                        </div>

                                    </div>

                                @if($advertisementId && $senderId)

                                    </a>

                                @else

                                    </div>

                                @endif

                            @empty

                                <div class="px-4 py-8 text-center">

                                    <div class="text-3xl mb-2">
                                        🔔
                                    </div>

                                    <p class="text-sm text-gray-500">
                                        No notifications yet.
                                    </p>

                                </div>

                            @endforelse

                        </div>


                        {{-- View All --}}
                        <div class="px-4 py-3 border-t text-center">

                            <a
                                href="{{ route('notifications.index') }}"
                                class="text-sm font-semibold text-blue-600 hover:text-blue-800"
                            >
                                View All Notifications
                            </a>

                        </div>

                    </div>

                </div>


                {{-- User Menu --}}
                <div class="relative">

                    <button
                        @click="open = !open"
                        class="flex items-center text-sm font-medium text-gray-700
                               hover:text-gray-900"
                    >

                        {{ auth()->user()->name }}

                        <svg
                            class="ml-2 w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>

                    </button>


                    <div
                        x-show="open"
                        @click.outside="open = false"
                        class="absolute right-0 mt-2 w-48
                               bg-white
                               border border-gray-200
                               rounded-md
                               shadow-lg
                               z-50"
                        style="display: none;"
                    >

                        <a
                            href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        >
                            Profile
                        </a>


                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="w-full text-left px-4 py-2
                                       text-sm text-gray-700
                                       hover:bg-gray-100"
                            >
                                Log Out
                            </button>

                        </form>

                    </div>

                <button @click="document.documentElement.dataset.theme = (document.documentElement.dataset.theme === 'dark') ? '' : 'dark'" class="toggle-dark" title="Toggle Dark Mode"></button>
</div>

            </div>

        </div>

    </div>

</nav>