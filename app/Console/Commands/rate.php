<?php

namespace App\Console\Commands;

use App\Service\Rates\RateServiceInterface;
use DateTime;
use Illuminate\Console\Command;


class rate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:period {day=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected                    $description = 'Обновить курс за период';
    private RateServiceInterface $rateService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(RateServiceInterface $rateService)
    {
        parent::__construct();
        $this->rateService = $rateService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $countDay = (int)$this->argument('day');
        $now = (new DateTime())->setTime(23, 59, 59);
        $startDay = (clone $now)->modify("- $countDay day");

        while ($startDay < $now) {
            foreach ($this->rateService->getExternalRateOnDate($startDay) as $rateOnDate) {
                echo(
                    $startDay->format('Y-m-d') . "\t" .
                    $rateOnDate->getCurrency() . "\t" .
                    $rateOnDate->getRate() . "\n"
                );

                $this->rateService->saveOnDate($rateOnDate);
            }
            $startDay->modify('+1 day');
        }

    }
}
