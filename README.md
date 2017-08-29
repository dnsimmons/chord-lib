# ChordLib
Generate guitar chord boxes and tablature snippets with PHP and GD.

ChordLib generates its images from an array of supplied fingerboard markings where the arrays first element is the low E (thickest) string moving forwards one element per string. Each elements value in the array can be an integer from `0` to `5` where 0 denotes an open plucked string and 1 to 5 denotes a fretted note. Excluding a string is denoted by a `x`. 

ChordLib makes an assumption that the guitar fingerboard is for a 6 string guitar in standard tuning.

For example the following renders an A Minor chord:

	$chord = ['x','0','2','2','1','0'];



### Examples

#### Chord Boxes

The `renderChord` method will output a PNG image depicting a standard 6 string guitar chord box with a given fingerboard pattern defined as an array:

	['E','A','D','G','B','E']

##### Example

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's render a E Major chord as a chord box with a image width of 200px and a height of 300px
	$obj->renderChord(['0','2','2','1','0','0'], 200, 300);

##### Output

![Chord](https://github.com/dnsimmons/chord-lib/blob/master/examples/chord.png)

#### Chord Tablature

The `renderTab` method will output a PNG image depicting a standard 6 string guitar tablature chord snippet with a given fingerboard pattern defined as an array:


	['E','A','D','G','B','E']

##### Example

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's render a E Major chord as tablature with a image width of 300px and a height of 200px
	$obj->renderTab(['0','2','2','1','0','0'], 300, 200);

##### Output
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/tab.png)

#### Fingerboard Patterns

The `renderPattern` method will output a PNG image depicting a standard 6 string guitar fingerboard up to the 12th fret with a given fingerboard pattern defined by a nested set of arrays:

	[
		['E','A','D','G','B','E'], <-- first fret
		['E','A','D','G','B','E'], <-- second fret
		['E','A','D','G','B','E']  <-- third fret
		...
	]


##### Example

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's define a simple G Major scale pattern.
	$pattern = [
		['x','x','x','x','x','x'],
		['x','2','2','2','x','2'],
		['3','3','x','x','3','3'],
		['x','x','4','4','x','x'],
		['5','5','5','5','5','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
	];

	$options = [
		'color_text' => '#aa0000'
	];

	// Render the pattern and change the marker text color just for fun.
	$obj->renderPattern($pattern, $options);

##### Output
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/pattern.png)


#### Tablature Scores

The `renderScore` method will output a PNG image depicting a standard 6 string guitar tablature score with a given fingerboard pattern defined by a nested set of arrays:

	[
		['E','A','D','G','B','E'], <-- first note(s)
		['E','A','D','G','B','E'], <-- second note(s)
		['E','A','D','G','B','E']  <-- third note(s)
		...
	]


##### Example

	require_once('ChordLib.php');
	$obj = new ChordLib();

	$score = [
		['2','x','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','4','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','5','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','4','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','2','x','x','x','x'],
		['x','0','x','x','x','x'],
		['4','x','x','x','x','x'],
		['x','0','x','x','x','x'],
		['x','2','x','x','x','x'],
		['x','0','x','x','x','x'],
		['4','x','x','x','x','x'],
		['x','0','x','x','x','x'],
		['x','x','0','2','3','2'],
		['x','x','x','4','5','4']
	];

	// Let's render a small portion of the intro to Ozzy's Crazy Train with a image height of 200px
	$obj->renderScore($score, 200);

##### Output
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/score.png)