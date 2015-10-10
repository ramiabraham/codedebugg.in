/**
 * Various debugging methods from codedebugg.in
 */

/**
 * Logging arbitrary events with console.log
 * let's arbitrarily add a message to the console.log on certain conditions
 * @type {String}
 */

var something = 23;

	if ( something = ! 25 ) {

	//console.log( 'The taco fart is massive' );
	console.log( 'var something is not 25.' );
}

/**
* Let's throw an actual error if something is not an integer.
* @param {[type]} x [description]
* @param {[type]} y [description]
*/

function add(x,y){
	if( isNaN(x) || isNaN(y) ){
		throw new Error("OMG ERROR: I need numbers only k");
	} else {

		// ensure we're adding numbers, not concatenating numeric strings
		return (x * 1) + (y * 1);
	}
}

var a;

try {
	a = add(9);
} catch(e) {
	// throw an actual error here.
	console.error( e.message );
}

/**
 * The console offers a huge amount of debugging tools:
 *
 * console.time: Starts and stops a timer (string tag based), logs time (in ms) of intermediate code.
 *
 * console.table: Formats arrays and objects as tables, and allows sorting on columns.
 *
 * console.trace: Returns a stack trace for the function where it is called.
 *
 * console.memory: Returns a heap memory profile trace.
 *
 * console.profile, console.profileEnd: Starts and stops a specific event in the js runtime,
 * which is then accessible in the Chrome profiler
 *
 * console.timeline, console.timelineEnd: Similar to the profile creation method,
 * but adds extra information about the timeline in within the
 * Chrome timeline view.
 *
 * breakpoints: Pauses execution of code when an error is triggered, Set using the debugger; directive.
 *
 */

/**
 * console.table
 * This command logs any supplied data using a tabular layout.
 */

console.table([{a:1, b:2, c:3}, {a:"foo", b:false, c:undefined}]);
console.table([[1,2,3], [2,3,4]]);

/**
 * console.trace
 * The console object also supports outputting a stack trace; this will show you the call path taken to
 * reach the point at which you call console.trace
 */

foo();

function foo() {
  function bar() {
    console.trace();
  }
  bar();
}

/**
 * An example of a callback indicator, writing to a string.
 */

function Hello()
{
    alert("caller is " + arguments.callee.caller.toString());
}

/**
 * A stack-trace example
 */

function stackTrace() {
    var err = new Error();
    return err.stack;
}

/**
 * Debugger
 * When in the console, this will pause execution in the same manner
 * that the native breakpoint dev tool does.
 */

function debug_test() {
	console.log('execution started');
	debugger;
	console.log('execution stopped');
}
debug_test();

/**
 * PerformanceTiming interface
 *
 * Show the time elapsed between two events.
 */

function some_thing() {
  performance.now();
  do_thing();
  console.log (performance.now() );
}


/**
* BONUS - Memory leak checker
* See this great repo:
* https://github.com/Doist/JavaScript-memory-leak-checker
*/

// Runs with: MemoryLeakChecker(window);

/**
* BONUS - console.assert: Writes an error message to the console if the assertion is false.
* If the assertion is true, nothing will happen.
* Coming soon: https://developer.mozilla.org/en-US/docs/Web/API/Console/assert
*/
