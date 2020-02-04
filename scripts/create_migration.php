<?php

$opt = 't:';
$options = getopt($opt);
if (!$options) {
    echo "Migrations not created please provide a table name";
} else {
    $table_name = $options ? $options['t'] : "";

    $time = time();
    $date = date('Y_m_d');
    $time_stamp = $date . "_" . $time;
    $file_name = $time_stamp . "_create_" . $table_name . "_table.php";
    $table = ucwords($table_name);
    $migrate_table = "Create".$table."Table";
    
    $data = 
        "
            <?php
            require_once(__DIR__.'/../config.php');\n
            class " . $migrate_table . " {\n
                private function connection() {\n
                    \$connection = new PDOConfig();\n
                    if (\$connection === false) {\n
                        echo 'ERROR: Could not connect. mysqli_connect_error()';\n
                    }\n
                    return \$connection;\n
                }
    
                public function createTable() {\n
                    \$table_name = ". "  '$table_name'  " .";
                    \$sql = 'CREATE TABLE `$table_name` (\n
                    id INT AUTO_INCREMENT PRIMARY KEY,\n
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)';\n
                        try {\n
                            \$connection = \$this->connection();\n
                            \$statement = \$connection->prepare(\$sql);\n
                            \$statement->execute();\n
                            \$connection = null;\n
                            return true;
                        } catch (PDOException \$e) {\n
                            echo \$e->getMessage();\n
                            return false;
                        }  
                    }
    
                public function dropTable() {\n
                    \$table_name = ". "  '$table_name'  " .";
                    \$sql = 'DROP TABLE IF EXISTS `$table_name`';\n
                    try {\n
                        \$connection = \$this->connection();\n
                        \$statement = \$connection->prepare(\$sql);\n
                        \$statement->execute();\n
                        \$connection = null;\n
                        return true;
                    } catch (PDOException \$e) {\n
                        echo \$e->getMessage();\n
                        return false;
                    }  
                }
                }
            ?>
        "
    ;
    file_put_contents(__DIR__."/../migrations"."/".$file_name, $data);
}
?>