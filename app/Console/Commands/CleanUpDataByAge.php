<?php namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

use DB, Log;


class CleanUpDatabyAge extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $signature = 'clean:data {days=1095 : Days to keep (default = 3 years)}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete old data from users_action_log';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// Clean up data base on the days user wants to keep
		$input=$this->argument('days');
		
		$d=Carbon::now()->subDays($input);

		$result = DB::table('users_actions_log')->where('created_at', '<', $d)->delete();

		$this->info('The command was executed successfully ' .  $d . ' -- Rows Deleted:' . $result);

		Log::Info ('Clean Up User Action Log Table ' . ' -- Rows Deleted:' . $result);

		return $result;

	}


}
