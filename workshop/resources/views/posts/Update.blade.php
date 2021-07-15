@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
 <div class="w-8/12 bg-white p-6 rounded-lg">
    <h2 class="text-5xl font-normal leading-normal mt-0 mb-2 ">
       Update Poste
    </h2>
    <form action="{{ route('posts.maj') }}"  method="POST" class="mb-4">
        @csrf
        <div class="mb-4">
            <input type="hidden" name="id" value=" {{ $data[0]['id'] }} ">
            <label for="body" class="sr-only">body</label>
            <textarea name="body" id="body" cols="30" rows="4"
                class="bg-gray-100 border-2 w-full p-4 rounded-lg 
                placeholder="Post something" >{{ $data[0]['body'] }}</textarea>
        </div>
        <button type="submit"
            class="hover:bg-light-blue-200 hover:text-light-blue-800 group flex  bg-blue-500 text-white px-4 py-2 rounded font-medium">
            Update
        </button>
    </form>

 </div>
    </div>
@endsection