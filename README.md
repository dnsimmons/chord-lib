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

![Chord](https://github.com/dnsimmons/chord-lib/blob/master/chord.png)

#### Rendering a tablature snippet

	require_once('ChordLib.php');
	$obj = new ChordLib();

	// Let's render a E Major chord as tablature
	$obj->renderTab(['0','2','2','1','0','0'], 300, 200);
	
![Tab](https://github.com/dnsimmons/chord-lib/blob/master/tab.png)
