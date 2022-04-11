 {{-- Model add --}}
 <x-jet-dialog-modal wire:model="modalShowStatus">
     <x-slot name="title">
         {{ __('Create New Post') }}
     </x-slot>

     <x-slot name="content">
         <div class="mt-2">
             <x-jet-label value="{{ __('Title') }}"></x-jet-label>
             <x-jet-input type="text" id="title" wire:model="title"></x-jet-input>
             @error('title')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Slug') }}"></x-jet-label>
             <x-jet-input type="text" id="slug" wire:model="slug"></x-jet-input>
             @error('slug')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Content') }}"></x-jet-label>
             <textarea cols="30" rows="5" wire:model="body"></textarea>
             @error('body')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Image') }}"></x-jet-label>
             @if ($post_image)
                 <div>
                     <img src="{{ $post_image->temporaryUrl() }}" style="width:55px;height:50px;" alt="" />
                 </div>
             @endif
             <input type="file" wire:model="post_image" class="file:border file:border-solid" />
             @error('post_image')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
     </x-slot>

     <x-slot name="footer">
         <x-jet-secondary-button wire:click="canModal">
             {{ __('Cancel') }}
         </x-jet-secondary-button>
         &nbsp;
         <x-jet-button type="submit" wire:click="storePost">
             {{ __('Create') }}
         </x-jet-button>
     </x-slot>
 </x-jet-dialog-modal>

 {{-- Model update --}}
 <x-jet-dialog-modal wire:model="modalUpdateStatus">
     <x-slot name="title">
         {{ __('Update Post') }}
     </x-slot>

     <x-slot name="content">
         <div class="mt-2">
             <x-jet-label value="{{ __('Title') }}"></x-jet-label>
             <x-jet-input type="text" id="title" wire:model="title"></x-jet-input>
             @error('title')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Slug') }}"></x-jet-label>
             <x-jet-input type="text" id="slug" wire:model="slug"></x-jet-input>
             @error('slug')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Content') }}"></x-jet-label>
             <textarea cols="30" rows="5" wire:model="body"></textarea>
             @error('body')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
         <div class="mt-4">
             <x-jet-label value="{{ __('Image') }}"></x-jet-label>
             @if ($image)
                 <div>
                     <img src="{{ asset('images/' . $image) }}" style="width:55px;height:50px;" alt="" />
                 </div>
             @endif
             @if ($post_image)
                 <div>
                     <img src="{{ $post_image->temporaryUrl() }}" style="width:55px;height:50px;" alt="" />
                 </div>
             @endif
             <input type="file" wire:model="post_image" class="file:border file:border-solid" />
             @error('post_image')
                 <span class="text-red">{{ $message }}</span>
             @enderror
         </div>
     </x-slot>

     <x-slot name="footer">
         <x-jet-secondary-button wire:click="modalUpdateShow">
             {{ __('Cancel') }}
         </x-jet-secondary-button>
         &nbsp;
         <x-jet-button type="submit" wire:click="UpdatePost">
             {{ __('Update') }}
         </x-jet-button>
     </x-slot>
 </x-jet-dialog-modal>

 {{-- Model delete --}}
 <x-jet-dialog-modal wire:model="modaldeleteStatus">
     <x-slot name="title">
         {{ __('Are you sure !?') }}
     </x-slot>

     <x-slot name="content">
         {{ __('Click Delete To Delete row') }}
     </x-slot>

     <x-slot name="footer">
         <x-jet-secondary-button wire:click="canModalDelete">
             {{ __('Cancel') }}
         </x-jet-secondary-button>
         &nbsp;
         <x-jet-danger-button wire:click="DeletePost" >
             {{ __('Delete') }}
         </x-jet-danger-button>
     </x-slot>
 </x-jet-dialog-modal>
