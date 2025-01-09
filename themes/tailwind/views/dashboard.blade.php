<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- You're logged in! -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($users as $user)
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center">
                                        <a href="{{ route('chat', $user->friend_id) }}">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->friend_name }}</div>
                                                <div class="text-sm text-gray-500">{{ $user->friend_email }}</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 border border-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-800 bg-red-100 border border-red-200 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- You're logged in! -->
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($friendRequests as $friendRequest)
                            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $friendRequest->sender_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $friendRequest->sender_email }}</div>
                                            <div class="mt-4 flex space-x-2">
                                                <form method="POST" action="{{ route('friend.accept', ['email' => $friendRequest->sender_email]) }}">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('friend.decline', ['email' => $friendRequest->sender_email]) }}">
                                                    @csrf
                                                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">Decline</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Send Friend Request</h3>
                    <form method="POST" action="{{ route('friend.send') }}">
                        @csrf
                        <div class="flex items-center mt-4">
                            <input type="email" name="email" class="w-full px-4 py-2 mr-2 border rounded-lg" placeholder="Enter email address" required>
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-700">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
