<?php

if (!function_exists('encrypt')) {
	function encrypt($str)
	{
		$ci = &get_instance();

		return $ci->encryption->encrypt($str);
	}
}

if (!function_exists('decrypt')) {
	function decrypt($str)
	{
		$ci = &get_instance();

		return $ci->encryption->decrypt($str);
	}
}

if (!function_exists('selected')) {
    function selected($val, $array)
    {
        if (is_array($array)) {
            foreach ($array as $a) {
                if ($a == $val) {
                    return (string) $val === (string) $a ? 'selected="selected"' : '';
                }
            }

            return '';
        }

        return $val == $array ? 'selected="selected"' : '';
    }
}

if (!function_exists('is_fco_monitor')) {
    function is_fco_monitor()
    {   
        $ci = &get_instance();

        if($ci->user_data->isBudgetRiviewer == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_tor_approver')) {
    function is_tor_approver()
    {   
        $ci = &get_instance();

        if($ci->user_data->isTorApprover == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_head_of_units')) {
    function is_head_of_units()
    {   
        $ci = &get_instance();

        if($ci->user_data->isHeadUnit == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_line_supervisor')) {
    function is_line_supervisor()
    {   
        $ci = &get_instance();

        if($ci->user_data->isDirectSupervisor == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_finance_teams')) {
    function is_finance_teams()
    {   
        $ci = &get_instance();
        // If units = Finance
        if($ci->user_data->unitsId == 3) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_country_director')) {
    function is_country_director()
    {   
        $ci = &get_instance();
        if($ci->user_data->isCountryDirector == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_procurement_officer')) {
    function is_procurement_officer()
    {   
        $ci = &get_instance();
        if($ci->user_data->isProcurementOfficer == 1) {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_root')) {
    function is_root()
    {   
        $ci = &get_instance();
        if($ci->user_data->username == 'root' || $ci->user_data->fullName == 'Root' || $ci->user_data->roles == 'Root') {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_hrd')) {
    function is_hrd()
    {   
        $ci = &get_instance();
        if($ci->user_data->roles == 'HRD') {
            return true;
        }

        return false;
    }
}

if (!function_exists('is_consultant')) {
    function is_consultant()
    {   
        $ci = &get_instance();
        if($ci->user_data->roles == 'CONSULTANT') {
            return true;
        }

        return false;
    }
}

if (!function_exists('delete_signature')) {
    function delete_signature() {
        $ci = &get_instance();
		$ci->load->helper('file');
		$path = FCPATH . 'uploads/signature';
		delete_files($path, TRUE); 
	}
}

if (!function_exists('extractImageFromAPI')) {
    function extractImageFromAPI($filename) {
        $token = $_ENV['ASSETS_TOKEN'];
		$file_url = $_ENV['ASSETS_URL'] . "$filename?subfolder=signatures&token=$token";
		$path = pathinfo($file_url);
		if (!is_dir('uploads/signature')) {
			mkdir('./uploads/signature', 0777, TRUE);
		
		}
        $imageTargetPath = 'uploads/signature/' . time() . $filename;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $file_url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // <-- important to specify
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // <-- important to specify
        $resultImage = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpCode == 404) {
			$imageInfo["image_name"] = 'signature_not_found.jpg';
			$imageInfo["image_path"] = FCPATH . 'assets/images/signature_not_found.jpg';
		} else {
            $fp = fopen($imageTargetPath, 'wb');
			fwrite($fp, $resultImage);
			fclose($fp);
			$imageInfo["image_name"] = $path['basename'];
			$imageInfo["image_path"] = $imageTargetPath;
		}
        
        return $imageInfo;
	}
}

if (!function_exists('get_total_days_period')) {
    function get_total_days_period($request_id) {
        $ci = &get_instance();
        $period = $ci->db->select('start_period, end_period')->from('consultant_request')->where('id', $request_id)->get()->row_array();
        $start = strtotime($period['start_period']);
        $end = strtotime($period['end_period']);
        $datediff = $end - $start;
        return round($datediff / (60 * 60 * 24)) + 1;
    }
}