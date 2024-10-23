<?php

namespace App\Jobs;

use App\Exports\EmployeesExport;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportEmployeesJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $fileName;
    protected $startRow;

    /**
     * Create a new job instance.
     * @param string $fileName
     * @param int $startRow
     */
    public function __construct($fileName, $startRow)
    {
        $this->fileName = $fileName;
        $this->startRow = $startRow;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Excel::store(new EmployeesExport, $this->fileName, 'public');

        // Log the start of the job
        \Log::info('ExportEmployeesJob STARTED at: ' . now()->toDateTimeString() . ' for rows starting from: ' . $this->startRow);

        $start_time = Carbon::now()->getPreciseTimestamp(3);

        // Process the export chunk by chunk
        Excel::store(new EmployeesExport($this->startRow), $this->fileName, 'public');

        $end_time = Carbon::now()->getPreciseTimestamp(3);
        $delay = $end_time - $start_time;
        \Log::info("delay :" . $delay . " ms");

        // Log the completion of the job
        \Log::info('ExportEmployeesJob COMPLETED at: ' . now()->toDateTimeString() . ' for rows starting from: ' . $this->startRow);
    }
}
