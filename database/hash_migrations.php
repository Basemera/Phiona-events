<?php
require __DIR__."/migrations_list.php";
 class HashMigrations {
    public $migrations_array;
    private $stored_migrations_array;

    private function getMigrationsArray() {
        $file_contents = file_get_contents(__DIR__."/../migrations_list.json");
        return json_decode($file_contents, true);
    }

    public function __construct() {
        $this->stored_migrations_array = $this->getMigrationsArray();
        $this->migrations_array = $this->getMigrationsArray();

    }

    private function updateMigrationsArray() {
        $migration_array = json_encode($this->migrations_array);
        $migrations = file_put_contents(__DIR__."/../migrations_list.json", $migration_array);
        if ($migrations) {
            return true;
        } else {
            return false;
        }
    }

    public function checkForUpdate() {
        if ($this->stored_migrations_array === $this->migrations_array) {
            return;
        } else {
            return $this->updateMigrationsArray();
        }
    }

    private function hashFileContents($file) {
        $hash = hash_file("sha1", $file);
        if (!$hash) {
            throw new \ErrorException("File does not exist");
        }
        return $hash;
    }

    private function hashFileName($name) {
        $hash = hash("sha1", $name);
        if (!$hash) {
            throw new \ErrorException("File does not exist");
        }
        return $hash;
    }

    public function storeHash($file) {
        $hash_file_name = $this->hashFileName($file);
        $hash_content = $this->hashFileContents($file);
        $this->migrations_array[$hash_file_name] = $hash_content;
    }

    public function migrationExists($hash) {
        if (isset($this->migrations_array[$hash])) {
            return true;
        } else {
            return false;
        }
    }

    public function compareFileContents ($file) {
        $hash = $this->hashFileName($file);

        if (!$this->migrationExists($hash)) {
            throw new \ErrorException("Migration does not exist");
        }
        $new_file_content_hash = $this->hashFileContents($file);
        $old_file_content_hash = $this->migrations_array[$hash];
        if ($new_file_content_hash == $old_file_content_hash) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateFileContentsHash($file) {
        $hashed_file_name = $this->hashFileName($file);
        $hash_content = $this->hashFileContents($file);
        $this->migrations_array[$hashed_file_name] = $hash_content;
        return true;
    }
 }