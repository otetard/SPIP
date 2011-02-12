<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2011                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

if (!defined('_ECRIRE_INC_VERSION')) return;

include_spip('inc/presentation_mini');
include_spip('inc/layer');
include_spip('inc/texte');
include_spip('inc/filtres');
include_spip('inc/boutons');
include_spip('inc/actions');
include_spip('inc/puce_statut');
include_spip('inc/filtres_ecrire');

define('_ACTIVER_PUCE_RAPIDE', true);

// http://doc.spip.org/@debut_cadre
function debut_cadre($style, $icone = "", $fonction = "", $titre = "", $id="", $class="", $padding=true) {
	global $spip_display, $spip_lang_left;
	static $accesskey = 97; // a

	//zoom:1 fixes all expanding blocks in IE, see authors block in articles.php
	//being not standard, next step can be putting this kind of hacks in a different stylesheet
	//visible to IE only using conditional comments.

	$style_cadre = " style='";
	if ($spip_display != 1 AND $spip_display != 4 AND strlen($icone) > 1) {
		$style_gauche = "padding-$spip_lang_left: 38px;";
		//$style_cadre .= "margin-top: 20px;'";
		$style_cadre .= "'";
	} else {
		$style_cadre .= "'";
		$style_gauche = '';
	}

	// accesskey pour accessibilite espace prive
	if ($accesskey <= 122) // z
	{
		$accesskey_c = chr($accesskey++);
		$ret = "<a id='access-$accesskey_c' href='#access-$accesskey_c' accesskey='$accesskey_c'></a>";
	} else $ret ='';

	$ret .= "\n<div "
	. ($id?"id='$id' ":"")
	."class='cadre cadre-$style"
	. ($class?" $class":"")
	."'$style_cadre>";

	if ($spip_display != 1 AND $spip_display != 4 AND strlen($icone) > 1) {
		if ($icone_renommer = charger_fonction('icone_renommer','inc',true))
			list($icone,$fonction) = $icone_renommer($icone,$fonction);
		if ($fonction) {
			
			$ret .= http_img_pack("$fonction", "", " class='cadre-icone' ".http_style_background($icone, "no-repeat; padding: 0px; margin: 0px"));
		}
		else $ret .=  http_img_pack("$icone", "", " class='cadre-icone'");
	}

	if (strlen($titre) > 0) {
		if (strpos($titre,'titrem')!==false) {
			$ret .= $titre;
		} elseif ($spip_display == 4) {
			$ret .= "\n<h3 class='cadre-titre'>$titre</h3>";
		} else {
			$ret .= bouton_block_depliable($titre,-1);
		}
	}

	$ret .= "<div". ($padding ?" class='cadre_padding'" : '') .">";

	return $ret;
}

// http://doc.spip.org/@fin_cadre
function fin_cadre($style='') {

	$ret = "<div class='nettoyeur'></div></div>".
	"</div>\n";

	return $ret;
}


// http://doc.spip.org/@debut_cadre_relief
function debut_cadre_relief($icone='', $return = false, $fonction='', $titre = '', $id="", $class=""){
	$retour_aff = debut_cadre('r', $icone, $fonction, $titre, $id, $class);

	if ($return) return $retour_aff; else echo($retour_aff);
}

// http://doc.spip.org/@fin_cadre_relief
function fin_cadre_relief($return = false){
	$retour_aff = fin_cadre('r');

	if ($return) return $retour_aff; else echo($retour_aff);
}


// http://doc.spip.org/@debut_cadre_enfonce
function debut_cadre_enfonce($icone='', $return = false, $fonction='', $titre = '', $id="", $class=""){
	$retour_aff = debut_cadre('e', $icone, $fonction, $titre, $id, $class);

	if ($return) return $retour_aff; else echo($retour_aff);
}

// http://doc.spip.org/@fin_cadre_enfonce
function fin_cadre_enfonce($return = false){

	$retour_aff = fin_cadre('e');

	if ($return) return $retour_aff; else echo_log('fin_cadre_enfonce',$retour_aff);
}


