<?php

namespace App\Http\Livewire\Admin\Support;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupportTicket;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $status = null;

    public $priority = null;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('admin.support.index', [
            'items' => SupportTicket::orderBy('id', 'desc')
                ->where('name', 'like', '%' . $this->search . '%')
                ->paginate()
        ])
            ->layout('admin.layout.primary');
    }
}
