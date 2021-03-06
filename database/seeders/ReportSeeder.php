<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;
use DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $reports = [
            ['id' => 1, 'title' => 'Отчёт за 17 Января', 'desc' => 'Содержание отчёта за 17 Января', 'user_id' => '1', 'created_at' => '2022-01-17 06:26:08', 'updated_at' => '2022-01-17 06:26:08'],
            ['id' => 2, 'title' => 'Отчёт за 17 Января', 'desc' => 'Содержание отчёта за 17 Января', 'user_id' => '1', 'created_at' => '2022-01-17 06:26:08', 'updated_at' => '2022-01-17 06:26:08'],
            ['id' => 3, 'title' => 'Отчёт за 17 Января', 'desc' => 'Содержание отчёта за 17 Января', 'user_id' => '1', 'created_at' => '2022-01-17 06:26:08', 'updated_at' => '2022-01-17 06:26:08'],
            ['id' => 4, 'title' => 'Отчёт за 23 Января', 'desc' => 'Содержание отчёта за 23 Января', 'user_id' => '2', 'created_at' => '2022-01-23 06:26:08', 'updated_at' => '2022-01-23 06:26:08'],
            ['id' => 5, 'title' => 'Отчёт за 23 Января', 'desc' => 'Содержание отчёта за 23 Января', 'user_id' => '2', 'created_at' => '2022-01-23 06:26:08', 'updated_at' => '2022-01-23 06:26:08'],
            ['id' => 6, 'title' => 'Отчёт за 25 Января', 'desc' => 'Содержание отчёта за 25 Января', 'user_id' => '10', 'created_at' => '2022-01-25 06:26:08', 'updated_at' => '2022-01-25 06:26:08'],
            ['id' => 7, 'title' => 'Отчёт за 25 Января', 'desc' => 'Содержание отчёта за 25 Января', 'user_id' => '13', 'created_at' => '2022-01-25 06:26:08', 'updated_at' => '2022-01-25 06:26:08'],
            ['id' => 8, 'title' => 'Отчёт за 27 Января', 'desc' => 'Содержание отчёта за 27 Января', 'user_id' => '13', 'created_at' => '2022-01-27 06:26:08', 'updated_at' => '2022-01-27 06:26:08'],
            ['id' => 9, 'title' => 'Отчёт за 28 Января', 'desc' => 'Содержание отчёта за 28 Января', 'user_id' => '3', 'created_at' => '2022-01-28 06:26:08', 'updated_at' => '2022-01-28 06:26:08'],
            ['id' => 10, 'title' => 'Отчёт за 28 Января', 'desc' => 'Содержание отчёта за 28 Января', 'user_id' => '3', 'created_at' => '2022-01-28 06:26:08', 'updated_at' => '2022-01-28 06:26:08'],
            ['id' => 11, 'title' => 'Отчёт за 28 Января', 'desc' => 'Содержание отчёта за 28 Января', 'user_id' => '3', 'created_at' => '2022-01-28 06:26:08', 'updated_at' => '2022-01-28 06:26:08'],
            ['id' => 12, 'title' => 'Отчёт за 1 Февраля', 'desc' => 'Содержание отчёта за 1 Февраля', 'user_id' => '12', 'created_at' => '2022-02-01 06:26:08', 'updated_at' => '2022-02-01 06:26:08'],
            ['id' => 13, 'title' => 'Отчёт за 3 Февраля', 'desc' => 'Содержание отчёта за 3 Февраля', 'user_id' => '15', 'created_at' => '2022-02-03 06:26:08', 'updated_at' => '2022-02-03 06:26:08'],
            ['id' => 14, 'title' => 'Отчёт за 10 Февраля', 'desc' => 'Содержание отчёта за 10 Февраля', 'user_id' => '14', 'created_at' => '2022-02-10 06:26:08', 'updated_at' => '2022-02-10 06:26:08'],
            ['id' => 15, 'title' => 'Отчёт за 10 Февраля', 'desc' => 'Содержание отчёта за 10 Февраля', 'user_id' => '12', 'created_at' => '2022-02-10 06:26:08', 'updated_at' => '2022-02-10 06:26:08'],
        ];

        foreach($reports as $report){
            Report::create($report);
        }

    }
}