// http://doc.spip.org/@debut_cadre_sous_rub
function debut_cadre_sous_rub($icone='', $return = false, $fonction='', $titre = '', $id="", $class=""){
	$retour_aff = debut_cadre('sous_rub', $icone, $fonction, $titre, $id, $class);
	if ($return) return $retour_aff; else echo_log('debut_cadre_sous_rub',$retour_aff);
}

// http://doc.spip.org/@fin_cadre_sous_rub
function fin_cadre_sous_rub($return = false){
	$retour_aff = fin_cadre('sous_rub');
	if ($return) return $retour_aff; else echo_log('fin_cadre_sous_rub',$retour_aff);
}

// http://doc.spip.org/@debut_cadre_couleur
function debut_cadre_couleur($icone='', $return = false, $fonction='', $titre='', $id="", $class=""){
	$retour_aff = debut_cadre('couleur', $icone, $fonction, $titre, $id, $class);

	if ($return) return $retour_aff; else echo_log('debut_cadre_couleur',$retour_aff);
}

// http://doc.spip.org/@fin_cadre_couleur
function fin_cadre_couleur($return = false){
	$retour_aff = fin_cadre('couleur');

	if ($return) return $retour_aff; else echo_log('fin_cadre_couleur',$retour_aff);
}


// http://doc.spip.org/@debut_cadre_couleur_foncee
function debut_cadre_couleur_foncee($icone='', $return = false, $fonction='', $titre='', $id="", $class=""){
	$retour_aff = debut_cadre('couleur-foncee', $icone, $fonction, $titre, $id, $class);

	if ($return) return $retour_aff; else echo_log('debut_cadre_couleur_foncee',$retour_aff);
}

// http://doc.spip.org/@fin_cadre_couleur_foncee
function fin_cadre_couleur_foncee($return = false){
	$retour_aff = fin_cadre('couleur-foncee');

	if ($return) return $retour_aff; else echo_log('fin_cadre_couleur_foncee',$retour_aff);
}

// http://doc.spip.org/@debut_cadre_trait_couleur
function debut_cadre_trait_couleur($icone='', $return = false, $fonction='', $titre='', $id="", $class=""){
	$retour_aff = debut_cadre('trait-couleur', $icone, $fonction, $titre, $id, $class);
	if ($return) return $retour_aff; else echo_log('debut_cadre_trait_couleur',$retour_aff);
}

// http://doc.spip.org/@fin_cadre_trait_couleur
function fin_cadre_trait_couleur($return = false){
	$retour_aff = fin_cadre('trait-couleur');

	if ($return) return $retour_aff; else echo_log('fin_cadre_trait_couleur',$retour_aff);
}


//
// une boite alerte
//
// http://doc.spip.org/@debut_boite_alerte
function debut_boite_alerte() {
	return debut_cadre('alerte', '', '', '', '', '');
}

// http://doc.spip.org/@fin_boite_alerte
function fin_boite_alerte() {
	return fin_cadre('alerte');
}


//
// une boite info
//
// http://doc.spip.org/@debut_boite_info
function debut_boite_info($return=false) {
	$r = debut_cadre('info', '', '', '', '', 'verdana1');
	if ($return) return $r; else echo_log('debut_boite_info',$r);
}

// http://doc.spip.org/@fin_boite_info
function fin_boite_info($return=false) {
	$r = fin_cadre('info');
	if ($return) return $r; else echo_log('fin_boite_info',$r);
}


//
// La boite des raccourcis
// Se place a droite si l'ecran est en mode panoramique.

// http://doc.spip.org/@bloc_des_raccourcis
function bloc_des_raccourcis($bloc) {
	global $spip_display;

	return creer_colonne_droite('',true)
	. debut_cadre_enfonce('',true)
	. (($spip_display != 4)
	     ? ("\n<div style='font-size: x-small' class='verdana1'><b>"
		._T('titre_cadre_raccourcis')
		."</b>")
	       : ( "<h3>"._T('titre_cadre_raccourcis')."</h3><ul>"))
	. $bloc
	. (($spip_display != 4) ? "</div>" :  "</ul>")
	. fin_cadre_enfonce(true);
}

// Afficher un petit "+" pour lien vers autre page

