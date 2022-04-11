<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostDetails extends Component
{
    public $title, $body, $slug, $image, $created_at;

    public function mount($slug)
    {
        $post = Post::where('slug',$slug)->first();

        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->body = $post->body;
        $this->image = $post->image;
        $this->created_at = $post->created_at;
    }

    public function render()
    {
        return view('livewire.post-details')->layout('layouts.app');
    }
}
