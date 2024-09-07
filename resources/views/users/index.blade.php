<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @session('success')
            <div x-data="{ isOpen: true }" x-show="isOpen" x-cloak class="relative flex flex-col sm:flex-row sm:items-center bg-green-300 dark:bg-green-700 shadow rounded-md py-5 pl-6 pr-8 sm_pr-6 mb-3 mt-3">
                <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
                    <div class="text-green-900 dark:text-gray-500">
                        <svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000.svg">
                         <path stroke-linecap="round" stroke-linejoin="round"
                         stroke-width="2" d="M9 1212 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path></svg>
                    </div>
                    <div class="text-sm font-medium ml3 dark:text-gray-100">Success!.</div>
                </div>
                <div class="text-sm tracking-wide text-gray-500 dark:text-white mt-4 sm:mt-0 sm:ml-4"> {{ $value }} </div>
                <div @click="isOpen = false" class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000.svg">
                </div>
            </div>
            @endsession
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID#
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Is Admin
                </th>
                <th scope="col" class="px-6 py-3">
                    Created At
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Block/Unblock
                </th>
                <th scope="col" class="px-6 py-3">
                    Blocked on
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->id }}
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $user->name }}
                </th>
                <td class="px-6 py-4">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->is_admin }}
                </td>
                <td class="px-6 py-4">
                    {{ $user->created_at->format('j M Y') }}
                </td>
                <td class="px-6 py-4 {{$user->isBanned() ? 'text-red-500' : 'text-blue-500' }}">
                    {{ $user->isBanned() ? 'Banned' : 'Active' }}
                </td>
                <td class="px-6 py-4">
                    @if($user->isBanned())
                        <form action="{{route('users.unblock', $user)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Unblock</button>
                        </form>
                    @else
                        <form action="{{route('users.block', $user)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit">Block</button>
                    </form>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($user->banned_at)
                    {{ $user->banned_at }}
                    @else
                    N/A
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

            </div>
        </div>
    </div>
</x-app-layout>
