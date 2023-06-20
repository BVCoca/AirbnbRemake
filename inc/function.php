<?php

// Fonction pour vérifier si l'utilisateur est connecté.
function isLogged()
{
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function afficherDateEnFrancais($date)
{
    $mois = array(
        'january' => 'janvier',
        'february' => 'février',
        'march' => 'mars',
        'april' => 'avril',
        'may' => 'mai',
        'june' => 'juin',
        'july' => 'juillet',
        'august' => 'août',
        'september' => 'septembre',
        'october' => 'octobre',
        'november' => 'novembre',
        'december' => 'décembre'
    );
    $mois_en_cours = strtolower(date('F', strtotime($date)));

    switch ($mois_en_cours) {
        case 'january':
            $mois_fr = $mois['january'];
            break;
        case 'february':
            $mois_fr = $mois['february'];
            break;
        case 'march':
            $mois_fr = $mois['march'];
            break;
        case 'april':
            $mois_fr = $mois['april'];
            break;
        case 'may':
            $mois_fr = $mois['may'];
            break;
        case 'june':
            $mois_fr = $mois['june'];
            break;
        case 'july':
            $mois_fr = $mois['july'];
            break;
        case 'august':
            $mois_fr = $mois['august'];
            break;
        case 'september':
            $mois_fr = $mois['september'];
            break;
        case 'october':
            $mois_fr = $mois['october'];
            break;
        case 'november':
            $mois_fr = $mois['november'];
            break;
        case 'december':
            $mois_fr = $mois['december'];
            break;
        default:
            $mois_fr = '';
    }

    $jour = date('d', strtotime($date));
    $annee = date('Y', strtotime($date));
    $date_fr = $jour . ' ' . $mois_fr . ' ' . $annee;

    return $date_fr;
}

function substringsfn($str, $len, $end = '...')
{
    if (strlen($str) > $len) {
        $str = substr($str, 0, $len);
        $str = substr($str, 0, strrpos($str, ' '));
        $str .= $end;
    }
    return $str;
}
