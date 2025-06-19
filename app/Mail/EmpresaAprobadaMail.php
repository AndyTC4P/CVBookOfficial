<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmpresaAprobadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $empresa;

    public function __construct(User $empresa)
    {
        $this->empresa = $empresa;
    }

    public function build()
    {
        return $this->subject('¡Tu cuenta en CV Book Empresarial ha sido aprobada!')
                    ->view('emails.empresa-aprobada');
    }
}

