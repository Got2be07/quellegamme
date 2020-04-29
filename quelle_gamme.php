<link rel="stylesheet" href="style.css">
<?php
error_reporting(E_PARSE);

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

printPiano($TGammeChromatique, true);

if(!empty($_REQUEST['print_all_gammes'])) {
	
	// Affichage des gammes majeures :
	foreach ($TGammeMajeure as $note => $TNotesGamme) {
		$skip = false;
		foreach ($_REQUEST['TSelectedNotes'] as $n) {

			if(!in_array($n, $TNotesGamme)) {
				$skip=true;
				break;
			}
		}
		if(empty($skip)) {
			print '<h3>Gamme Majeure de '.$note.' : (Accords disponibles : '.printAccordsDisponibles($TNotesGamme).')</h3>';
			printPiano($TGammeChromatique, false, $TNotesGamme);
		}
	}

	// Affichage des gammes mienures naturelles :
	foreach ($TGammeMineure as $note => $TNotesGamme) {
		$skip = false;
		foreach ($_REQUEST['TSelectedNotes'] as $n) {

			if(!in_array($n, $TNotesGamme)) {
				$skip=true;
				break;
			}
		}
		if(empty($skip)) {
			print '<h3>Gamme Mineure Naturelle de '.$note.' : (Accords disponibles : '.printAccordsDisponibles($TNotesGamme).')</h3>';
			printPiano($TGammeChromatique, false, $TNotesGamme);
		}
	}
}

print '<br />';



function printPiano($TGammeChromatique, $get_form=false, $TGammeToCheck=array()) {
	if($get_form) print '<form name="get_gammes" method="POST" action="quelle_gamme.php?print_all_gammes=1">';
	print '<table >';

	if($get_form) {
		print '<tr >';
		foreach ($TGammeChromatique as $k => $v) {
			print '<td><input name="TSelectedNotes[]" value="'.$v.'" type="checkbox" '.(in_array($v, $_REQUEST['TSelectedNotes']) ? 'checked="checked"' : '').' id="'.$v.'" /></td>';
		}
		print '</tr>';
	}
	print '<tr>';

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

	if($get_form) {
		print '<br /><input type="SUBMIT" value="Chercher gammes" />';
		print '</form>';
	}
}

function printAccordsDisponibles($TGamme, $type="majeure") {
	if($type == 'majeure') {
		return $TGamme[0].'maj, '.$TGamme[1].'min, '.$TGamme[2].'min, '.$TGamme[3].'maj, '.$TGamme[4].'maj, '.$TGamme[5].'min';
	} else {
		print $TGamme[0].'min, '.$TGamme[2].'maj, '.$TGamme[3].'min, '.$TGamme[4].'min, '.$TGamme[5].'maj, '.$TGamme[6].'maj';
	}
}

?>
