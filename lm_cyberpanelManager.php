<?php
class cyberpanelManager
{
    var $cyberpanelAPI_URL = '';
    var $cyberpanelAPI_uname = '';
    var $cyberpanelAPI_upswd = '';

    function __construct($url, $adminName, $adminPswd){
        //echo "构造";
        global $cyberpanelAPI_URL;
        global $cyberpanelAPI_uname;
        global $cyberpanelAPI_upswd;

        $cyberpanelAPI_URL = $url;
        $cyberpanelAPI_uname = $adminName;
        $cyberpanelAPI_upswd = $adminPswd;
    }

    function cyberpanelVerify()//这个函数似乎没什么用，不管它吧
    {
        $ch = curl_init();

        global $cyberpanelAPI_URL;
        global $cyberpanelAPI_uname;
        global $cyberpanelAPI_upswd;

        curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/verifyConn");
        echo $cyberpanelAPI_URL . "/api/verifyConn";
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        $json_arr = array();
        $json_arr['adminUser'] = $cyberpanelAPI_uname;
        $json_arr['adminPass'] = $cyberpanelAPI_upswd;
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        //var_dump($response);
        echo $response;
    }

    function userNew($firstName, $lastName, $email, $userName, $password, $websiteLimit, $selectedACL = "user", $securityLevel = "HIGH") //创建用户，参数均为用户的信息
    {
        $ch = curl_init();

        global $cyberpanelAPI_URL;
        global $cyberpanelAPI_uname;
        global $cyberpanelAPI_upswd;

        curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/submitUserCreation");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $json_arr = array();
        $json_arr['adminUser'] = $cyberpanelAPI_uname;
        $json_arr['adminPass'] = $cyberpanelAPI_upswd;
        $json_arr['firstName'] = $firstName;
        $json_arr['lastName'] = $lastName;
        $json_arr['email'] = $email;
        $json_arr['userName'] = $userName;
        $json_arr['password'] = $password;
        $json_arr['websitesLimit'] = $websiteLimit;
        $json_arr['selectedACL'] = $selectedACL;
        $json_arr['securityLevel'] = $securityLevel;
 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        //var_dump($response);
        //echo $response;
        if (json_decode($response, true)['status'] = "1"){
            return true;
        }else{
            return false;
        }
    }

    function userPswdChange($username, $password) //修改用户密码，参数用户名和密码
    {
        $ch = curl_init();

        global $cyberpanelAPI_URL;
        global $cyberpanelAPI_uname;
        global $cyberpanelAPI_upswd;

        curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/changeUserPassAPI");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        $json_arr = array();
        $json_arr['adminUser'] = $cyberpanelAPI_uname;
        $json_arr['adminPass'] = $cyberpanelAPI_upswd;
        $json_arr['websiteOwner'] = $username;
        $json_arr['ownerPassword'] = $password;

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        //var_dump($response);
        //echo $response;
        if (json_decode($response, true)['status'] = "1"){
            return true;
        }else{
            return false;
        }
    }

function websiteNew($domainName, $ownerEmail, $packageName, $websiteOwner, $ownerPassword) //创建网站
{
    $ch = curl_init();

    global $cyberpanelAPI_URL;
    global $cyberpanelAPI_uname;
    global $cyberpanelAPI_upswd;

    curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/createWebsite");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $json_arr = array();
    $json_arr['adminUser'] = $cyberpanelAPI_uname;
    $json_arr['adminPass'] = $cyberpanelAPI_upswd;
    $json_arr['domainName'] = $domainName;
    $json_arr['ownerEmail'] = $ownerEmail;
    $json_arr['packageName'] = $packageName;
    $json_arr['websiteOwner'] = $websiteOwner;
    $json_arr['ownerPassword'] = $ownerPassword;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    //var_dump($response);
    //echo $response;
    if (json_decode($response, true)['status'] = "1"){
        return true;
    }else{
        return false;
    }
}

function websiteRemove($domainName) //删除网站，只需要欲删除的域名
{
    $ch = curl_init();

    global $cyberpanelAPI_URL;
    global $cyberpanelAPI_uname;
    global $cyberpanelAPI_upswd;

    curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/deleteWebsite");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $json_arr = array();
    $json_arr['adminUser'] = $cyberpanelAPI_uname;
    $json_arr['adminPass'] = $cyberpanelAPI_upswd;
    $json_arr['domainName'] = $domainName;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    //var_dump($response);
    //echo $response;
    if (json_decode($response, true)['status'] = "1"){
        return true;
    }else{
        return false;
    }
}

function websitePackageChange($websiteName, $packageName) //网站更改包，需要域名和新的包名
{
    $ch = curl_init();

    global $cyberpanelAPI_URL;
    global $cyberpanelAPI_uname;
    global $cyberpanelAPI_upswd;

    curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/changePackageAPI");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $json_arr = array();
    $json_arr['adminUser'] = $cyberpanelAPI_uname;
    $json_arr['adminPass'] = $cyberpanelAPI_upswd;
    $json_arr['websiteName'] = $websiteName;
    $json_arr['packageName'] = $packageName;

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    //var_dump($response);
    //echo $response;
}

function websiteSetStatus($websiteName, $status = false) //网站设置暂停或解除暂停的状态;状态true为启用，false为关闭;无返回值，因为这个API调用后不会正常显示是否成功
{
    $ch = curl_init();

    global $cyberpanelAPI_URL;
    global $cyberpanelAPI_uname;
    global $cyberpanelAPI_upswd;

    curl_setopt($ch, CURLOPT_URL, $cyberpanelAPI_URL . "/api/submitWebsiteStatus");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $json_arr = array();
    $json_arr['adminUser'] = $cyberpanelAPI_uname;
    $json_arr['adminPass'] = $cyberpanelAPI_upswd;
    $json_arr['websiteName'] = $websiteName;
    if ($status){
        $json_arr['state'] = "Activate";
    }else{
        $json_arr['state'] = "Suspend";
    }
    

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json_arr));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json"
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    //var_dump($response);
    //echo $response;
}



}

