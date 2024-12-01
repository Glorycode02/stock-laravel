@extends('layouts.app')
@section('content')
    <div class="flex flex-col items-center justify-center py-28 gap-5">
        @if (session('success'))
            <div class="alert-danger">
                {{ session('success') }}
            </div>
        @elseif (session('fail'))
            <div class="alert-danger">
                {{ session('fail') }}
            </div>
        @elseif (session('error'))
            @foreach (session('error') as $error)
            <div class="alert-danger">
                {{ $error }}
            </div>
                
            @endforeach
            <div class="alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-slate-900 font-bold">XYShop-Register</h1>
        <form action="{{ route('store') }}" method="post"
            class="flex flex-col items-center border border-slate-900 shadow-md rounded-md p-10 w-1/3 gap-4">
            @csrf
            @Method('POST')
            <div class="self-start flex gap-2 w-full">
                <label for="">UserName:</label>
                <input type="text" name="UserName" value="{{ old('UserName') }}"
                    class="outline-none border border-slate-500 rounded-md w-full" required>
            </div>
            <div class="self-start flex gap-2 w-full">
                <label for="">Password:</label>
                <input type="password" name="Password" value="{{ old('Password') }}"
                    class="outline-none border border-slate-500 rounded-md w-full" required>
            </div>
            <div class="self-start flex gap-2 w-full">
                <label for="">Confirm Password:</label>
                <input type="password" name="Cpass" value="{{ old('Cpass') }}"
                    class="outline-none border border-slate-500 rounded-md" required>
            </div>
            <input type="submit" value="Submit"
                class="p-2 w-full bg-blue-400 text-white rounded-md cursor-pointer hover:bg-blue-500">
        </form>
        <span>a Member? <a href="{{ route('login') }}" class="text-blue-500">Log in</a></span>
    </div>
@endsection
