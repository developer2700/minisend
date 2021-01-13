<?php

namespace App\Console\Commands;

use App\Models\Email;
use Illuminate\Console\Command;

class sendEmailToUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $pending_emails = Email::query()
            ->pending()
            ->get();
        foreach ($pending_emails as $email) {
            //set header
            $email_header = "From: " . $email->sender . ",\r\n";
            $email_header .= "Reply-To:" . $email->sender . "\r\n";
            $email_header .= "Return-Path: " . $email->sender . "\r\n";
            $email_header .= "MIME-Version: 1.0" . "\r\n";
            $email_header .= "Content-type:text/html;charset=utf-8" . "\r\n";

            $options = [
                "sender" => $email->sender,
                "subject" => $email->subject,
                "html" => $email->html ? :  $email->text
            ];
            $email_body = view('email', $options)->render();

            $result = @mail($email, $options['subject'], $email_body, $email_header);
            if ($result) {
                $email->status = 'Sent';
            } else {
                $email->status = 'Failed';
            }
            $email->save();
        }
    }
}
