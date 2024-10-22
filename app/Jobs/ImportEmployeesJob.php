<?php

namespace App\Jobs;

use App\Imports\EmployeeImport;
use Illuminate\Container\Attributes\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ImportEmployeesJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Excel::import(new EmployeeImport, $this->filePath);
        } catch (\Exception $e) {
            \Log::error('Error importing employees: ' . $e->getMessage(), [
                'filePath' => $this->filePath
            ]);
        }
    }
}