// http://doc.spip.org/@afficher_plus
function afficher_plus($lien) {
	global $spip_lang_right, $spip_display;

	if ($spip_display != 4) {
			return "\n<a href='$lien' style='float:$spip_lang_right; padding-right: 10px;'>" .
			  http_img_pack(chemin_image("plus-info-16.png"), "+", "") ."</a>";
	}
}

// Afficher un petit "i" pour lien vers autre page

// http://doc.spip.org/@afficher_plus
function afficher_plus_info($lien) {
	global $spip_lang_right, $spip_display;

	if ($spip_display != 4) {
			return "\n<a href='$lien' style='float:$spip_lang_right; padding-right: 10px;'>" .
			  http_img_pack(chemin_image("information-16.png"), "+", "") ."</a>";
	}
}

//
// Fonctions d'affichage
//

// http://doc.spip.org/@afficher_objets
function afficher_objets($type, $titre_table,$requete,$formater='',$force=false){
	$afficher_objets = charger_fonction('afficher_objets','inc');
	return $afficher_objets($type, $titre_table,$requete,$formater,$force);
}

// http://doc.spip.org/@navigation_pagination
function navigation_pagination($num_rows, $nb_aff=10, $href=null, $debut, $tmp_var=null, $on='') {

	$texte = '';
	$self = parametre_url(self(), 'date', '');
	$deb_aff = intval($debut);

	for ($i = 0; $i < $num_rows; $i += $nb_aff){
		$deb = $i + 1;

		// Pagination : si on est trop loin, on met des '...'
		if (abs($deb-$deb_aff)>101) {
			if ($deb<$deb_aff) {
				if (!isset($premiere)) {
					$premiere = '0 ... ';
					$texte .= $premiere;
				}
			} else {
				$derniere = ' | ... '.$num_rows;
				$texte .= $derniere;
				break;
			}
		} else {

			$fin = $i + $nb_aff;
			if ($fin > $num_rows)
				$fin = $num_rows;

			if ($deb > 1)
				$texte .= " |\n";
			if ($deb_aff + 1 >= $deb AND $deb_aff + 1 <= $fin) {
				$texte .= "<b>$deb</b>";
			}
			else {
				$script = parametre_url($self, $tmp_var, $deb-1);
				if ($on) $on = generer_onclic_ajax($href, $tmp_var, $deb-1);
				$texte .= "<a href=\"$script\"$on>$deb</a>";
			}
		}
	}

	return $texte;
}

// http://doc.spip.org/@generer_onclic_ajax
function generer_onclic_ajax($url, $idom, $val)
{
	return "\nonclick=\"return charger_id_url('"
	  . parametre_url($url, $idom, $val)
	  . "','"
	  . $idom
	  . '\');"';
}

// Fonctions onglets


// http://doc.spip.org/@debut_onglet
function debut_onglet(){

	return "
\n<div style='padding: 7px;'><table border='0' class='centered'><tr>
";
}

// http://doc.spip.org/@fin_onglet
function fin_onglet(){
	return "</tr></table></div>\n";
}

// http://doc.spip.org/@onglet
function onglet($texte, $lien, $onglet_ref, $onglet, $icone=""){
	global $spip_display, $spip_lang_left ;

	$res = "<td>";
	$res .= "\n<div style='position: relative;'>";
	if ($spip_display != 1) {
		if (strlen($icone) > 0) {
			$res .= "\n<div style='z-index: 2; position: absolute; top: 0px; $spip_lang_left: 5px;'>" .
			  http_img_pack("$icone", "", "") . "</div>";
			$style = " top: 7px; padding-$spip_lang_left: 32px; z-index: 1;";
		} else {
			$style = " top: 7px;";
		}
	}

	if ($onglet != $onglet_ref) {
		$res .= "\n<div onmouseover=\"changeclass(this, 'onglet_on');\" onmouseout=\"changeclass(this, 'onglet');\" class='onglet' style='position: relative;$style'><a href='$lien'>$texte</a></div>";
		$res .= "</div>";
	} else {
		$res .= "\n<div class='onglet_off' style='position: relative;$style'>$texte</div>";
		$res .= "</div>";
	}
	$res .= "</td>";
	return $res;
}

