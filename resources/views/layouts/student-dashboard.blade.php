@extends('layouts.app')

@section('button')
<!-- Submit Document Button -->
<div class="mt-4">
    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700" onclick="openModal()">
        Submit Document
    </button>
</div>

<!-- Modal -->
<!-- Modal -->
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-bold mb-4">Submit Document</h2>
        <form>
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="abstract" class="block text-gray-700">Abstract</label>
                <textarea id="abstract" name="abstract" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="faculty" class="block text-gray-700">Faculty</label>
                <select id="faculty" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="faculty1">Faculty 1</option>
                    <option value="faculty2">Faculty 2</option>
                    <option value="faculty3">Faculty 3</option>
                    <option value="faculty4">Faculty 4</option>
                    <option value="faculty5">Faculty 5</option>
                </select>

            </div>
            <div class="mb-4">
                <label for="file" class="block text-gray-700">Upload File</label>
                <input type="file" id="file" name="file" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-700 mr-2" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection