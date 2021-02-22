<?php
class MyModeComments extends Module
{
    // Nous définissons ici le constructeur de la classe.
	public function __construct()
    {
        $this->name = 'mymodecomments'; // Nom du module qui doit correspondre aussi au nom 
        // du script php qui contient sa classe. 
        $this->tab = 'front_office_features'; // Ce module agira sur la partie Front Office
        $this->version = '0.1.0';
        $this->author = 'Sacha';
        $this->displayName = 'Mon module de commentaires produits'; // Assigne un nom public 
        // au module.
        $this->description = ' Avec ce module, vos clients pourront noter et commenter vos produits JARDITOU !'; // Assigne une 
        // description publique au module.
        $this->bootstrap = true; // Possibilité d'utiliser le Framework CSS Bootstrap depuis la version 
        // Prestashop 1.6.
        parent::__construct(); // Nous faisons ici référence au constructeur de la classe parente Module.
    }

    // Cette méthode fait référence à la méthode install () de la classe parente Module et on 
    // la surcharge en lui précisant à quel Hook sera accroché notre module. Ici productFooter.
    // Un Hook est un point d'accroche, il en existe 2 sortes, les Hooks d'affichage 'displayHook' et
    // les Hooks d'action 'actionHook'. Pour définir le positionnement, seul les Hooks d'affichage sont affichés 
    // dans le Back Office (Apparence/Positions). Pour faire apparaître les Hooks d'action il faut
    // "sélectionner afficher les points d'accroche invisibles" 
	public function install()
    {
        parent::install(); // Cette méthode de la classe parente Module permet entre autres 
        // choses de créer l'ajout du module dans la table ps_module de Prestashop.
        $this->registerHook('productFooter'); // Permet d'accrocher le module au hook 
        // productFooter. Cela active le Hook productFooter.
        // Après celà la fonction retourne true et le module peut être installé
        return true;
    }
	
    //***************************GESTION DU BACK-OFFICE ************************************************//
    // Implémentation du formulaire coté Back Office, c'est une méthode qui permet 
    // d'ajouter des options de configuration à notre module. Dés que cette méthode est
    // implémentée dans le code de la classe, l'item Configurer est accessible côté Back-Office
    // au niveau du Module Manager.
    // Nous allons utiliser les 
    // boutons radios pour rendre ou non actifs les champs de formulaire Note et 
    // Commentaire de la fiche Produit. Le fichier getContent.tpl est réalisé avec SMARTY 
    // qui est le systéme de templates de Prestashop.
	public function getContent()
    {
        $this->processConfiguration();
        $this->assignConfiguration();
        return $this->display(__FILE__, 'getContent.tpl');
    }

    // Si le bouton submit du formulaire de configuration du module (getContent.tpl) 
    // a été validé on récupére les valeurs des champs de formulaire dans des variables 
    // que l'on injetcte ensuite dans la BDD.
    // La classe Tools est la boîte à outil de Prestashop, elle permet par exemple ici de tester
    // si le formulaire a été soumis, elle permet aussi de récupérer les valeurs des variables
    // en GET et/ou en POST
	public function processConfiguration() 
    {
        if (Tools::isSubmit('submit_mymodcomments_form')) { // Si les valeurs associées à la clef 'submit_mymodcomments_form' 
            // existent dans les tableaux $_POST et/ou $_GET ça confirmera que le formulaire a bien été posté.
            $enable_grades = Tools::getValue('enable_grades'); // Tools::getValue est 
            // la méthode qui récupére la valeur POST associée à la clef passée 
            // en paramétre, si cette valeur n'existe pas, la méthode verifiera 
            // automatiquement l'existence d'une valeur GET.
            $enable_comments = Tools::getValue('enable_comments');
            Configuration::updateValue('MYMOD_GRADES', $enable_grades); // Configuration::updateValue 
            // est la méthode qui permet de sauvegarder des valeurs simples dans la table 
            // de configuration de Prestashop (ps_configuration). Si la clef n'existe pas dans la table, cette méthode 
            // la créer et lui associe la valeur contenue dans la variable sinon elle modifie 
            // l'ancienne valeur.
            Configuration::updateValue('MYMOD_COMMENTS', $enable_comments);
            $this->context->smarty->assign('confirmation', 'ok'); // Message de confirmation 
            // pour faire savoir que la modification a été prise en compte. 
            // Pour cela il suffit d'assigner une variable de confirmation à SMARTY, 
            // ainsi pour SMARTY nous aurons une variable $confirmation qui contient "ok".
        }
    }
    // Méthode de la classe Configuration::get qui permet de récupérer dans une variable 
    // la valeur associée à la clef de la Table de configuration, avant de la passer à SMARTY.
    // Pour bien démarrer avec SMARTY https://www.smarty.net/docsv2/fr/what.is.smarty.tpl
    public function assignConfiguration()
    {
        $enable_grades = Configuration::get('MYMOD_GRADES');
        $enable_comments = Configuration::get('MYMOD_COMMENTS');
        $this->context->smarty->assign('enable_grades', $enable_grades);
        $this->context->smarty->assign('enable_comments', $enable_comments);
    }
    // *********************************** FIN GESTION COTE BACK-OFFICE **************************** //


