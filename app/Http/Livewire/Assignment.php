<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Tag;

class Assignment extends Component
{
    public $selectedClass = null;
    public $selectedTag = [];
    public $tags = null;


    public function render()
    {
        return view('livewire.assignment', [
            'classes' => Category::all(),
        ]);
    }
    public function updatedSelectedClass($class_id)
    {
       $this->tags = Tag::where(['categorys_id' => $class_id])->get();
    }
}
