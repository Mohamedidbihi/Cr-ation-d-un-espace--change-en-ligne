@extends('layouts.app')

@section('content')

<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <h2 class="text-5xl font-normal leading-normal mt-0 mb-2 ">
            J'ai testé a SAFI ... et je vous le recommande
        </h2>
        @auth
        <form action="{{ route('posts') }}" method="post" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="body" class="sr-only">body</label>
                <textarea name="body" id="body" cols="30" rows="4"
                    class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
                    placeholder="Post something"></textarea>

                @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit"
                class="hover:bg-light-blue-200 hover:text-light-blue-800 group flex  bg-blue-500 text-white px-4 py-2 rounded font-medium">
                <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" width="12" height="20"
                    fill="currentColor">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z" />
                </svg>
                Post
            </button>
        </form>             
        @endauth
        @if ($posts->count())
        @foreach ($posts as $post)
        <div
            class="mb-4 py-8 px-8 max-w-l  bg-white rounded-xl shadow-md space-y-2 sm:py-4 sm:flexr sm:space-y-0 sm:space-x-6">
            <div class="text-center space-y-2 sm:text-left">
                <div class="space-y-0.5">
                    <p class="text-lg text-black font-semibold">
                        {{$post->user->name}}
                    </p>
                    <p class="text-gray-500 font-medium">
                        {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                    </p>
                    <p class="text-lg text-black font-semibold">
                        {{$post->body}}
                    </p>
                </div>
            <div class="flex">
                @can('update',$post)
                <form action="{{ route('posts.update',$post) }}" method="get">
                    @csrf
                    @method('UPDATE')
                    <button type="submit"
                        class="px-4 py-1 text-sm text-yellow-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-yellow-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Update</button>
                </form>
                @endcan
                @can('delete',$post)
                <form action="{{ route('posts.destroy',$post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-1 text-sm text-red-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-red-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Delete</button>
                </form>
                @endcan
                <form action="{{ route('posts.comment',$post) }}" method="get">
                    @csrf
                    <button type="submit"
                        class="px-4 py-1 text-sm text-red-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-red-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Commenter</button>
                </form>
            </div>
                @auth
                @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes',$post) }}" method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
                @else
                <form action="{{ route('posts.likes',$post) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-yellow-500">UnLike</button>
                </form>

                @endif
                @endauth
                <span>{{$post->likes->count()}} {{Str::plural('like',$post->likes->count())}}</span>
            </div>
        </div>
        @endforeach
        {{ $posts->links()}}
        @else
        <p>There are no posts</p>
        @endif

    </div>
</div>
@endsection
