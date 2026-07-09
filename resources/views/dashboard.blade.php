<x-app-layout>

<div class="p-6">

    <div class="bg-white p-6 shadow rounded">
<center>
        <h1 class="text-xl font-bold mb-8 text-center">
            Material Pass Web Portal
        </h1>
</center>

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

                            <a href="{{ route('gatepass.report') }}"
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