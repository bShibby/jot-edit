<?php
$path = filter_input(INPUT_SERVER,'DOCUMENT_ROOT');
include_once $path . '/jot-edit/scripts/php/stCore/stCore.php';

include_once $path . '/jot-edit/scripts/php/widget/WName.php';
include_once $path . '/jot-edit/scripts/php/widget/WEmail.php';
include_once $path . '/jot-edit/scripts/php/widget/WPhone.php';
include_once $path . '/jot-edit/scripts/php/widget/WAddress.php';
include_once $path . '/jot-edit/scripts/php/widget/WResetPassword.php';
include_once $path . '/jot-edit/scripts/php/widget/WInviteCreator.php';
include_once $path . '/jot-edit/scripts/php/widget/WEntry.php';
include_once $path . '/jot-edit/scripts/php/widget/WAccountToolBar.php';
include_once $path . '/jot-edit/scripts/php/widget/WAccountTools.php';
include_once $path . '/jot-edit/scripts/php/widget/WButton.php';

include_once $path . '/jot-edit/scripts/php/page/PPage.php';
include_once $path . '/jot-edit/scripts/php/manager/MAccess.php';




    //Manage our sessions to control the toolbar.
require_once $path . '/jot-edit/scripts/php/manager/MSession.php';



    //Load tool bar depending on the user logged in. 
$am = MAccess::Get();
if(!$am->HasAccess()){ Redirect('../../../error/unauthorized-access');}
    

  




    //see what account tool was requested.
$request = filter_input(INPUT_GET, "request");

    //Create a page.
$newPage = new PPage("studio"); 







    //Add Meta and other tags to the header.
$newPage->AddMeta("robots", "noindex");//Dont want our index page in search results.
$newPage->AddMeta("description", "Green and Gold Records Login page.");
$newPage->AddCss("/jot-edit/css/jotedit.css");        

    //Add the scripts to the page
$newPage->AddScriptLink("https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" );
//$newPage->AddScriptFile("../scripts/js/history/html4+html5/jquery.history.js");
//$newPage->AddScriptFile("../scripts/js/state.js");
$newPage->AddScriptLink("/jot-edit/scripts/js/interfaceEffects.js");
$newPage->AddScriptLink("/jot-edit/scripts/js/action.js");








//$newPage->AddToToolbar(new WButton('account','account','/jot-edit/action/account'));
$newPage->AddToToolbar(new WButton('exit','sign out','/jot-edit/action/logout'));
$newPage->AddToToolbar(new WButton('profile','profiles','/jot-edit/action/profile'));
$newPage->AddToToolbar(new WButton('account','account','/jot-edit/action/account'));


//  $newPage->AddToToolbar(new WAccountTools('account', array('class'=>'widget'), TRUE));








////Do stuff in here
//







        //Artist Panel **This will be changed to ajax once that is fully intergrated
$ap = new CDiv("blogs_list", array());
$ap->AddChild(new CPara('te',array(),'Blogs or tutorials'));
$newPage->AddToContent($ap);



$at = new CDiv("account_tools_holder", array());
//at->AddChild(new WAccountToolBar());
$at->AddChild(new CText('account_tool_bar','p','','This is where quick access tool bar buttons will go.'));
$newPage->AddToContent($at);



//Create the content panel
$pan = new CDiv("", array('class'=>'account_panel'));
$newPage->AddToContent($pan);


switch($request){
    case 'name':
        $pan->AddChild(new CText('', 'div', '', 'edit_name'));
        break;
    default:
        //more things as functionality extends
        $pan->AddChild(new CText('', 'div', '', '<br/><br/>default action in here just to show rewrite and ish working.<br/><br/>'));
        break;
}




    //Render the generated page.
$newPage->Render();



