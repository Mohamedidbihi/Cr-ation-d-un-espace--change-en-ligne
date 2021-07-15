@extends('layouts.app')

@section('content')
<div class="mb-4 py-8 px-8 max-w-l  bg-white rounded-xl shadow-md space-y-2 sm:py-4 sm:flexr sm:space-y-0 sm:space-x-6">
            <div class="text-center space-y-2 sm:text-left">
                <div class="space-y-0.5">
                    <p class="text-lg text-black font-semibold">
                        {{$data[0]->user->name}}
                    </p>
                    <p class="text-gray-500 font-medium">
                        {{ \Carbon\Carbon::parse($data[0]['created_at'])->diffForHumans() }}
                    </p>
                    <p class="text-lg text-black font-semibold">
                        {{$data[0]['body']}}
                    </p> 
                </div>
            </div>
</div>
@auth
<div class="flex items-center justify-center shadow-lg  mb-4 max-w-lg">
    <form method="POST" action="{{route('comments')}}" class="w-full max-w-xl bg-white rounded-lg px-4 pt-2">
        @csrf
       <div class="flex flex-wrap -mx-3 mb-6">
          <h2 class="px-4 pt-3 pb-2 text-gray-800 text-lg">Add a new comment</h2>
          <div class="w-full md:w-full px-3 mb-2 mt-2">
            <input type="hidden" name="id" value=" {{ $data[0]['id'] }} ">
             <textarea class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white" name="commenter" placeholder='Type Your Comment' required></textarea>
          </div>
          <div class="w-full md:w-full flex items-start md:w-full px-3">
             <div class="flex items-start w-1/2 text-gray-700 px-2 mr-auto">
                <svg fill="none" class="w-5 h-5 text-gray-600 mr-1" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs md:text-sm pt-px">Respecter les règles.</p>
             </div>
             <div class="-mr-1">
                <input type='submit' class="bg-white text-gray-700 font-medium py-1 px-4 border border-gray-400 rounded-lg tracking-wide mr-1 hover:bg-gray-100" value='Post Comment'>
             </div>
          </div>
       </form>
    </div>
 </div> 
 @endauth
@if ($comments->count())
<h2>Comments:</h2>
@foreach ($comments as $comment)
<div class="border rounded-lg p-4 bg-white">
    {{$comment->commenter}}
    <p class="text-gray-500 font-medium">
        {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
    </p>
  </div>


 @endforeach
 @else
 <div class="bg-blue-300 p-4  mb-4 text-white text-center">
    <p>There are no Comments</p>
</div>
 @endif
 
   
@endsection
