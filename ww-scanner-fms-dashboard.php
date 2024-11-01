<?php

if (!defined('ABSPATH')) {exit;} // Exit if accessed directly.

// Content of Dashboard
echo '<h2 class="fms-scannerfmslogo">Scanner FMS</h2>';

echo '<div class="fms-programwrapper">';

echo '<hr class="fms-linestd">';

// Выведем название текущей темы сайта
$my_current_theme = wp_get_theme();
echo '<p>' . '<div class="fms-themelgwrapper">' . '<div class="fms-themelogo dashicons-before dashicons-format-image"></div>' . '<span class="fms-themename">' . esc_html($my_current_theme->get( 'Name' )) . '</span>' . '</div>' . '</p>';

echo '<hr class="fms-linestd">';

// Получаем путь до директории шаблона
$path_to_the_theme = get_template_directory();

// Получаем массив файлов из директории
$files_in_the_theme = list_files( $path_to_the_theme );

// Вывод содержания массива
echo '<p class="fms-foundfiles">Found files:</p>';

// Сортировка массива
sort($files_in_the_theme);

echo '<div class="fms-filelistwrapper">';
echo '<div class="fms-listfiles"><span class="fms-listnumber">#</span><span class="fms-listfilename">Files</span><span class="fms-listsize">Size</span><span class="fms-listdate">Date</span></div>';
// Вывод файлов с размером и датой последнего изменения с помощью цикла форейч
foreach ($files_in_the_theme as $filename){
	$path_parts = pathinfo($filename);
		$number_file += 1;
        echo '<div class="fms-listfiles">' . '<span class="fms-listnumber">' . esc_html($number_file) . '</span>' . '<span class="fms-listfilename">' . esc_html($path_parts['basename']) . '</span>' . '<span class="fms-listsize">' . esc_html(filesize($filename)) . '</span>' . '<span class="fms-listdate">' . esc_html(date ("d.m.y H:i:s", filemtime($filename))) . '</span>' . '</div>';
	
	$summ_file_size += filesize($filename); // Конкатенация размеров файлов
}
echo '</div>';

// Подсчитываем число объектов в массиве
$sum_file_objects = count($files_in_the_theme);
// Выводим число объектов в массиве
echo '<p> Total files:' . '<span class="fms-totalfilessum">' . esc_html($sum_file_objects) . '</span>' . '<span class="fms-totalsize"> ' . esc_html($summ_file_size) . ' Bytes' . ' / ' . number_format(esc_html($summ_file_size) / 1024, 2) . ' KB' . ' / ' . number_format(esc_html($summ_file_size) / 1048576, 2) . ' MB</span>' . '</p>';

echo '<hr class="fms-linestd">';

// Кнопка для запуска скрипта
echo '<form method="post"><input class="fms-startscanner" type="submit" name="scanFmsStart" id="scanFmsStart" value="Start Scanner" /><br/></form>';
function sfms_scan_start(){
	global $path_to_the_theme;
	global $files_in_the_theme;
	include( plugin_dir_path( __FILE__ ) . 'ww-scanner-start.php');
}
if(array_key_exists('scanFmsStart',$_POST)){
	sfms_scan_start();
}

echo '<hr class="fms-linechksum">';

echo '<details class="fms-details"><summary class="fms-summary">What is the scanner looking for?</summary><p>base64, eval, mkdir, shell_exec, chmod, system, passthru, fromCharCode, auth_pass, FilesMan, try{document.body, passwd, ="";function, e2aa4e, md5=, rot13</p></details>';

echo '</div>';

?>