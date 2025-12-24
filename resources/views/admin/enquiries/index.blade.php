@extends('layouts.admin-main')
@section('title', 'Enquiries')
@section('content')
    <main class="p-4 sm:p-6 lg:p-8">

        <div id="contactSection">
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-gray-900 text-xl font-bold mb-1">General Contact Leads ({{ count($enquiries) }})</h3>
                    <p class="text-gray-500 text-sm">Direct messages and support requests from the website</p>
                </div>
                <div class="flex items-center gap-3">
                    @if ($unread_count > 0)
                        <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $unread_count }}
                            New</span>
                        <form action="{{ route('enquiries.read-all') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-gray-500 hover:text-blue-600 text-sm font-medium transition-colors">Mark all
                                as
                                read</button>
                        </form>
                    @endif
                </div>
            </div>

            @include('include.alerts')

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
                                    $isNew = is_null($enquiry->read_at) ? true : false;
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
                                            <p class="text-gray-900 font-medium">
                                                {{ $enquiry->created_at->format('M d, Y') }}
                                            </p>
                                            <p class="text-gray-400 text-xs">{{ $enquiry->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right align-top">
                                        <div class="flex justify-end gap-2">
                                            <div class="flex justify-end gap-2">
                                                <button type="button" data-enquiry="{{ json_encode($enquiry) }}"
                                                    class="viewEnquiryBtn w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                
                                                @if (is_null($enquiry->read_at))
                                                    <form action="{{ route('enquiry.update', $enquiry->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to mark this as read?')">
                                                        @csrf @method('PATCH')
                                                        <button type="submit"
                                                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                                            <i class="fas fa-check text-xs"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="" method="POST"
                                                    onsubmit="return confirm('Delete this enquiry?')">
                                                    <input type="hidden" name="_token"
                                                        value="2l3zS33diw2bxJaRuwbak9EGGFzqiY9mE55A3iUq" autocomplete="off">
                                                    <input type="hidden" name="_method" value="DELETE"> <button
                                                        type="submit"
                                                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                                        <i class="fas fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
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
                        @php $isNew = is_null($enquiry->read_at) ? true : false; @endphp
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
                                <button type="button" data-enquiry="{{ json_encode($enquiry) }}"
                                    class="viewEnquiryBtn flex-1 bg-blue-600 text-white py-2 rounded-lg text-xs font-bold flex items-center justify-center gap-2">
                                    <i class="fas fa-eye"></i> View
                                </button>

                                @if (is_null($enquiry->read_at))
                                    <form action="{{ route('enquiry.update', $enquiry->id) }}" method="POST"
                                        class="shrink-0">
                                        @csrf @method('PATCH')
                                        <button type="submit"
                                            class="w-10 py-2 bg-green-50 text-green-600 border border-green-100 rounded-lg hover:bg-green-600 hover:text-white transition-all">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('enquiry.destroy', $enquiry->id) }}" method="POST" class="shrink-0"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button
                                        class="w-10 py-2 bg-red-50 text-red-400 border border-red-100 rounded-lg hover:text-red-600 hover:bg-red-50">
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

    <div id="enquiryModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeModal()"></div>

            <div
                class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start pb-3 border-b">
                        <h3 class="text-lg font-bold text-gray-900" id="modalSubject">Enquiry Details</h3>
                        <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="mt-4 space-y-3">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">From</label>
                            <p id="modalName" class="text-sm font-semibold text-gray-900"></p>
                            <p id="modalEmail" class="text-xs text-blue-600"></p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase">Phone</label>
                            <p id="modalPhone" class="text-sm text-gray-900"></p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <label class="text-xs font-bold text-gray-400 uppercase">Message</label>
                            <p id="modalMessage" class="text-sm text-gray-700 leading-relaxed mt-1 whitespace-pre-line">
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal()"
                        class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.viewEnquiryBtn').on('click', function() {
                const enquiry = $(this).data('enquiry');

                // Fill Modal Data
                $('#modalSubject').text(enquiry.subject);
                $('#modalName').text(enquiry.name);
                $('#modalEmail').text(enquiry.email);
                $('#modalPhone').text(enquiry.phone);
                $('#modalMessage').text(enquiry.message);

                // Show Modal
                $('#enquiryModal').removeClass('hidden');

                // Optional: If it's unread, trigger the 'Mark as Read' automatically
                if (enquiry.read_at === null) {
                    markAsRead(enquiry.id);
                }
            });
        });

        function closeModal() {
            $('#enquiryModal').addClass('hidden');
        }

        function markAsRead(id) {
            $.ajax({
                url: `/admin/enquiry/${id}`, // Update this to match your PATCH route
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PATCH'
                },
                success: function() {
                    // Optional: Refresh page or update UI badges without reload
                    console.log('Marked as read');
                }
            });
        }
    </script>
@endsection
