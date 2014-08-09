<?
if($_POST['doserveraction'])
{
    if ($login->isUserLoggedIn() != true)
    {
        include($_SERVER['DOCUMENT_ROOT']."/login/views/not_logged_in.php");
        exit();
    }
    switch($_POST['doserveraction'])
    {
        case 'remove':
            if($_SESSION['user_name'] == $_POST['UserName'])
            {
                $data = removeServer($_SESSION['user_name'], $_POST['IP'], $_POST['Port'], $login, $_POST['id']);
            }
            else
            {
                $data = 'Username Verification Error. You have been logged for a possible abuse.';
            }

            if($data === true)
            {
                header( 'Location: /manage.php?serveractionr=true') ;
            }
            else
            {
                header( 'Location: /manage.php?serveractionr='.$data) ;
            }
            break;
        case 'whitelist':
            header( 'Location: /manage.php?serveractionr='."WhiteList Not Yet Available. Check back later.") ;
            break;
        case 'editserverinfo':
            header("Location: /editserverinfo.php?id=".$_POST['id']);
            break;
        default:
            $data = 'Action Unspecified. You may have been logged for directly accessing critical files.';
            header( 'Location: /manage.php?serveractionr='.$data) ;
            break;
    }
}