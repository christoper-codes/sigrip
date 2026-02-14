<?php

namespace App\Livewire\Ticket;

use Livewire\Component;

class Link extends Component
{

   public function shareTicketLink(int $id): void
    {
        $application = Application::find($id);
        $this->form->slug = $application->slug;
        $this->form->url_qr = route('application.show', ['slug' => $this->form->slug]);

        Flux::modal('index-qr-application-modal')->show();
    }


    public function render()
    {
        return view('livewire.ticket.link');
    }
}
