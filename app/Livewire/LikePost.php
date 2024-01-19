<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikePost extends Component
{

    public $post;
    public $isLiked;
    public $fill;
    public $likes;

    public function mount($post){
        $this->isLiked = $post->checkLike(auth()->user());
        $this->likes = $post->likes->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like(){
        if ($this->post->checkLike(auth()->user())) {

            auth()->user()->likes->where('post_id', $this->post->id)->first()->delete();

            $this->isLiked = false;
            $this->likes--;

        }else{

            Like::create([
            'post_id' => $this->post->id,
            'user_id' => auth()->user()->id
            ]); 

            $this->isLiked = true;
            $this->likes++;
        }
    }
}
