<?php

namespace App\Console\Commands;

use App\Models\PricingRule\PricingRuleModel;
use App\Traits\UserTrait;
use Illuminate\Console\Command;

class CheckPricingRuleExpirationDate extends Command {
    use UserTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckPricingRuleExpirationDate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        try{
            $todaysDate   = date('Y-m-d');
            $pricingRules = PricingRuleModel::where('status', $this->active)
                ->where('expiration_date', '=', $todaysDate)
                ->get();
            foreach ($pricingRules as $pricingRule) {
                $pricingRule->status = $this->deactive;
                $pricingRule->save();
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
