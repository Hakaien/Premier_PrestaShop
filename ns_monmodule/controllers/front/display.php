<?php
//Ici on crée donc le controller, qui hérite de ModuleFrontController, 
//et dont le contenu est généré à partir de la méthode initContent.
//Celle-ci commence par exécuter la méthode de la classe parente, puis définit le template à utiliser. 
//Ici display.tpl dans ns_monmodule/views/templates/front
class ns_monmoduledisplayModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:ns_monmodule/views/templates/front/display.tpl');
    }
}
