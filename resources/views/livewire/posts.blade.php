<div>

    @include('livewire.modal')
    <div class="flex items-center justify-end py-4 text-right">
        <x-jet-danger-button wire:click="modalShow">
            {{ __('Create Post') }}
        </x-jet-danger-button>
    </div>

    <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="bg-current-50">
            @forelse ($posts as $post)
                <tr>
                    <td class="p-3 text-md text-gray-700">{{ $post->id }}</td>
                    <td class="w-30 p-3 text-md text-gray-700">
                        <a href="{{route('postsdetails',$post->slug)}}">
                            {{ $post->title }}
                        </a>
                    </td>
                    <td class="w-30 p-3 text-md text-gray-700">
                        <textarea>{{ $post->body }}</textarea>
                    </td>
                    <td class="p-3 text-md text-gray-700"><img src="{{ asset('images/' . $post->image) }}"
                            style="width:155px;height:120px;" alt=""></td>
                    <td class="p-3 text-md text-gray-700">

                        <x-jet-button wire:click="modalEdit({{ $post->id }})">
                            {{ __('Edit') }}
                        </x-jet-button>
                        <x-jet-danger-button wire:click="modaldeleteStatus({{ $post->id }})" >
                            {{ __('Delete') }}
                        </x-jet-danger-button>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        No Records Found !!
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="py-2">
        {{ $posts->links() }}
    </div>





</div>
