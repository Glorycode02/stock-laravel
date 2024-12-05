@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
        <h1 class="text-3xl font-bold text-center text-indigo-600 mb-8">Welcome Back</h1>

        @if(Session::has('fail'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('fail') }}</span>
        </div>
        @endif

        @if(Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ Session::get('success') }}</span>
        </div>
        @endif

        <form action="{{ route('loginUser') }}" method="post" class="space-y-6">
            @csrf
            <div>
                <label for="UserName" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" name="UserName" value="{{ old('UserName') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                <span class="text-red-500 text-xs">@error('UserName') {{ $message }} @enderror</span>
            </div>

            <div>
                <label for="Password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="Password"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                <span class="text-red-500 text-xs">@error('Password') {{ $message }} @enderror</span>
            </div>

            <div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Sign in
                </button>
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Not registered yet?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                Create an account
            </a>
        </p>
    </div>
</div>
@endsection