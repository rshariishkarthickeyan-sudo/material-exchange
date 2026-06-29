<x-app-layout>

<div class="container mx-auto p-6">

<h1 class="text-3xl font-bold text-black mb-4">

Add Material

</h1>

<form method="POST"
      action="{{ route('materials.store') }}">

@csrf

<div class="mb-4">

<label class="block text-black">

Material Code

</label>

<input type="text"
       name="material_code"
       class="border border-black p-2 w-full">

</div>

<div class="mb-4">

<label class="block text-black">

Material Name

</label>

<input type="text"
       name="material_name"
       class="border border-black p-2 w-full">

</div>

<div class="mb-4">

<label class="block text-black">

Category

</label>

<select name="material_category_id"
        class="border border-black p-2 w-full">

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->category_name }}

</option>

@endforeach

</select>

</div>

<div class="mb-4">

<label class="block text-black">

Unit

</label>

<input type="text"
       name="unit"
       class="border border-black p-2 w-full">

</div>

<div class="mb-4">

<label class="block text-black">

Stock Quantity

</label>

<input type="number"
       step="0.01"
       name="stock_quantity"
       class="border border-black p-2 w-full">

</div>

<div class="mb-4">

<label class="block text-black">

Location

</label>

<input type="text"
       name="location"
       class="border border-black p-2 w-full">

</div>

<div class="mb-4">

<label class="block text-black">

Status

</label>

<select name="status"
        class="border border-black p-2 w-full">

<option value="ACTIVE">

ACTIVE

</option>

<option value="INACTIVE">

INACTIVE

</option>

</select>

</div>

<button type="submit"
        class="border border-black bg-gray-200 text-black px-4 py-2">

Save Material

</button>

</form>

</div>

</x-app-layout>