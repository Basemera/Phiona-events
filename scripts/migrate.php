<?php
require __DIR__."/../database/hash_migrations.php";
require __DIR__."../../migrations/2020_01_28_1580251805_create_venues_table.php";
require __DIR__."../../migrations/2020_01_29_1580256901_create_books_table.php";
require __DIR__."../../migrations/2020_01_28_1580250049_create_users_table.php";
require __DIR__."../../migrations/2020_01_29_1580262222_create_houses_table.php";
require __DIR__."../../migrations/2020_01_30_1580402897_create_teachers_table.php";
require __DIR__."../../migrations/2020_01_30_1580402811_create_subject_table.php";
require __DIR__."../../migrations/2020_01_30_1580418760_create_marks_table.php";

$opt = 'm:';
$options = getopt($opt);
$file_name = $options ? $options['m'] : "";
$migrations = [];
$hashed_migration = new HashMigrations();

if (!$options) {
    $migrations_files = array_diff(scandir((__DIR__."/../migrations")), ['..', '.']);
    foreach ($migrations_files as $migration_file) {
        $migration_file_path = __DIR__."../../migrations"."/".$migration_file;

        $file1 = preg_replace('/[0-9]/','',$migration_file);
        $file2 = explode("_", $file1);
        $file3 = implode(" ", $file2);
        $file4 = ucwords($file3);
        $file5 = str_replace(" ", "", $file4);
        $file6 = str_replace("php", "", $file5);
        $file7 = str_replace(".", "", $file6);
        $class_name = $file7;
        $class = new $class_name;
        
        if($hashed_migration->migrationExists($migration_file) && $hashed_migration->compareFileContents($migration_file)){
            continue;
        }
        elseif ($hashed_migration->migrationExists($migration_file) && !$hashed_migration->compareFileContents($migration_file)) {
            $created = $class->createTable();
            $hashed_migration->UpdateFileContentsHash($migration_file);
            echo "Migration ".$migration_file." has been run.";
            continue;
        }
        else{
            $created = $class->createTable();
            if ($created) {
                $hashed_migration->storeHash($migration_file_path);
                echo "Migration ".$migration_file." has been run.";
            } else {
                echo "Couldnot run migration". $migration_file ."";
            }
            continue;
        }
    }
} else {
    $migration_file = $file_name;
    $migration_file = __DIR__."../../migrations"."/".$migration_file;

    $file1 = preg_replace('/[0-9]/','',$migration_file);
    $file2 = explode("_", $file1);
    $file3 = implode(" ", $file2);
    $file4 = ucwords($file3);
    $file5 = str_replace(" ", "", $file4);
    $file6 = str_replace("php", "", $file5);
    $file7 = str_replace(".", "", $file6);
    $class_name = $file7;
    $class = new $class_name;

    if($hashed_migration->migrationExists($migration_file) && $hashed_migration->compareFileContents($migration_file)){
        return;
    }

    elseif ($hashed_migration->migrationExists($migration_file) && !$hashed_migration->compareFileContents($migration_file)) {
        $created = $class->createTable();
        $hashed_migration->UpdateFileContentsHash($migration_file);
        echo "Migration ".$migration_file." has been run.";
        return true;
    }

    else{
        $created = $class->createTable();
        if ($created) {
            $hashed_migration->storeHash($migration_file_path);
            echo "Migration ".$migration_file." has been run.";
            return true;
        } else {
            echo "Couldnot run migration". $migration_file ."";
        }
        return true;
    }
}

$hashed_migration->checkForUpdate();