// http://doc.spip.org/@icone_inline
function icone_inline($texte, $lien, $fond, $fonction="", $align="", $ajax=false, $javascript=''){
	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i",$lien,$r)) {
		list($x,$lien,$atts,$texte)= $r;
		$javascript .= $atts;
	}

	// l'ajax de l'espace prive made in php
	if ($ajax)
		$javascript .= ' onclick=' . ajax_action_declencheur($lien,$ajax);

	return icone_base($lien, $texte, $fond, $fonction,"verticale $align",$javascript);
}

// http://doc.spip.org/@icone_horizontale
function icone_horizontale($texte, $lien, $fond = "", $fonction = "", $af = true, $javascript='') {
	$retour = '';
	// cas d'ajax_action_auteur: faut defaire le boulot
	// (il faudrait fusionner avec le cas $javascript)
	if (preg_match(",^<a\shref='([^']*)'([^>]*)>(.*)</a>$,i",$lien,$r)) {
		list($x,$lien,$atts,$texte)= $r;
		$javascript .= $atts;
	}

	$retour = icone_base($lien, $texte, $fond, $fonction,"horizontale",$javascript);
	if ($af) echo_log('icone_horizontale',$retour); else return $retour;
}


// http://doc.spip.org/@gros_titre
function gros_titre($titre, $ze_logo='', $aff=true){
	global $spip_display;
	$res = "\n<h1 class='grostitre'>";
	if ($spip_display != 4) {
		$res .= $ze_logo.' ';
	}
	$res .= typo($titre)."</h1>\n";
	if ($aff) echo_log('gros_titre',$res); else return $res;
}



// Cadre formulaires

// http://doc.spip.org/@debut_cadre_formulaire
function debut_cadre_formulaire($style='', $return=false){
	$x = "\n<div class='cadre-formulaire'" .
	  (!$style ? "" : " style='$style'") .
	   ">";
	if ($return) return  $x; else echo_log('debut_cadre_formulaire',$x);
}

// http://doc.spip.org/@fin_cadre_formulaire
function fin_cadre_formulaire($return=false){
	if ($return) return  "</div>\n"; else echo_log('fin_cadre_formulaire', "</div>\n");
}


//
// Afficher la hierarchie des rubriques
//

// http://doc.spip.org/@afficher_hierarchie
function afficher_hierarchie($id_parent, $editable=true,$id_objet=0,$type='',$id_secteur=0,$restreint='') {
	$out = recuperer_fond('prive/squelettes/hierarchie/objet',
					array(
						'id_parent'=>$id_parent,
						'objet'=>$type,
						'id_objet'=>$id_objet,
						'deplacer'=>_request('deplacer')?'oui':'',
						'id_secteur'=>$id_secteur,
						'restreint'=>$restreint,
						'editable'=>$editable?' ':'',
					),array('ajax'=>true));
	$out = pipeline('affiche_hierarchie',array('args'=>array(
			'id_parent'=>$id_parent,
			'message'=>$message,
			'id_objet'=>$id_objet,
			'objet'=>$type,
			'id_secteur'=>$id_secteur,
			'restreint'=>$restreint,
			'editable'=>$editable?' ':'',
			),
			'data'=>$out));

 	return $out;
}

// Pour construire des menu avec SELECTED
// http://doc.spip.org/@mySel
function mySel($varaut,$variable, $option = NULL) {
	$res = ' value="'.$varaut.'"' . (($variable==$varaut) ? ' selected="selected"' : '');

	return  (!isset($option) ? $res : "<option$res>$option</option>\n");
}


// http://doc.spip.org/@bouton_spip_rss
function bouton_spip_rss($op, $args=array(), $lang='') {

	global $spip_lang_right;
	include_spip('inc/acces');
	$clic = http_img_pack('feed.png', 'RSS', '', 'RSS');
	$args = param_low_sec($op, $args, $lang, 'rss');
	$url = generer_url_public('rss', $args);
	return "<a style='float: $spip_lang_right;' href='$url'>$clic</a>";
}
?>
