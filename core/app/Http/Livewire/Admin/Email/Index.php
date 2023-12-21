<?php

namespace App\Http\Livewire\Admin\Email;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmailTemplate;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus($templateId, $status)
    {
        
        $template = EmailTemplate::where('id', $templateId)->update([
            'email_status' => $status == 0 ? 1 : 0
        ]);

        $this->emit('showToast', 'success', 'The data updated');

        $this->resetPage();
    }


    public function render()
    {
        return view('admin.email.index', [
            'templates' => EmailTemplate::where('name', 'LIKE', "%" . $this->search . "%")->paginate(15),
        ])->layout('admin.layout.primary');
    }
}
