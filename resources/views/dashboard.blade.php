<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Send New Campaign</h3>
                                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">

                                @if($errors)

                                    @foreach($errors->all() as $error)
                                        <span style="color: red">{{$error}}</span><br>
                                    @endforeach
                                @endif
                                <form action="{{route('send-email')}}" method="POST">
                                    @csrf
                                    <div class="overflow-hidden shadow sm:rounded-md">
                                        <div class="bg-white px-4 py-5 sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-3">
                                                    <label for="country" class="block text-sm font-medium text-gray-700">Select List</label>
                                                    <select name="list_id" autocomplete="country-name" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                        <option value="">Select a list</option>
                                                        @foreach($lists as $list)
                                                            <option value="{{$list['id']}}">{{$list['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="street-address" class="block text-sm font-medium text-gray-700">Subject</label>
                                                    <input type="text" name="subject" value="{{old('subject')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></input>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="street-address" class="block text-sm font-medium text-gray-700">Sender</label>
                                                    <input type="text" name="sender" value="{{old('sender')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></input>
                                                </div>

                                                <div class="col-span-6">
                                                    <label for="street-address" class="block text-sm font-medium text-gray-700">Email Content</label>
                                                    <textarea style="height: 400px" name="htmlContent" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{old('htmlContent')}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
