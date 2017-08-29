# ChordLib
Generate guitar chord boxes and tablature snippets with PHP and GD.

ChordLib generates its images from an array of supplied fingerboard markings where the arrays first element is the low E (thickest) string moving forwards one element per string. Each elements value in the array can be an integer from `0` to `5` where 0 denotes an open plucked string and 1 to 5 denotes a fretted note. Excluding a string is denoted by a `x`. 

ChordLib makes an assumption that the guitar fingerboard is for a 6 string guitar in standard tuning.

For example the following renders an A Minor chord:

	$chord = ['x','0','2','2','1','0'];



### Examples

#### Rendering a chord box

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's render a E Major chord as a chord box
	$obj->renderChord(['0','2','2','1','0','0'], 200, 300);

![Chord](https://github.com/dnsimmons/chord-lib/blob/master/examples/chord.png)

#### Rendering a tablature snippet for a chord

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's render a E Major chord as tablature
	$obj->renderTab(['0','2','2','1','0','0'], 300, 200);
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/tab.png)

#### Rendering a fingerboard pattern

	require_once('ChordLib.php');
	$obj = new ChordLib();

	$pattern = array(
		array('x','x','x','x','x','x'),
		array('x','2','2','2','x','2'),
		array('3','3','x','x','3','3'),
		array('x','x','4','4','x','x'),
		array('5','5','5','5','5','x'),
		array('x','x','x','x','x','x'),
		array('x','x','x','7','x','7'),
		array('x','x','x','x','8','x'),
		array('x','x','9','x','x','x'),
		array('x','10','x','x','x','x'),
		array('x','x','x','x','x','x'),
		array('x','x','x','12','x','x'),
	);

	// Let's render a fingerboard pattern for G Major
	$obj->renderPattern($pattern, 200);
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/pattern.png)


#### Rendering a tablature snippet for a score

	require_once('ChordLib.php');
	$obj = new ChordLib();

	$score = array(
		array('2','x','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','4','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','5','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','4','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','2','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('4','x','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('x','2','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('4','x','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('x','x','0','2','3','2'),
		array('x','x','x','4','5','4'),
	);

	// Let's render a small portion of the intro to Ozzy's Crazy Train
	$obj->renderScore($score, 160);
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/examples/score.png)