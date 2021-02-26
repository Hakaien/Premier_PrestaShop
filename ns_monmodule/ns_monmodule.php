<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Ns_MonModule extends Module
{
   
    //Définition du constructeur de classe.
    public function __construct()
    {
        //nom du module correspondant au nom du script php contenant sa classe.
        $this->name = "ns_monmodule";
        //module agissant sur la partie Front office.
        $this->tab = "front_office_features";
        $this->version = "0.1.0";
        $this->author = "Romain";
        //assignation nom public du mod.
        $this->displayName = $this->l("Module Test Tuto");
        //spécification version de PS
        $this->ps_versions_compliancy = [
            'min' => '1.7',
            'max' => _PS_VERSION_
        ];
        //description publique du module.
        $this->description = $this->l("Suivie d'un pas à pas tuto Module Presta");
        //ouvrir possibilié d'utiliser Framework CSS Bootstrap
        $this->bootstrap = true;
        //faire référence au constructeur de la classe parente Module déjà présente dans l'install Presta.
        parent::__construct();
        //Message de confirmation optionnel à afficher lors de la désinstallation
        $this->confirmUninstall = $this->l('Êtes-vous sûr de vouloir désinstaller ce module ?');

        // vérif si la valeur NS_MONMODULE_PAGENAME est configurée ou non
        if (!Configuration::get('NS_MONMODULE_PAGENAME')) {
            $this->warning = $this->l('Aucun nom fourni');
        }
    }

    //Appel de la méthode install() de la classe parente Module.
    //on la surcharge en précisant le Hook du module.
    public function install()
    {
        //if (Shop::isFeatureActive()) ... vérifie si le mode multi-boutique de Prestashop 1.7 est activé. 
        //Si c’est le cas définit le contexte pour appliquer l’installation à toutes les boutiques
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        //Ensuite un test vérifie que l’installation s’est bien déroulée en récupérant le résultat de la méthode !parent::install(), 
        //en s’inscrivant au hook leftColumn, au hook header et en enregistrant la valeur NS_MONMODULE_PAGENAME. Chacune de ces actions va s’exécuter 
        //et si l’une d’elle retourne false l’installation a échouée. 
        //Dans le cas contraire l’installation a réussi
        if (!parent::install() || $this->registerHook('leftColumn') || $this->registerHook('header') || !Configuration::updateValue('NS_MONMODULE_PAGENAME', 'Mentions légales')) {
            return false;
        }
        return true;
        //Une fois l’installation réalisée vous aurez donc inscrit votre module aux hooks leftColumn
        //et header et créé un nouveau réglage dans la base de données appelé NS_MONMODULE_PAGENAME.
    }

    //Lors de la désinstallation, pas besoin de désinscrire le module des différents hooks. Cependant il est important, pour faire une désinstallation propre, 
    //de supprimer le réglage NS_MONMODULE_PAGENAME créé dans la base.
    public function uninstall()
    {
        if (!parent::uninstall() || !Configuration::deleteByName('NS_MONMODULE_PAGENAME')) {
            return false;
        }
        return true;
    }



    //---------------------- BACK GESTION ----------------------//
    public function getContent()
    {
        $this->processConfig();
    }

    public function processConfig()
    {
        $output = null;
        //Tools::isSubmit commence par vérifier si le formulaire a été envoyé ou non en fonction du nom du bouton de validation, 
        //ici appelé btnSubmit. Si ce n’est pas le cas, il affiche simplement le formulaire plus bas, 
        //sinon il gère les informations envoyées par le formulaire
        if (Tools::isSubmit('btnSubmit')) {
            //On récupère la valeur de NS_MONMODULE_PAGENAME avec strval(Tools::getValue('NS_MONMODULE_PAGENAME'))
            $pageName = strval(Tools::getValue('NS_MONMODULE_PAGENAME'));

            //Et on teste cette valeur en regardant si elle existe et si elle n’est pas vide avec !$pageName || empty($pageName)
            if (!$pageName || empty($pageName)) {
                //Si elle est n’est pas valide, on affiche une erreur à l’aide de la méthode displayError
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            } else {
                //Sinon on met à jour la valeur avec Configuration::updateValue et ensuite on affiche une confirmation de modification avec displayConfirmation
                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        //Pour terminer, on fait appel à la méthode displayForm (créer par nous plus tard)pour afficher le contenu du formulaire
        return $output . $this->displayForm();
    }

    public function displayForm()
    {
        // Récupère la langue par défaut
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Initialise les champs du formulaire dans un tableau
        $form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Configuration value'),
                        'name' => 'NS_MONMODULE_PAGENAME',
                        'size' => 20,
                        'required' => true
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                    'name'  => 'btnSubmit'
                )
            ),
        );

        $helper = new HelperForm();

        // Module, token et currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&amp;configure=' . $this->name;

        // Langue
        $helper->default_form_language = $defaultLang;

        // Charge la valeur de NS_MONMODULE_PAGENAME depuis la base
        $helper->fields_value['NS_MONMODULE_PAGENAME'] = Configuration::get('NS_MONMODULE_PAGENAME');

        return $helper->generateForm(array($form));
    }
    //---------------------- END BACK GESTION ----------------------//

    //---------------------- FRONT GESTION ----------------------//
    public function hookDisplayLeftColumn($params)
    {
        //Cette méthode va commencer par assigner des variables qui seront utilisables dans les modèles tpl. Grâce à la méthode $this->context->smarty->assign on peut assigner des variables à la vue.
        //Ces variables appelées ici ns_page_name et ns_page_link seront ensuite accessibles dans la vue sous la forme $ns_page_name et $ns_page_link
        //ns_page_name récupère le champ dans la table ps_configuration tel que défini dans la configuration du module
        //ns_page_link lui va récupérer, dans le contexte actuel, un lien vers une action display de notre module ns_monmodule. Nous la définirons plus loin
        //Pour terminer, $this->display s’occupe de récupérer le fichier de template ns_monmodule.tpl utilisé pour afficher le contenu
        $this->context->smarty->assign([
            'ns_page_name' => Configuration::get('NS_MONMODULE_PAGENAME'),
            'ns_page_link' => $this->cntext->linkg->getModuleLink('ns_monmodule', 'display')
        ]);
        return $this->display(__FILE__, 'ns_monmodule.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->registerStylesheet(
            'ns_monmodule',
            $this->path . 'views/css/ns_monmodule/.css',
            ['server' => 'remote', 'position' => 'head', 'priority' => 150]
        );
    }
    //---------------------- END FRONT GESTION ----------------------//
}
