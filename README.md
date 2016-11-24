# po-translater
Translate po files with Google Translate

<h3>Usage</h3>
<pre>
include 'vendor/autoload.php';

use PoTranslater\PoTranslate;

$pt = new PoTranslate();
$pt->setPoFile('en_US.po')
	->setSource('tr')
	->setTarget('en')
	->parse()
	->translate()
	->save();

</pre>
