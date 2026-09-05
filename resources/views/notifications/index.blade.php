<x-app-layout>

    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>

    </x-slot>


    <div class="py-12 bg-gray-50 min-h-screen">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>

            @endif


            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                {{-- Header --}}
                <div class="px-6 py-5 border-b border-gray-200">

                    <div class="flex items-center justify-between">

                        <div>

                            <h1 class="text-xl font-bold text-gray-800">
                                🔔 Notifications
                            </h1>

                            <p class="text-sm text-gray-500 mt-1">
                                Stay updated with activity on your account.
                            </p>

                        </div>


                        @if(auth()->user()->unreadNotifications()->count() > 0)

                            <form
                                action="{{ route('notifications.readAll') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="px-4 py-2
                                           bg-blue-600
                                           text-white
                                           text-sm
                                           font-semibold
                                           rounded-md
                                           hover:bg-blue-700
                                           transition"
                                >
                                    Mark All as Read
                                </button>

                            </form>

                        @endif

                    </div>

                </div>


                {{-- Notification List --}}
                <div>

                    @forelse($notifications as $notification)

                        @php
                            $data = $notification->data;

                            $advertisementId =
                                $data['advertisement_id'] ?? null;

                            $senderId =
                                $data['sender_id'] ?? null;

                            $isUnread =
                                is_null($notification->read_at);
                        @endphp


                        <div
                            class="px-6 py-5
                                   border-b border-gray-100
                                   {{ $isUnread ? 'bg-blue-50' : 'bg-white' }}"
                        >

                            <div class="flex items-start">

                                {{-- Icon --}}
                                <div
                                    class="flex-shrink-0
                                           w-12 h-12
                                           rounded-full
                                           bg-blue-100
                                           flex items-center justify-center
                                           text-xl"
                                >
                                    💬
                                </div>


                                {{-- Notification Content --}}
                                <div class="ml-4 flex-1">

                                    <div class="flex items-start justify-between">

                                        <div>

                                            <h3 class="font-semibold text-gray-800">

                                                @if(isset($data['sender_name']))

                                                    {{ $data['sender_name'] }}

                                                @else

                                                    New Notification

                                                @endif

                                            </h3>


                                            @if(isset($data['advertisement_title']))

                                                <p class="text-sm text-gray-500 mt-1">

                                                    {{ $data['advertisement_title'] }}

                                                </p>

                                            @endif

                                        </div>


                                        @if($isUnread)

                                            <span
                                                class="inline-flex
                                                       items-center
                                                       px-2 py-1
                                                       text-xs
                                                       font-semibold
                                                       text-blue-700
                                                       bg-blue-100
                                                       rounded-full"
                                            >
                                                New
                                            </span>

                                        @endif

                                    </div>


                                    @if(isset($data['message']))

                                        <p class="text-gray-600 text-sm mt-2">

                                            {{ $data['message'] }}

                                        </p>

                                    @endif


                                    <p class="text-xs text-gray-400 mt-2">

                                        {{ $notification->created_at->diffForHumans() }}

                                    </p>


                                    {{-- Actions --}}
                                    <div class="mt-3 flex flex-wrap gap-2">

                                        @if($advertisementId && $senderId)

                                            <a
                                                href="{{ route('messages.conversation', [
                                                    'advertisement' => $advertisementId,
                                                    'other_user' => $senderId
                                                ]) }}"
                                                class="inline-flex
                                                       items-center
                                                       px-3 py-2
                                                       bg-blue-600
                                                       text-white
                                                       text-xs
                                                       font-semibold
                                                       rounded-md
                                                       hover:bg-blue-700"
                                            >
                                                Open Conversation
                                            </a>

                                        @endif


                                        @if($isUnread)

                                            <form
                                                action="{{ route('notifications.read', $notification->id) }}"
                                                method="POST"
                                            >

                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="inline-flex
                                                           items-center
                                                           px-3 py-2
                                                           bg-gray-100
                                                           text-gray-700
                                                           text-xs
                                                           font-semibold
                                                           rounded-md
                                                           hover:bg-gray-200"
                                                >
                                                    Mark as Read
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>


                    @empty

                        {{-- Empty State --}}
                        <div class="px-6 py-16 text-center">

                            <div class="text-5xl mb-4">
                                🔔
                            </div>

                            <h3 class="text-lg font-semibold text-gray-800">
                                No Notifications
                            </h3>

                            <p class="text-gray-500 mt-2">
                                You don't have any notifications yet.
                            </p>

                        </div>

                    @endforelse

                </div>


                {{-- Pagination --}}
                @if($notifications->hasPages())

                    <div class="px-6 py-4 border-t border-gray-200">

                        {{ $notifications->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>