<?php
/* default open options */
$options = array(
    'create_if_missing' => true,    // if the specified database didn't exist will create a new one
    'error_if_exists' => false,   // if the opened database exsits will throw exception
    'paranoid_checks' => false,
    'block_cache_size' => 1024 * 1024 * 32, //32M
    'write_buffer_size' => 1024 * 1024 * 128, //128M
    'block_size' => 4096,
    'max_open_files' => 1000,
    'block_restart_interval' => 16,
    'compression' => LEVELDB_SNAPPY_COMPRESSION,
    'comparator' => null,   // any callable parameter which returns 0, -1, 1
);
/* default readoptions */
$readoptions = array(
    'verify_check_sum' => false,
    'fill_cache' => true,
    'snapshot' => null
);
/* default write options */
$writeoptions = array(
    'sync' => false
);
$array = array(
    'root' => dirname(__DIR__) . '/data',
    'options' => $options,
    'readoptions' => $readoptions,
    'writeoptions' => $writeoptions,
);

return $array;