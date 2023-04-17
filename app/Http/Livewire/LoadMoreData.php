<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class LoadMoreData extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $limitPerPage = 5;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }
    
    public function render()
    {
        if($this->limitPerPage){

            $posts = Post::paginate($this->limitPerPage);
        }
        return view('livewire.load-more-data',['posts' => $posts]);
    }
}
