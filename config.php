<?php

/* Title of the page */
$title = 'XDCC';

/*
language available:
- en
- fr
*/
$language = 'en';

/*
Do you want to show the Bookmark block:
- true
- false
*/
$bookmark = false; //do not change

/*
Can Search engines track this website?
- true (yes)
- false (no)
*/
$can_track = 'true';


/*
Your main website
- "" for no website
- begin with ftp/http
*/
$website_link = "ff";
$website_label = "Website";


/* The IRC server to connect to:
change in this example irc://irc-server:port/channel?key:
	* `irc-server` by your IRC server
	* `port` by the port by default (optionnal)
	* `channel` by your channel (without the #)
	* `key` by the key to enter to your channel (optionnal, if you don't put it, remove the ? in the URL too)

	For example "irc://freenode.net/wikihow" is ok
*/
$irc_link = "irc://irc-server:port/channel?key";
$irc_label = "IRC";


/* IMPORTANT: For admin.php page */
$user = "user";
$password = "user";

/**********************************************************\
*      _                                                   *
*     | |                                                  *
*     | |     __ _ _ __   __ _ _   _  __ _  __ _  ___      *
*     | |    / _` | '_ \ / _` | | | |/ _` |/ _` |/ _ \     *
*     | |___| (_| | | | | (_| | |_| | (_| | (_| |  __/     *
*     \_____/\__,_|_| |_|\__, |\__,_|\__,_|\__, |\___|     *
*                         __/ |             __/ |          *
*                        |___/             |___/           *
\**********************************************************/

$lang = array (
"en" => array(
	"choose_bot" => "Choose a bot",
	"Pack" => "Pack",
	"File" => "File",
	"Size" => "Size",
	"Downloads" => "Downloads",
	"Paste_windows" => "Paste this in your irc client:",
	"User" => "User",
	"Password" => "Password",
	"Powered" => "Powered by",
	"bot_add" => "has been successfully added!",
	"bot_modify" => "has been successfully modified!",
	"bot_remove" => "has been successfully removed!",
	"Bot_name" => "Name of the bot",
	"Bot_xml" => "XML of the bot",
	"Bot_website" => "Website linked to the bot",
	"Bot_irc" => "IRC linked to the bot",
	"Add_but" => "Add it!",
	"Modify_but" => "Modify it!",
	"Remove_but" => "Remove it!",
	"Connect_but" => "Log in!",
	"Add_h2" => "Add a bot",
	"Modify_h2" => "Modify a bot",
	"Modify_Remove_h2" => "Modify/Remove a bot",
	"Admin_page" => "Admin Page",
	"Disconnect_but" => "Disconnect",
	"Home_but" => "Home",
	"website" => "website",
	"IRC" => "- IRC",
	"Fail_load_XML" => "Failed to load XML file, or the XML file is empty",
),
"fr" => array(
	"choose_bot" => "Choisissez un bot dans la liste",
	"Pack" => "Pack",
	"File" => "Fichier",
	"Size" => "Taille",
	"Downloads" => "Téléchargements",
	"Paste_windows" => "Copie cela dans ton logiciel IRC :",
	"User" => "Utilisateur",
	"Password" => "Mot de passe",
	"Powered" => "Utilise",
	"bot_add" => "a été ajouté !",
	"bot_modify" => "a été modifié !",
	"bot_remove" => "a été supprimé !",
	"Bot_name" => "Nom du bot",
	"Bot_xml" => "XML du bot",
	"Bot_website" => "Site internet lié au bot",
	"Bot_irc" => "IRC lié au bot",
	"Add_but" => "L'ajouter !",
	"Modify_but" => "Le modifier !",
	"Remove_but" => "Le supprimer!",
	"Connect_but" => "Se connecter",
	"Add_h2" => "Ajouter un bot",
	"Modify_h2" => "Modifier un bot",
	"Modify_Remove_h2" => "Modifier/Supprimer un bot",
	"Admin_page" => "Page d'administration",
	"Disconnect_but" => "Se déconnecter",
	"Home_but" => "Accueil",
	"website" => "- site internet",
	"IRC" => "- IRC",
	"Fail_load_XML" => "Échec du chargement du fichier XML ou le fichier XML est vide",
),
);
?>
