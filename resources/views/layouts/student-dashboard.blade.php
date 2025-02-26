<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$student_id = DB::table('student')
    ->where('user_id', '=', Auth::user()->id)
    ->value('id');

$department_id = DB::table('student')
    ->where('user_id', '=', Auth::user()->id)
    ->value('department_id');

$faculties = DB::table('faculty')
    ->where('department_id', "=",  $department_id)
    ->select("faculty.id", "faculty.first_name", "faculty.last_name")
    ->get();
?>

@section('content')
<div class="flex justify-end mb-4">
    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="openModal()">
        Submit Document
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @foreach($documents as $item)
    <div class="bg-white rounded-md shadow-lg p-4">
        <div class="font-bold">ID: {{ $item->id }}</div>
        <div class="font-semibold">Title: {{ $item->title }}</div>
        <div>Abstract: {{ $item->abstract }}</div>
        <div>Field/Topic: {{ $item->field_topic }}</div>
        <div>Status: {{ $item->name }}</div>
        <div>First Name: {{ $item->first_name }}</div>
        <div>Last Name: {{ $item->last_name }}</div>
    </div>
    @endforeach
</div>
@endsection

@section('button')

<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg mx-4 sm:mx-6 md:mx-8 lg:mx-10 xl:mx-12">
        <h2 class="text-xl font-bold mb-4">Submit Document</h2>
        <form method="POST" action="/submit-document" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter the title of your document">
            </div>
            <div class="mb-4">
                <label for="abstract" class="block text-gray-700">Abstract</label>
                <textarea id="abstract" name="abstract" rows="8" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Provide a brief summary of your document"></textarea>            <div class="mb-4">
                <label for="field_topic" class="block text-gray-700">Field/Topic</label>
                <textarea id="field_topic" name="field_topic" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Specify the field or topic of your document"></textarea>
            </div>
            <div class="mb-4">
                <label for="faculty" class="block text-gray-700">Adviser</label>
                <select id="faculty" name="faculty" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" hidden>Select Adviser</option>
                    @foreach ($faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->first_name . " " .$faculty->last_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="file" class="block text-gray-700">Upload File (*.pdf only)</label>
                <input type="file" id="file" name="file" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Upload your document in PDF format">
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 mr-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" wire:click="submitDocument">Submit</button>
            </div>
        </form>
    </div>
</div>

@if (session()->has('success'))
<div x-data="{ show: true }"
    x-show="show"
    x-transition
    x-init="setTimeout(() => show = false, 3000)"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-sm text-center">
        <h2 class="text-xl font-bold mb-4">Submitted Successfully!</h2>
        <p>Your document has been submitted.</p>
        <br>
        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 mr-2" @click="show : false">Close</button>
    </div>
</div>
@endif

@endsection
