<?php

// Not Required, But it can be use to forcefully overwrite the URL.
// If the domain transfer from one domain to another.
define('SITEURL', 'https://www.thegenieorlando.com/blog/');
define('FORCE_HTTPS', TRUE);
define('SITE_SUBDOMAIN', ''); // '' - Blank/None, 'WWW' - Force www, 'NON-WWW' - Force Non-www
define('RESET_HTACCESS_REDIRECT', FALSE); //Resets all redirects above - Must be FALSE for redirects to work
//URL Structure - Force SSL and/or WWW/NON-WWW
$sProtocol = (FORCE_HTTPS === TRUE && @$_SERVER["HTTPS"] != "on") ? "https://" : "http://";
$sHostname = $_SERVER["HTTP_HOST"];
$bRedirect = FALSE;

//non-www
if (SITE_SUBDOMAIN === 'NON-WWW' && strncmp($_SERVER['HTTP_HOST'], 'www.', 4) === 0) {
    $sHostname = substr($_SERVER['HTTP_HOST'], 4);
    $bRedirect = TRUE;
}
//www
if (SITE_SUBDOMAIN === 'WWW' && strncmp($_SERVER['HTTP_HOST'], 'www.', 4) !== 0) {
    $sHostname = 'www.' . $_SERVER["HTTP_HOST"];
    $bRedirect = TRUE;
}
//redirect
if (RESET_HTACCESS_REDIRECT === TRUE) {
    resetRewrites();
} else if ($sProtocol == 'https://' || $bRedirect) {
    setRewrites($sProtocol, SITE_SUBDOMAIN);
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $sProtocol . $sHostname . $_SERVER["REQUEST_URI"]);
    exit();
}

/*
 * Custom JSON Database
 */

global $connection;
global $databasename;

/*
 * Database Main File
 */

$databasename = 'd32e39b18c1a1d07d511fe9cfc1c210a';
$dbusername = 'sbdbuser';
$dbpassword = 'pgk*g[fS;Q+6]6n~';


/*
 * Connect JSON DB file
 */

$connection = sb_jsondb_connect($databasename, $dbusername, $dbpassword, 'admin');
if (!$connection) {
    die('Error in connect with database');
}

/*
 * Json DB Connect Function
 */

function sb_jsondb_connect($databasename, $dbusername, $dbpassword, $type = '') {

    $out = 0;

    // Check Request By User
    if ($type == 'admin') :
        $dbfilepath = dirname(__FILE__) . '/database/admin/' . $databasename . '.json';
    else :
        $dbfilepath = dirname(__FILE__) . '/database/' . $databasename . '.json';
    endif;

    // Check if database exists
    if (!file_exists($dbfilepath)) :

        echo "Database not exists.";
        die();

    else :

        $encstring = 'ICRkYmZpbGVqc29uID0gZmlsZV9nZXRfY29udGVudHMoJGRiZmlsZXBhdGgpOwogICAgICAgJGRiZmlsZWFycnkgPSBqc29uX2RlY29kZSgkZGJmaWxlanNvbik7CiAgICAgICAKICAgICAgICRqZGJ1c3JuYW1lID0gJGRiZmlsZWFycnlbJzAnXS0+ZGJ1c2VybmFtZTsgCiAgICAgICAkamRidXNycGFzcyA9ICRkYmZpbGVhcnJ5WycwJ10tPmRicGFzc3dvcmQ7IAogICAgICAgCiAgICAgICAKICAgICAgIGlmKCgkZGJ1c2VybmFtZSE9JycpICYmICgkamRidXNybmFtZSE9JycpICYmICgkZGJwYXNzd29yZCE9JycpICYmICgkamRidXNycGFzcyE9JycpICYmICgkZGF0YWJhc2VuYW1lIT0nJykpOgogICAgICAgICAgIAogICAgICAgICAgIGlmKChiYXNlNjRfZW5jb2RlKCRkYnVzZXJuYW1lKT09JGpkYnVzcm5hbWUpICYmIChiYXNlNjRfZW5jb2RlKCRkYnBhc3N3b3JkKT09JGpkYnVzcnBhc3MpKToKICAgICAgICAgICAgICAgICRvdXQgPSAxOwogICAgICAgICAgIGVuZGlmOwogICAgICAgICAgIAogICAgICAgZW5kaWY7';

        eval(base64_decode($encstring));

    endif;

    return $out;
}

/*
 * First User Status
 */

function get_first_user_status() {

    $out = 1;

    $dbfilepath = SYSTEMPATH . '/database/admin/d32e39b18c1a1d07d511fe9cfc1c210a.json';
    $dbfilejson = file_get_contents($dbfilepath);
    $superadmin = json_decode($dbfilejson);

    if ($superadmin) {
        foreach ($superadmin as $authordata) {
            $out = $authordata->adminfirst;
        }
    }

    return $out;
}

/**
 * Generate htaccess file with https or www/non-www redirect
 * @param   string $sProtocol URL protocol
 * @param   string $sSubdomainType WWW or NON-WWW
 * @return  null
 */
