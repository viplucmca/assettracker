<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-blue-900 dark:text-blue-200 leading-tight">
            {{ __('Emails') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 px-4 py-2 rounded">{{ session('status') }}</div>
            @endif

            <div class="flex items-center justify-between">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" placeholder="Search"
                           class="border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white px-3 py-2">
                    <input type="date" name="date_from" value="{{ $filters['date_from'] ?? '' }}"
                           class="border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white px-3 py-2">
                    <input type="date" name="date_to" value="{{ $filters['date_to'] ?? '' }}"
                           class="border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white px-3 py-2">
                    <select name="label_id" class="border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white px-3 py-2">
                        <option value="">All Labels</option>
                        @foreach ($labels as $label)
                            <option value="{{ $label->id }}" {{ ($filters['label_id'] ?? '') == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                        @endforeach
                    </select>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md">Filter</button>
                </form>
                <a href="{{ route('emails.sync') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md">Sync Gmail (Dummy)</a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-blue-200 dark:border-blue-700">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($messages as $message)
                        <a href="{{ route('emails.show', $message->id) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-blue-900 dark:text-blue-200 font-semibold">{{ $message->subject ?: '(No subject)' }}</div>
                                    <div class="text-sm text-gray-600 dark:text-gray-300">From: {{ $message->sender_name ?: $message->sender_email }} — {{ optional($message->sent_date)->format('Y-m-d H:i') }}</div>
                                </div>
                                <div class="flex gap-2">
                                    @foreach ($message->labels as $label)
                                        <span class="text-xs px-2 py-1 rounded" style="background-color: {{ $label->color ?? '#e5e7eb' }}; color:#111827">{{ $label->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-6 text-gray-500 dark:text-gray-400">No emails found.</div>
                    @endforelse
                </div>
            </div>

            <div>
                {{ $messages->links() }}
            </div>
        </div>
    </div>
</x-app-layout>


