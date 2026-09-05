<x-app-layout>

```
<x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Visitor Dashboard') }}
    </h2>

</x-slot>


<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

            <div class="p-6 text-gray-900">

                <h3 class="text-lg font-semibold mb-2">
                    Welcome!
                </h3>

                <p class="text-gray-600">
                    Browse advertisements and contact sellers.
                </p>


                <div class="mt-6 flex flex-wrap gap-4">


                    <!-- Browse Advertisements -->

                    <a
                        href="{{ route('advertisements.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700"
                    >
                        Browse Advertisements
                    </a>


                    <!-- Messages -->

                    <a
                        href="{{ route('messages.inbox') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                    >

                        💬 View Messages

                        @if(isset($unreadMessages) && $unreadMessages > 0)

                            <span
                                class="ml-2 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full"
                            >
                                {{ $unreadMessages }}
                            </span>

                        @endif

                    </a>


                </div>

            </div>

        </div>

    </div>

</div>
```

</x-app-layout>
