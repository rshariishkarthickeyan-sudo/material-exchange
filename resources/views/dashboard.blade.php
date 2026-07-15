<x-app-layout>

<div class="p-6">

    <div class="bg-white p-6 shadow rounded">
<center>
        <h1 class="text-xl font-bold mb-8 text-center">
            Material Pass Web Portal
        </h1>
</center>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 mt-6">

    <div class="bg-blue-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Total Gate Passes</h3>
        <p class="text-3xl">{{ $totalGatePasses ?? 0 }}</p>
    </div>

    <div class="bg-yellow-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Pending Approval</h3>
        <p class="text-3xl">{{ $pendingApproval ?? 0 }}</p>
    </div>

    <div class="bg-green-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Approved</h3>
        <p class="text-3xl">{{ $approved ?? 0 }}</p>
    </div>

    <div class="bg-purple-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Released</h3>
        <p class="text-3xl">{{ $released ?? 0 }}</p>
    </div>

    <div class="bg-cyan-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Returned</h3>
        <p class="text-3xl">{{ $returned ?? 0 }}</p>
    </div>

    <div class="bg-red-500 text-white p-4 rounded shadow">
        <h3 class="font-bold">Overdue</h3>
        <p class="text-3xl">{{ $overdue ?? 0 }}</p>
    </div>

    <div class="bg-white shadow rounded-lg mt-6 p-4">

    <h2 class="text-lg font-bold mb-4">
        Recent Gate Passes
    </h2>

    <table class="w-full border-collapse border">

        <thead>

            <tr class="bg-gray-100">

                <th class="border p-2">ID</th>

                <th class="border p-2">Category</th>

                <th class="border p-2">Destination</th>

                <th class="border p-2">Status</th>

                <th class="border p-2">Created Date</th>

            </tr>

        </thead>

        <tbody>

            @foreach($recentGatePasses as $pass)

            <tr>

                <td class="border p-2">
                    {{ $pass->id }}
                </td>

                <td class="border p-2">
                    {{ $pass->category }}
                </td>

                <td class="border p-2">
                    {{ $pass->destination }}
                </td>

                <td class="border p-2">

                    @if($pass->status == 'PENDING_APPROVAL')

                        <span class="text-yellow-600 font-bold">
                            Pending
                        </span>

                    @elseif($pass->status == 'APPROVED')

                        <span class="text-green-600 font-bold">
                            Approved
                        </span>

                    @elseif($pass->status == 'RELEASED')

                        <span class="text-purple-600 font-bold">
                            Released
                        </span>

                    @elseif($pass->status == 'RETURNED')

                        <span class="text-blue-600 font-bold">
                            Returned
                        </span>

                    @else

                        {{ $pass->status }}

                    @endif

                </td>

                <td class="border p-2">
                    {{ $pass->created_at->format('d-m-Y') }}
                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>
</div>
<div class="bg-white shadow rounded-lg mt-6 p-5">

    <h2 class="text-xl font-bold mb-4">
        Notifications
    </h2>

    <div class="space-y-3">

        <!-- Overdue Materials -->
        <a href="{{ route('overdue.report') }}"
           class="block">

            <div class="bg-red-100 border-l-4 border-red-500 p-4 rounded hover:bg-red-200">

                ⚠ <strong>{{ $overdue }}</strong>
                Overdue Materials

            </div>

        </a>

        <!-- Pending Approvals -->
        <a href="{{ route('pending.approval.report') }}"
           class="block">

            <div class="bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded hover:bg-yellow-200">

                ⏳ <strong>{{ $pendingApproval }}</strong>
                Pending Approvals

            </div>

        </a>

        <!-- Due Tomorrow -->
        <a href="{{ route('due.tomorrow.report') }}"
           class="block">

            <div class="bg-blue-100 border-l-4 border-blue-500 p-4 rounded hover:bg-blue-200">

                🔄 <strong>{{ $dueTomorrow }}</strong>
                Materials Due Tomorrow

            </div>

        </a>

    </div>

</div>

    <hr>
        <table>

            <tr>

                <!-- Department Materials -->

                

                    <details>

                        <summary
                            class="bg-white-800 text-black px-4 py-2 cursor-pointer font-semibold w-[280px] ">

                            Department Materials

                        </summary>

                        <div class="bg-gray-200 border w-[450px]">

                            <a href="/gatepass/returnable"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Dept Outgoing Returnable Material

                            </a>

                            <a href="/gatepass/non-returnable"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Dept Outgoing Non-Returnable Material

                            </a>

                        </div>

                    </details>

                

                <!-- Department Materials Report -->

                
                
                    <details>
                    
                        <summary
                            class="bg-white-800 text-black px-4 py-2 cursor-pointer font-semibold w-[320px]">
                            Department Materials Report
                         
                        </summary>


                        <div class="bg-gray-200 border w-[450px]">

                            <a href="{{ route('returnable.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Returnable Material Report


                            </a>

                            <a href="{{ route('nonreturnable.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Non Returnable Material Report

                            </a>

                            <a href="{{ route('pending.approval.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Pending Approval Report

                            </a>

                            <a href="{{ route('security.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Security Clearance Report

                            </a>

                            <a href="{{ route('released.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Released Material Report

                            </a>

                            <a href="{{ route('return.pending.report') }}"
                               class="block px-4 py-2 hover:bg-gray-300">

                                Return Pending Report

                            </a>

                            <a href="{{ route('returned.report') }}"
                                class="block px-4 py-2 hover:bg-gray-300">

                                Returned Materials Report

                            </a>

                        </div>

                    </details>

                

            </tr>

        </table>

    </div>
   

</div>

</x-app-layout>