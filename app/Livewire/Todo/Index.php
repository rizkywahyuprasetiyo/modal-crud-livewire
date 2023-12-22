<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Todo')]
class Index extends Component
{
    public $modalStatus = 0;

    public $judul = '';
    public $deskripsi = '';

    public function rules()
    {
        return [
            'judul' => 'required|string|min:8|max:191',
            'deskripsi' => 'nullable|string'
        ];
    }

    public function openModal()
    {
        $this->modalStatus = true;
        $this->dispatch('modal-opened');
    }

    public function simpan()
    {
        $data = $this->validate();

        Todo::create($data);

        session()->flash('success', 'Task berhasil ditambahkan.');

        $this->reset();

        $this->dispatch('saved-data');
    }

    public function sudah(Todo $todo)
    {
        $todo->update(['status' => 'sudah']);

        session()->flash('success', 'Tugas berhasil diselesaikan.');
    }

    public function render()
    {
        $todos = Todo::get();
        return view('livewire.todo.index', compact('todos'));
    }
}
