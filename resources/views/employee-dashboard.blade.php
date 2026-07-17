<x-app-layout>

<h2 class="text-2xl font-bold mb-5">
Employee Dashboard
</h2>

<a href="/gatepass/returnable">
Create Returnable Pass
</a>

<br><br>

<a href="/gatepass/non-returnable">
Create Non Returnable Pass
</a>

<br><br>

<a href="{{ route('returnable.report') }}">
My Reports
</a>

</x-app-layout>