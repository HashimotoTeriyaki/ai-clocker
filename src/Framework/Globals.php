<?php 

/**
 * Get header
 *
 * @return void
 */
function get_header($title = '', array $styles = []) {
    require_once PROJECT_ROOT . '/Templates/Header.php';
}

/**
 * Get footer
 *
 * @return void
 */
function get_footer() {
    require_once PROJECT_ROOT . '/Templates/Footer.php';
}

/**
 * Require view file
 *
 * @return void
 */
function view(string $view_name) {
   return function () use ($view_name) {
        require_once PROJECT_ROOT . '/Views/'. $view_name .'.php';
   };
}

function load_css(array $css_files) {
    if (empty($css_files)) {
        return;
    }
    foreach ($css_files as $file) {
        if (file_exists(PROJECT_ROOT . '/Styles/' . $file)) {
            echo '<link rel="stylesheet" href="src/Styles/' . $file . '">';
        } else {
            throw new Error('Linked css file does not exist');
        }
    }
}