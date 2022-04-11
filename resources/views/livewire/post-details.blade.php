
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <img src="{{asset('images/'.$image)}}" style="width:400px;height:250px;" >
                <br>
                <h6>{{$created_at}}</h6>
                <br>
                <p>{{$body}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
