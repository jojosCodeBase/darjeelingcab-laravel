@extends('layouts.admin-main')
@section('title', 'Enquiries')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">

        <div id="contactSection">
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">General Contact Leads</h3>
                    <p class="text-gray-500 text-sm">Direct messages and support requests from the website</p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">4 New</span>
                    <button class="text-gray-500 hover:text-blue-600 text-sm font-medium transition-colors">Mark all
                        as
                        read</button>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                <div class="hidden lg:block overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Sender</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Subject & Message</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm">Submitted At</th>
                                <th class="px-6 py-4 text-gray-600 font-semibold text-sm text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($enquiries as $enquiry)
                                @php
                                    // Logic to check if the message is new (assuming a status or is_read column)
                                    $isNew = true;
                                @endphp
                                <tr class="hover:bg-blue-50/30 transition-colors {{ $isNew ? 'bg-blue-50/10' : '' }}">
                                    <td class="px-6 py-4 align-top">
                                        <div class="flex items-start gap-3 {{ !$isNew ? 'pl-5' : '' }}">
                                            @if ($isNew)
                                                <div class="w-2 h-2 mt-2 bg-blue-600 rounded-full shrink-0 animate-pulse">
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-gray-900 {{ $isNew ? 'font-bold' : 'font-medium' }}">
                                                    {{ $enquiry->name }}</p>
                                                <p class="text-gray-500 text-xs">{{ $enquiry->email }}</p>
                                                <p class="text-indigo-600 text-xs font-medium mt-1 tracking-wide">
                                                    {{ $enquiry->phone }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top">
                                        <div class="max-w-md {{ !$isNew ? 'opacity-70' : '' }}">
                                            <span
                                                class="block text-sm font-bold text-gray-900 mb-1">{{ $enquiry->subject }}</span>
                                            <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                                {{ $enquiry->message }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 align-top whitespace-nowrap">
                                        <div class="text-sm {{ !$isNew ? 'opacity-60' : '' }}">
                                            <p class="text-gray-900 font-medium">{{ $enquiry->created_at->format('M d, Y') }}
                                            </p>
                                            <p class="text-gray-400 text-xs">{{ $enquiry->created_at->diffForHumans() }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right align-top">
                                        <div class="flex justify-end gap-2">
                                            {{-- <a href="{{ route('admin.messages.show', $enquiry->id) }}" --}}
                                            <a href=""
                                                class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors"
                                                title="View/Reply">
                                                <i class="fas fa-reply"></i>
                                            </a>
                                            {{-- <form action="{{ route('admin.messages.destroy', $enquiry->id) }}" method="POST" --}}
                                            <form action="" method="POST"
                                                onsubmit="return confirm('Delete message?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-400 hover:text-red-600 rounded-lg transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-400">No messages found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="lg:hidden p-4 space-y-4">
                    @foreach ($enquiries as $enquiry)
                        @php $isNew = true; @endphp
                        <div
                            class="{{ $isNew ? 'bg-blue-50/30 border-blue-100' : 'bg-white border-gray-200' }} rounded-xl p-4 border relative overflow-hidden">
                            @if ($isNew)
                                <div
                                    class="absolute top-0 right-0 p-2 bg-blue-600 text-white text-[10px] font-bold uppercase tracking-tighter">
                                    New</div>
                            @endif

                            <div class="flex items-center gap-3 mb-3">
                                <div
                                    class="w-10 h-10 {{ $isNew ? 'bg-blue-600' : 'bg-gray-400' }} rounded-full flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($enquiry->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h4 class="text-gray-900 font-bold">{{ $enquiry->name }}</h4>
                                    <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                                        {{ $enquiry->created_at->format('M d • h:i A') }}
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <p class="text-xs font-bold text-indigo-600 flex items-center gap-2">
                                    <i class="fas fa-phone-alt"></i> {{ $enquiry->phone }}
                                </p>
                                <p class="text-sm font-bold text-gray-800">Subject: {{ $enquiry->subject }}</p>
                                <p class="text-sm text-gray-600 italic line-clamp-3">"{{ $enquiry->message }}"</p>
                            </div>

                            <div class="flex gap-2 border-t {{ $isNew ? 'border-blue-100' : 'border-gray-100' }} pt-3">
                                {{-- <a href="{{ route('admin.messages.show', $enquiry->id) }}" --}}
                                <a href=""
                                    class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg text-xs font-bold">Reply</a>
                                {{-- <form action="{{ route('admin.messages.destroy', $enquiry->id) }}" method="POST" --}}
                                <form action="" method="POST"
                                    class="shrink-0">
                                    @csrf @method('DELETE')
                                    <button
                                        class="px-4 py-2 bg-white text-gray-400 border border-gray-200 rounded-lg hover:text-red-600">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
@endsection