    // *********************************** GESTION COTE FRONT-OFFICE ******************************** //
    // Affichage du formulaire du coté Front Office, accroché au hook displayProductFooter.
    // Notez ici l'inversion des mots Product et Footer pour nommer cette méthode par rapport
    // au nom officiel du Hook displayProductFooter. Attention donc de bien tester avant que tout 
    // fonctionne comme prèvu, lorsque ça ne fonctionne pas comme prèvu vous pouvez déjà penser à
    // utiliser cette inversion ;-) 
	public function hookDisplayFooterProduct($params)
	{
        $this->processProductFooter();
		$this->assignProductFooter();
        return $this->display(__FILE__, 'displayProductFooter.tpl');
		
	}

    // Gestion du formulaire coté front Office. Si le formulaire a été soumis, 
    // on récupére les valeurs id_product du produit courant, la note et le commentaire 
    // du client et on sauvegarde ces valeurs dans la table ps_mymod_comment.
    // La fonction pSQL permet de nettoyer les requêtes SQL afin d'éviter les injections de code 
    // malicieux dans ces requêtes.(config/alias.php)
    // avec (int) on cast les valeurs qu'on veut insérer en base pour être certain d'obtenir des 
    // numériques entiers.
	public function processProductFooter()
    {
        if (Tools::isSubmit('mymod_pc_submit_comment')) {
            $id_product = Tools::getValue('id_product');
			$grade = Tools::getValue('grade');
            $comment = Tools::getValue('comment');
			$insert = array(
                'id_product' => (int)$id_product,
                'grade' => (int)$grade,
                'comment' => pSQL($comment),
                'date_add' => date('Y-m-d H:i:s'),
            );
            Db::getInstance()->insert('mymod_comment', $insert);
        }
    }
    // Récupération des notes et commentaires pour le produit courant et passage des valeurs 
    // à SMARTY pour affichage des données.
    // L'Objet context de Prestashop permet de tenir un registre des variables PHP les 
    // rendant accessible depuis n'importe ou dans le code. C'est une classe qui stocke 
    // les principales informations PrestaShop, telles que le cookie actuel, le client, 
    // l'employé, le panier, le service Smarty, le Groupe etc ... 
	public function assignProductFooter()
    {
        $enable_grades = Configuration::get('MYMOD_GRADES');
        $enable_comments = Configuration::get('MYMOD_COMMENTS');
        $id_product = Tools::getValue('id_product');
        $comments = Db::getInstance()->executeS('
        SELECT * FROM `'._DB_PREFIX_.'mymod_comment`
        WHERE `id_product` = '.(int)$id_product);

        $this->context->smarty->assign('enable_grades', $enable_grades);
        $this->context->smarty->assign('enable_comments', $enable_comments);
        $this->context->smarty->assign('comments', $comments);
    }

    //***************************************************FIN GESTION COTE FRONT-OFFICE ******************//

}
?>