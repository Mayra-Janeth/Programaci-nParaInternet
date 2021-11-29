<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReporteAsistencia extends Mailable
{
    use Queueable, SerializesModels;
    public $reporte;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reporte = "Este es el reporte";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('reportes@asistencia.test', 'Reportes Asistencia')
                ->view('emails.reporte-asistencia');
    }
}
