<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class OpeningHours extends Module
{
    //Définition du constructeur de classe.
    public function __construct()
    {
        //nom du module correspondant au nom du script php contenant sa classe.
        $this->name = "openinghours";
        //module agissant sur la partie Front office.
        $this->tab = "front_office_features";
        $this->version = "0.1.0";
        $this->author = "Romain";
        //assignation nom public du mod.
        $this->displayName = "Module OpeningHours";
        //description publique du module.
        $this->description = "Module permettant l'affichage, en barre de navigation header, de la date et de l'heure";
        //ouvrir possibilié d'utiliser Framework CSS Bootstrap
        $this->bootstrap = true;
        //faire référence au constructeur de la classe parente Module déjà présente dans l'install Presta.
        parent::__construct();
    }

    //Appel de la méthode install() de la classe parente Module.
    //on la surcharge en précisant le Hook du module.
    public function install()
    {
        //méthode de classe parente Module permettant de créer l'ajout du module dans la table ps_module
        parent::install();
        //accrochage du module au hook displayNav
        $this->registerHook('displayTop');
        //retourne true sur la fonction et la rend prête à être installer.
        return true;
    }
    //---------------------- FRONT GESTION ----------------------//
    public function getContent()
    {
        return $this->display(__FILE__, 'contentBack.tpl');
    }
    //---------------------- FRONT GESTION ----------------------//
    public function hookDisplayTop()
    {

        return $this->display(__FILE__, 'contentFront.tpl');
    }
}
