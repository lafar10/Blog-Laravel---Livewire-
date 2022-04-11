<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Posts extends Component
{
    use WithPagination,withFileUploads;


    public $modalShowStatus = false;
    public $modaldeleteStatus = false;
    public $modalUpdateStatus = false;

    public $title, $slug, $body, $image, $post_image_name, $post_image, $post_id;

    public function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|integer',
            'body' => 'required|string',
            'post_image' => 'required|max:1024',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function dataForm()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'body' => $this->body,
            'image' => $this->post_image_name,
        ];
    }

    public function storePost()
    {
        $this->validate();

        if($this->post_image != '')
        {
            $this->post_image_name = md5($this->post_image . microtime()). '.' . $this->post_image->extension();
            $this->post_image->storeAs('/',$this->post_image_name,'uploads');
        }

        Auth::user()->posts()->create($this->dataForm());

        $this->resetForm();

        $this->modalShowStatus = false;

        $this->alert('success', 'You are successful!', [
            'position'  =>  'center',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  'I am a subtext',
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    public function modalEdit($id)
    {
        $this->resetForm();
        $this->modalUpdateStatus = true;
        $this->post_id = $id;
        $this->loadDataUpdate();
    }

    public function UpdatePost()
    {
        $this->validate();

        $post = Post::where('id',$this->post_id)->first();

        if($this->post_image != '')
        {
            if($post->image != '')
            {
                if(File::exists('images/'.$post->image))
                {
                    unlink('images/'.$post->image);
                }
            }

            $this->post_image_name = md5($this->post_image.microtime()).'.'.$this->post_image->extension();
            $this->post_image->storeAs('/',$this->post_image_name,'uploads');
        }

        $post->update($this->dataForm());

        $this->resetForm();

        $this->modalUpdateShow();

        $this->alert('success', 'Post '.$post->title.' Updated With Successful!', [
            'position'  =>  'center',
            'timer'  =>  4000,
            'toast'  =>  true,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

    }

    public function DeletePost()
    {
        $post = Post::where('id',$this->post_id)->first();

        if($post->image != '')
        {
            if(File::exists('images/'.$post->image))
            {
                unlink('images/'.$post->image);
            }
        }

        $post->delete();

        $this->canModalDelete();

        $this->alert('success', 'Post '.$post->title.' Deleted With Successful!', [
            'position'  =>  'center',
            'timer'  =>  4000,
            'toast'  =>  true,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

    }

    public function loadDataUpdate()
    {
        $posts = Post::find($this->post_id);

        $this->title = $posts->title;
        $this->slug = $posts->slug;
        $this->body = $posts->body;
        $this->image = $posts->image;
    }

    public function all_posts()
    {
        return Post::orderBy('id','desc')->paginate(5);
    }

   public function modalShow()
    {
        $this->resetForm();
        $this->modalShowStatus = true;
    }

     public function modalUpdateShow()
    {
        $this->modalUpdateStatus = false;
    }

    public function modaldeleteStatus($id)
    {
        $this->modaldeleteStatus = true;
        $this->post_id = $id;
    }

    public function canModal()
    {
        $this->modalShowStatus = false;
    }

    public function canModalDelete()
    {
        $this->modaldeleteStatus = false;
    }

    public function resetForm()
    {
        $this->title = '';
        $this->slug = '';
        $this->body = '';
        $this->image = '';
        $this->post_image_name = '';
        $this->post_image = '';
    }

    public function render()
    {
        $posts = Post::where('user_id',auth()->user()->id)->orderBy('id')->paginate(5);

        return view('livewire.posts',[
            'posts' => $posts,
        ]);
    }
}
