<?php

namespace App\Http\Livewire\Admin\Email;

use Livewire\Component;
use App\Models\EmailTemplate;
use App\Models\GeneralSetting;

class EditTemplate extends Component
{

    public $template;
    protected $rules =
    [
        'template.email_body' => 'required|string|min:2',
        'template.email_status' => 'boolean',
    ];

    public function mount($templateId)
    {

        if ($templateId == 'master') {
            $this->template = [
                'name' => 'Master',
                'subj' => 'Master Email',
                'email_status' => true,
                'shortcodes' => ['message' => 'message'],
                'email_body' => GeneralSetting::first()->email_template,
            ];
        } else

            $this->template = EmailTemplate::where('id', $templateId)->first()->toArray();
    }

    public function cancelEdit()
    {
        return redirect()->route('moder.email.templates');
    }

    public function update()
    {
        

        if ($this->template['name'] == 'Master') {
            $setting = GeneralSetting::first();
            $setting->update([
                'email_template' => $this->template['email_body'],
            ]);
        } else {

            $this->validate();

            EmailTemplate::where('id', $this->template['id'])->update([
                'subj' => $this->template['subj'],
                'email_body' => $this->template['email_body'],
                'email_status' => $this->template['email_status'],
            ]);
        }
        $this->emit('showToast', 'info', __('The Templated saved!'));

        return redirect()->route('moder.email.templates');
    }

    public function render()
    {
        return view('admin.email.edit')
            ->layout('admin.layout.primary');
    }
}
