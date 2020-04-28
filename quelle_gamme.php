

<?php

// Gammes de Do
$TGammeChromatique = array('C', 'C#', 'D', 'D#', 'E', 'F', 'F#', 'G', 'G#', 'A', 'A#', 'B');

// récupération gammes majeures, intervalles : 2212221
foreach ($TGammeChromatique as $k=>$note) {
	$TGammeMajeure[$note] = array(
								$note
								, $TGammeChromatique[($k+2)%12]
								, $TGammeChromatique[($k+4)%12]
								, $TGammeChromatique[($k+5)%12]
								, $TGammeChromatique[($k+7)%12]
								, $TGammeChromatique[($k+9)%12]
								, $TGammeChromatique[($k+11)%12]
								, $note
								);
	$TGammeMineure[$note] = array(
								$note
								, $TGammeChromatique[($k+2)%12]
								, $TGammeChromatique[($k+3)%12]
								, $TGammeChromatique[($k+5)%12]
								, $TGammeChromatique[($k+7)%12]
								, $TGammeChromatique[($k+8)%12]
								, $TGammeChromatique[($k+10)%12]
								, $note
								);
}

if(!empty($_REQUEST['print_all_gammes'])) {
	// Affichage des gammes majeures :
	foreach ($TGammeMajeure as $k => $v) {
		print '<h3>Gamme Majeure de '.$k.' : </h3>';
		printPiano($TGammeChromatique, $v);
	}

	// Affichage des gammes mienures naturelles :
	foreach ($TGammeMineure as $k => $v) {
		print '<h3>Gamme Mineure Naturelle de '.$k.' : </h3>';
		printPiano($TGammeChromatique, $v);
	}
}

print '<br />';



function printPiano($TGammeChromatique, $TGammeToCheck=array()) {
	print '<table >';

	print '<tr >';
	foreach ($TGammeChromatique as $k => $v) {
		print '<td>'.$v.'</td>';
	}
	print '</tr>';

	print '<tr >';
	foreach ($TGammeChromatique as $k => $v) {
		print '<td '.(strpos($v, '#') !== false ? 'bgcolor="black"' : '').'></td>';
	}
	print '</tr>';

	if(!empty($TGammeToCheck)) {
		foreach ($TGammeChromatique as $k => $v) {
			print '<td ';
			if(in_array($v, $TGammeToCheck)) print 'bgcolor="blue"';
			print '></td>';
		}
	}

	print '</table>';
}

?>

<style type="text/css">
td {
	width:30px;
	height:30px;
	border:1px solid;
	text-align: center;
}
</script>