<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldBeUnique;

use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Queue\SerializesModels;

use App\Mail\sendCustomerMail;

use Mail;



class SendEmailJob implements ShouldQueue

{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $customerDetails;



    /**

     * Create a new job instance.

     *

     * @return void

     */

    public function __construct($customerDetails)

    {

        $this->customerDetails = $customerDetails;
    }



    /**

     * Execute the job.

     *

     * @return void

     */

    public function handle()

    {

        $email = new sendCustomerMail($this->customerDetails);

        Mail::to($this->customerDetails['email'])->send($email);
    }
}