function setRewrites($sProtocol, $sSubdomainType) {
    $bCleanup = false;
    $sHtaccessFile = str_replace('/admin','/',dirname(__FILE__)) .'.htaccess';
    $hFileContent = @fopen($sHtaccessFile, 'r');
    $sFileContents = fread($hFileContent, filesize($sHtaccessFile));
    fclose($hFileContent);
    $sInjectRules = '';
    //www vs non-www
    switch ($sSubdomainType) {
        case 'WWW':
            //inject www rewrite
            if (strpos($sFileContents, '#Force www:') === FALSE) {
                $sNewHost = str_replace('www.', '', $_SERVER["HTTP_HOST"]);
                $sInjectRules = "\n#Force www:
RewriteCond %{REQUEST_URI} ^.*\.html$
RewriteCond %{HTTP_HOST} ^" . $sNewHost . " [NC]
RewriteRule ^(.*)$ " . $sProtocol . "www." . $sNewHost . "/$1 [L,R=301,NC]
#End www\n";
            }
            //remove non-www if exist
            if (strpos($sFileContents, '#Force non-www:') !== FALSE) {
                $sFileContents = delete_all_between('#Force non-www:', '#End non-www', $sFileContents);
            }
            break;
        case 'NON-WWW':
            //inject non-www rewrite
            if (strpos($sFileContents, '#Force non-www:') === FALSE) {
                $sNewHost = str_replace('www.', '', $_SERVER["HTTP_HOST"]);
                $sInjectRules = "\n#Force non-www:
RewriteCond %{REQUEST_URI} ^.*\.html$
RewriteCond %{HTTP_HOST} ^www\." . str_replace('.com', '\.com', $sNewHost) . " [NC]
RewriteRule ^(.*)$ " . $sProtocol . "www." . $sNewHost . "/$1 [L,R=301]
#End non-www\n";
            }
            //remove www if exist
            if (strpos($sFileContents, '#Force www:') !== FALSE) {
                $sFileContents = delete_all_between('#Force www:', '#End www', $sFileContents);
            }
            break;
        default:
            //remove www if exist
            if (strpos($sFileContents, '#Force www:') !== FALSE) {
                $sFileContents = delete_all_between('#Force www:', '#End www', $sFileContents);
            }
            //remove non-www if exist
            if (strpos($sFileContents, '#Force non-www:') !== FALSE) {
                $sFileContents = delete_all_between('#Force non-www:', '#End non-www', $sFileContents);
            }
            $bCleanup = true;
            break;
    }

    //https
    if ($sProtocol == 'https://' && strpos($sFileContents, '#Force https:') === FALSE) {
        $sInjectRules .= "\n#Force https:
RewriteCond %{HTTPS} off
RewriteRule (.*) https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
Header always set Content-Security-Policy: upgrade-insecure-requests
#End https\n";
    } elseif (strpos($sFileContents, '#Force https') !== FALSE) {
        //remove https if not set
        $sFileContents = delete_all_between('#Force https:', '#End https', $sFileContents);
        $bCleanup = true;
    }

    //write file
    if (trim($sInjectRules) || $bCleanup) {
        $hOverwriteFile = fopen($sHtaccessFile, 'w');
        $sFileContents = str_replace("\n\n\n", "\n", $sFileContents);
        fwrite($hOverwriteFile, $sFileContents . $sInjectRules);
        fclose($hOverwriteFile);
    }
}

/**
 * Reset htaccess file with https or www/non-www redirects
 * @return  null
 */
function resetRewrites() {
    $bCleanup = false;
    $sHtaccessFile = str_replace('/admin','/',dirname(__FILE__)) . '.htaccess';
    $hFileContent = @fopen($sHtaccessFile, 'r');
    $sFileContents = fread($hFileContent, filesize($sHtaccessFile));
    fclose($hFileContent);

    //remove www if exist
    if (strpos($sFileContents, '#Force www:') !== FALSE) {
        $sFileContents = delete_all_between('#Force www:', '#End www', $sFileContents);
        $bCleanup = true;
    }
    //remove non-www if exist
    if (strpos($sFileContents, '#Force non-www:') !== FALSE) {
        $sFileContents = delete_all_between('#Force non-www:', '#End non-www', $sFileContents);
        $bCleanup = true;
    }
    //remove https
    if (strpos($sFileContents, '#Force https:') !== FALSE) {
        //remove https if not set
        $sFileContents = delete_all_between('#Force https:', '#End https', $sFileContents);
        $bCleanup = true;
    }

    //write file
    if ($bCleanup) {
        $hOverwriteFile = @fopen($sHtaccessFile, 'w');
        $sFileContents = str_replace("\n\n\n", "\n", $sFileContents);
        fwrite($hOverwriteFile, $sFileContents);
        fclose($hOverwriteFile);
    }
}

/**
 * Remove strings in between specific chars
 * @param string $beginning starting string
 * @param string $end   ending string
 * @param string $string    entire string
 * @return type
 */
function delete_all_between($beginning, $end, $string) {
    $beginningPos = strpos($string, $beginning);
    $endPos = strpos($string, $end);
    if ($beginningPos === false || $endPos === false) {
        return $string;
    }

    $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

    return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string)); // recursion to ensure all occurrences are replaced
}