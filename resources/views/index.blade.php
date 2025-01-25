@extends('layout.app')

@section('section')
<section class="font-opens">
    @if (session('success'))
    <div id="alert-3" class="flex mx-4 p-4 mb-4 text-green-800 border-2 border-green-300 rounded-lg bg-green-50 "
        role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium">
            {{ session('success') }}
        </div>
        <button type="button"
            class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8  dark:hover:bg-gray-700"
            data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    @endif
    <div class="flex flex-col  justify-center px-4 mx-auto  md:w-[700px] ">
        <div id="card-container">
            <div class="w-full rounded-lg overflow-hidden bg-white shadow-2xl">
                <div class="flex space-x-4 p-4 mt-2">
                    <div class="flex-shrink-0">
                        <img class="w-20 h-20 rounded-full" src="{{ asset('images/user_default.jpg') }}">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold truncate text-gray-400">Welcome,</h3>
                        <p class="text-lg font-extrabold text-slate-800 truncate">
                            {{ auth()->user()->customer_name }}
                        </p>
                        <div class="flex flex-col">
                            <p class="text-sm text-slate-600 truncate">
                                {{ auth()->user()->customer_email }}
                            </p>
                            <p class="text-sm text-slate-600 truncate">
                                {{ auth()->user()->customer_phone }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex gap-4 p-4">
                    <a href="{{ route('subscriptions') }}"
                        class="w-full px-5 py-2.5 text-white bg-orange-maxnet hover:bg-opacity-80 focus:ring-2 focus:outline-none focus:ring-red-300 font-medium rounded-md text-xs text-center md:text-sm">My
                        Subscription</a>
                    <a href="{{ route('invoices') }}"
                        class="w-full px-5 py-2.5 text-white bg-gold-maxnet hover:bg-opacity-80 focus:ring-2 focus:outline-none focus:ring-yellow-300 font-medium rounded-md text-xs text-center md:text-sm">My
                        Invoice</a>
                </div>
                <div class="flex justify-between py-3 px-6 bg-gray-200">
                    <h3 class="text-sm">{{ $count_subs }} Subscription</h3>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection