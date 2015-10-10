<?php
/**
 * echoprintr
 *
 * A fancy print_r() that’s wrapped in htmlentities() and <xmp> tags.
 *
 * @type {String}
 */
echo '<xmp>$my_var: '. print_r( $my_var, true ) .'</xmp>';

/**
 * adminnotice
 *
 * Do your debugging in wp-admin using the all_admin_notices hook.
 * I use this when I’m not working in a file, or need to test some logic unrelated
 * to the file I’m working in. uses the ‘echoprintr’ snippet.
 */
add_action( 'all_admin_notices', 'testing_admin_notice' );
function testing_admin_notice() {
    echo '<div id="message" class="updated">';
        echo '<xmp>$my_var: '. print_r( $my_var, true ) .'</xmp>';
    echo '</div>';
}

/**
 * echovarexport
 *
 * var_export() is a gem I recently discovered that is similar to var_dump() and print_r(),
 * "with one exception: the returned representation is valid PHP code."
 * This is awesome because you can copy the output back into your code and use it as an array.
 * This snippet looks a bit gnarly because the default php implementation for var_export
 * has a few shortcomings if you’re not on the latest and greatest version of php.
 * The output is wrapped in and <xmp> tags for better readability.
 */

echo '<xmp>$my_var = '. str_replace( array( 'stdClass::__set_state', 'array (', "=> \n ", "=> \r " ), array( '(object) ', 'array(', '=>' ), var_export( $my_var, true ) ) .';</xmp>';

/**
 * emailme
 *
 * This snippet will use wp_mail() to send me an email with a print_r() of my variable.
 * This is handy if you’re in the deep recesses of some code and outputting to the screen
 * is next to impossible. Take it from experience, remember to remove it after running
 * your code the first time.
 * This snippet’s courtesy of @tw2113.
 */

wp_mail( 'you@youremail.com', '$my_var debug printout', print_r( $my_var, true) );

/**
 * safeprint
 *
 * This snippet is the same as echoprintr except it’s wrapped in a
 * if ( isset( $_GET['your-query-var-check'] ) )
 * conditional so that you can print something to the screen, but only if a query variable is met.
 * This is handy if you need to do some debugging on a production site. Not that you would ever
 * debug on a live production site…
 */

if ( isset( $_GET['debug'] ) ) {
    wp_die( '<xmp style="padding: 50px; background: #eee; color: #000;">$my_var: '. print_r( $my_var, true ) .'</xmp>' );
}

/**
 * errlog
 *
 * This snippet is useful if you have the code
 * define( 'WP_DEBUG_LOG', true);
 * in your WordPress wp-config file.
 * It will append your debug data to the end of your debug.log file (inside of wp-content).
 * Useful for debugging chunks of data that you don’t want to (or can’t) output to the screen.
 * Also saves your inbox from the emailme snippet. For ultimate geeky debugging happiness,
 * use the iTerm2 heads-up display (or any terminal app really), and from the command line, run:
 */

// Whee!!
// (comman-line): tail -f ~/YOUR-WORDPRESS-DIRECTORY/wp-content/debug.log

/**
 * todebuglog
 *
 * This snippet is similar to the errlog listed above, but is able to handle more data.
 * As you can see, you can also specify your own log file to send the output
 * (if you don’t want to clutter the debug.log, or want the data separate).
 * Again, to tail this file, from the command line, run:
 * tail -f ~/YOUR-WORDPRESS-DIRECTORY/wp-content/custom_debug.log
 */

file_put_contents( WP_CONTENT_DIR . '/custom_debug.log', "\n" . '$my_var: '. print_r( $my_var, true ), FILE_APPEND );

/**
 * wpdie
 *
 * This wraps the echoprintr snippet in a wp_die() call and stops the output to the screen
 * with your debug data. The closer you place it to the top of the screen, the better your
 * debug data will look. I use this one a TON when dealing with $_POST form data when I
 * want to stop the form from submitting.
 */

wp_die( '<xmp>$my_var: '. print_r( $my_var, true ) .'</xmp>' );

/**
 * memory_get_usage
 *
 * Shows the memory used in context
 */

$memory_before = memory_get_usage();
do_the_thing();
$kb_used = round( ( memory_get_usage() - $memory_before ) / 1024, 2 );
echo '<xmp>'. print_r( $kb_used . ' KB', true ) .'</xmp>';
