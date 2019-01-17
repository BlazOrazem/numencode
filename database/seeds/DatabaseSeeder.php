<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DatabaseSeeder extends Seeder
{
    use DatabaseTransactions;

    /**
     * Database tables.
     *
     * @var array
     */
    private $tables = [
        'codelist_group',
        'codelist_item',
        'managers',
        'users',
        'roles',
        'permissions',
        'role_permission',
        'role_user',
        'role_manager',
        'menus',
        'languages',
        'pages',
        'pages_i18n',
        'routes',
        'routes_i18n',
        'contents',
        'contents_i18n',
        'plugins',
        'tasks',
        'tasks_i18n',
        'blog_category',
        'blog_category_i18n',
        'blog_item',
        'blog_item_i18n',
        'blog_item_comment',
        'blog_item_comment_i18n',
        'promotion_category',
        'promotion_category_i18n',
        'promotion_item',
        'promotion_item_i18n',
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info(PHP_EOL . 'Cleaning up the database...');
        $this->command->line('---------------------------');

        $this->cleanDatabase();

        $this->command->line(PHP_EOL . 'Database tables are truncated.' . PHP_EOL);
        $this->command->info('Running the seeders...');
        $this->command->line('----------------------');

        $this->runSeeders();

        $this->command->line(PHP_EOL . 'Database seeding completed.' . PHP_EOL);
        $this->command->info('Importing translations to database...');
        $this->command->line('-------------------------------------');

        Artisan::call('lang:import');

        $this->command->line('Dictionary was successfully imported.');
        $this->command->line('-------------------------------------' . PHP_EOL);
    }

    /**
     * Truncate tables
     */
    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
            $this->command->info('Table ' . $tableName . ' truncated.');
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Run database seeders
     */
    protected function runSeeders()
    {
        $this->call(RoutesTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(RoleManagerTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(ContentsTableSeeder::class);
        $this->call(PluginsTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(CodelistTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(BlogTableSeeder::class);
        $this->call(PromotionTableSeeder::class);
    }
}
