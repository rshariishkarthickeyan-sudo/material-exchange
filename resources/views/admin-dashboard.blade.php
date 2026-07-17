<x-app-layout>

<h2 class="text-2xl font-bold mb-5">
Admin Dashboard
</h2>

<a href="{{ route('returnable.report') }}">Returnable Report</a><br>
<a href="{{ route('nonreturnable.report') }}">Non Returnable Report</a><br>
<a href="{{ route('pending.approval.report') }}">Pending Approval</a><br>
<a href="{{ route('security.report') }}">Security Report</a><br>
<a href="{{ route('released.report') }}">Released Report</a><br>
<a href="{{ route('return.pending.report') }}">Return Pending</a><br>
<a href="{{ route('returned.report') }}">Returned Report</a><br>
<a href="{{ route('overdue.report') }}">Overdue Report</a>

</x-app-layout>