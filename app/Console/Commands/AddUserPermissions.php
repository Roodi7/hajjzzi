<?php

namespace App\Console\Commands;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddUserPermissions extends Command
{
    protected $signature = 'user:add-permission 
    {prefix} 
    {ar_name?}';
    protected $description = 'Add permission to user table';

    public function handle()
    {
        $prefix = $this->argument('prefix');
        $ar_name = $this->argument('ar_name') ?? $prefix;

        if (empty($prefix)) {
            $this->error('Invalid prefix. Please provide a prefix.');
            return;
        }



        $suffixes = ['index', 'create', 'edit', 'delete'];
        $ar_suffixes = ['عرض', 'إضافة', 'تعديل', 'حذف'];

        $migrationUpdates = '';
        $createView = '<div class="col-md-4">
        <input id="' . $prefix . '_group" class="form-check-input me-1" type="checkbox">
        <label style="font-weight: bold;" class="form-check-label" for="' . $prefix . '_group">إدارة' . $ar_name . '</label>
        <ul>';

        $editView = '<div class="col-md-4">
        <input id="' . $prefix . '_group" class="form-check-input me-1" type="checkbox">
        <label style="font-weight: bold;" class="form-check-label" for="' . $prefix . '_group">إدارة' . $ar_name . '</label>
        <ul>';

        // Create a migration file
        $migrationName = 'add_' . $prefix . '_columns_to_users_table';
        $this->call('make:migration', [
            'name' => $migrationName
        ]);
        $migrationPath = $this->getMigrationFilePath($migrationName);


        foreach ($suffixes as $index => $suffix) {
            $columnName = $prefix . '_' . $suffix;

            // Check if the column already exists in the users table
            if (!Schema::hasColumn('users', $columnName)) {
                $this->info("Adding $columnName column to the users table...");

                // Add the column to the users table
                Schema::table('users', function (Blueprint $table) use ($columnName) {
                    $table->boolean($columnName)->default(0);
                });

                $migrationUpdates .= "\$table->boolean('$columnName')->default(0);\n";
                $createView .= '
                <li class="mt-2">
                    <input class="form-check-input coastcenter me-1" name="' . $columnName . '" id="' . $columnName . '" type="checkbox" value="' . $columnName . '">
                            <label class="form-check-label" for="' . $columnName . '">' . $ar_suffixes[$index] . " " . $ar_name . '</label>
                </li>
                ';

                $editView .= '
                <li class="mt-2">
                    <input @if ($user->' . $columnName . ')
                    checked @endif class="form-check-input coastcenter me-1" name="' . $columnName . '" id="' . $columnName . '" type="checkbox" value="' . $columnName . '">
                            <label class="form-check-label" for="' . $columnName . '">' . $ar_suffixes[$index] . " " . $ar_name . '</label>
                </li>
                ';

                $this->info("Column $columnName added to the users table successfully.");
            } else {
                $this->info("The $columnName column already exists in the users table.");
            }

            // Add the column to the fillable property in the User model
            $this->updateUserModel($columnName);
        }
        $this->updateMigrationFile($migrationPath, $migrationUpdates);



        $createView .= '</ul></div>';
        $editView .= '</ul></div>';

        $this->saveMigrationUpdatesToFile($migrationUpdates, $prefix);
        $this->createUserCreateCheckboxes($createView, $prefix);
        $this->createUserEditCheckboxes($editView, $prefix);

        $this->info('Customization completed!');
    }


    protected function updateUserModel($columnName)
    {
        $userModelPath = app_path('Models\Permission.php');
        $this->info('Model Path :' . $userModelPath);

        if (file_exists($userModelPath)) {
            $this->info('Updating User model...');

            $modelContent = file_get_contents($userModelPath);

            // Add the column to the $fillable property
            if (strpos($modelContent, "'$columnName'") === false) {
                $fillablePosition = strpos($modelContent, 'protected $fillable');
                $modelContent = substr_replace($modelContent, "'$columnName',", $fillablePosition + 26, 0);
                file_put_contents($userModelPath, $modelContent);
                $this->info("User model updated successfully with $columnName.");
            } else {
                $this->info("The $columnName attribute is already present in the User model.");
            }
        } else {
            $this->error('User model not found. Make sure the User.php file exists in the app directory.');
        }
    }

    protected function saveMigrationUpdatesToFile($migrationUpdates, $columnName)
    {
        $folderPath = base_path('user_permission_updates');
        $filePath = $folderPath . '/migration_updates_' . $columnName . '.txt';

        if (!is_dir($folderPath)) {
            mkdir($folderPath);
        }

        File::put($filePath, $migrationUpdates);
        $this->info('Migration updates saved to: ' . $filePath);
    }

    protected function createUserCreateCheckboxes($createCheckboxesView, $columnName)
    {
        $folderPath = base_path('user_permission_updates');
        $filePath = $folderPath . '/create_checkboxes_view_' . $columnName . '.txt';

        if (!is_dir($folderPath)) {
            mkdir($folderPath);
        }

        File::put($filePath, $createCheckboxesView);
        $this->info('View saved to: ' . $filePath);
    }

    protected function createUserEditCheckboxes($editCheckboxesView, $columnName)
    {
        $folderPath = base_path('user_permission_updates');
        $filePath = $folderPath . '/edit_checkboxes_view_' . $columnName . '.txt';

        if (!is_dir($folderPath)) {
            mkdir($folderPath);
        }

        File::put($filePath, $editCheckboxesView);
        $this->info('View saved to: ' . $filePath);
    }



    protected function getMigrationFilePath($migrationName)
    {
        $migrationFiles = glob(database_path('migrations/*_' . $migrationName . '.php'));

        if (count($migrationFiles) > 0) {
            return $migrationFiles[0];
        }

        return null;
    }

    protected function updateMigrationFile($migrationPath, $migrationUpdates)
    {
        if (!is_null($migrationPath)) {
            $migrationContent = file_get_contents($migrationPath);

            $upFunctionPosition = strpos($migrationContent, "Schema::table('permissions', function (Blueprint \$table) {");
            $migrationContent = substr_replace($migrationContent, $migrationUpdates, $upFunctionPosition + 55, 0);

            file_put_contents($migrationPath, $migrationContent);

            $this->info("Migration file updated successfully");
        } else {
            $this->error('Migration file not found');
        }
    }

}
