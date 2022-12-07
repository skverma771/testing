<?php
/*
 * @ https://EasyToYou.eu - IonCube v10 Decoder Online
 * @ PHP 5.2
 * @ Decoder version: 1.0.4
 * @ Release: 02/06/2020
 *
 * @ ZendGuard Decoder PHP 5.2
 */

class IonoLicenseHandler
{
    public $home_url_site = "http://customers.agriya.com";
    public $home_url_port = 80;
    public $home_url_iono = "/sales/remote.php";
    public $user_defined_string = "f258410f387e";
    public $comm_terminate = true;
    public $license_terminate = true;
    public $product_license_id = 405;
    public $product_id = 177;
    public function setErrorTexts()
    {
        $this->error_text["disabled"] = "<p><strong>License Error:</strong> Your license is disabled. </p>";
        $this->error_text["suspended"] = "<p><strong>License Error:</strong> Your license has been suspended. </p>";
        $this->error_text["expired"] = "<p><strong>License Error:</strong> Your license has expired. </p>";
        $this->error_text["exceeded"] = "<p><strong>License Error:</strong> You have reached the maximum number of installs allowed. </p>";
        $this->error_text["invalid_user"] = "<p><strong>License Error:</strong> Invalid license key. </p>";
        $this->error_text["invalid_code"] = "<p><strong>License Error:</strong> Invalid license status code. </p>";
        $this->error_text["invalid_hash"] = "<p><strong>License Error:</strong> Invalid communication hash. </p>";
        $this->error_text["wrong_product"] = "<p><strong>License Error:</strong> The license key you provided is not for this product. </p>";
        $this->error_text["integrated_product_license_missing"] = "<p><strong>License Error in Integration:</strong> The license key for the integrated product is not provided.</p>";
        $this->error_text["integrated_product_id_missing"] = "<p><strong>License Error in Integration:</strong> The product id given for integration is invalid. Upgrade your files.</p>";
        $this->error_text["plugin_not_available"] = "<p><strong>License Error:</strong> Plugin is not available. </p>";
        $this->error_text["plugin_inactive"] = "<p><strong>License Error:</strong> Plugin is inactive. </p>";
        $this->error_text["plugin_not_applicable"] = "<p><strong>License Error:</strong> Plugin is not applicable for this product. </p>";
    }
    public function ionLicenseHandler($license_key, $request_type, $plugin_id = null)
    {
        if (!empty($this->product_id)) {
            $key_parts = explode("-", $license_key);
            if (!isset($key_parts[2]) || $key_parts[2] != $this->product_id) {
                return $this->error_text["wrong_product"];
            }
        }
        if (!empty($this->product_license_id)) {
            $key_parts = explode("-", $license_key);
            $product_license_id = array(substr(md5($this->product_license_id), 0, 8));
            if (!in_array($key_parts[4], $product_license_id)) {
                return $this->error_text["wrong_product"];
            }
        }
        $host = $_SERVER["HTTP_HOST"];
        if (strcasecmp("www.", substr($_SERVER["HTTP_HOST"], 0, 4)) == 0) {
            $host = substr($_SERVER["HTTP_HOST"], 4);
        }
        $request = "remote=licensenew&type=" . $request_type . "&license_key=" . urlencode(base64_encode($license_key));
        $request .= "&host_ip=" . urlencode(base64_encode($_SERVER["SERVER_ADDR"])) . "&host_name=" . urlencode(base64_encode($host));
        if (!empty($plugin_id)) {
            $request .= "&plugin_id=" . $plugin_id;
        }
        $request .= "&hash=" . urlencode(base64_encode(md5($request)));
        $request = $this->home_url_site . $this->home_url_iono . "?" . $request;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_PORT, $this->home_url_port);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "iono (www.olate.co.uk/iono)");
        $content = curl_exec($ch);
        curl_close($ch);
        if (!$content) {
            return "Unable to communicate with Iono";
        }
        $content = explode("-", $content);
        $status = $content[0];
        $hash = $content[1];
        if (!empty($plugin_id)) {
            $plugin_status = $content[3];
        }
        if ($hash == md5($this->user_defined_string . $host)) {
            if (!empty($plugin_id)) {
                switch ($plugin_status) {
                    case 0:
                        $err_msg = $this->error_text["plugin_not_available"];
                        break;
                    case 1:
                        $err_msg = "";
                        break;
                    case 2:
                        $err_msg = $this->error_text["plugin_inactive"];
                        break;
                    case 3:
                        $err_msg = $this->error_text["plugin_not_applicable"];
                }
            } else {
                switch ($status) {
                    case 0:
                        $err_msg = $this->error_text["disabled"];
                        break;
                    case 1:
                        $err_msg = "";
                        break;
                    case 2:
                        $err_msg = $this->error_text["suspended"];
                        break;
                    case 3:
                        $err_msg = $this->error_text["expired"];
                        break;
                    case 4:
                        $err_msg = $this->error_text["exceeded"];
                        break;
                    case 10:
                        $err_msg = $this->error_text["invalid_user"];
                        break;
                    default:
                        $err_msg = $this->error_text["invalid_code"];
                        break;
                }
            }
            if (!empty($err_msg)) {
                unset($home_url_site);
                unset($home_url_iono);
                unset($user_defined_string);
                unset($request);
                unset($header);
                unset($return);
                unset($fpointer);
                unset($content);
                unset($status);
                unset($hash);
            }
            return $err_msg;
        }
        return $this->error_text["invalid_hash"];
    }
}

?>