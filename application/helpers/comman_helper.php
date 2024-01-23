<?php

function get_developer_by_id($id){
	$CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','developer', array('developer_id'=> $id));
    if($res){

        return $res->developer_name;
    }else{
        return '';
    }

}

function get_projectname_by_id($id){
    $CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','project', array('project_id'=> $id));
    if($res){
        return $res->project_name;
    }else{
        return '';
    }
}

function structurename_by_id($id){
    $CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','structure', array('structure_id'=> $id));
    if($res){
        return $res->structure_name;
    }else{
        return '';
    }
}

function get_trade_by_id($id){
    $CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','trade', array('trade_id'=> $id));
    if($res){
        return $res->trade_name;
    }else{
        return '';
    }
}

function get_tradegroup_by_id($id){
    $CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','trade_gruop', array('tradegroup_id'=> $id));
    if($res){
        return $res->tradegroup_name;
    }else{
        return '';
    }
}

function get_subgroup_by_id($id){
    $CI =& get_instance();
    $res = $CI->Comman_model->get_data_by_id('*','subgroup', array('subgroup_id'=> $id));
    if($res){
        return $res->subgroup_name;
    }else{
        return '';
    }
}

function get_project_type($type_id){
    $CI =& get_instance();
    $type = array(
        '1' => 'Residential',
        '2' => 'Commercial',
        '3' => 'Infra',
    );
    return $type[$type_id];
}

function get_floors_by_structure_id($id){
    $CI =& get_instance();
    $structure_id = $id;
        if($structure_id){
            $structure = $CI->Comman_model->get_data('*','stages',array('structure_id'=>$structure_id));
            return $structure;
        }
}

function get_all_types(){
    $CI =& get_instance();
        $types = $CI->Comman_model->get_data('*','observation_type');
        return $types;
    }

function get_all_severity(){
        $CI =& get_instance();
            $severity = $CI->Comman_model->get_data('*','observation_severity');
            return $severity;
    }

function get_all_roles(){
    $CI =& get_instance();
        $roles = $CI->Comman_model->get_data('*','roles');
        return $roles;
    }

    function get_role_name_by_role_id($id){
        $CI =& get_instance();
        $res = $CI->Comman_model->get_data_by_id('*','roles', array('role_id'=> $id));
        if($res){
    
            return $res->role_title;
        }else{
            return '';
        }
    }

    function get_all_developers(){
        $CI =& get_instance();
        $develoers = $CI->Comman_model->get_data('*','developer');
        return $develoers;
    }

    function get_opbservation_status($id)
    {
        $status = array
        (
            '0' => 'Open',
            '1' => 'In progress',
            '2' => 'Close',
        );
        $color = array
        (
            '0' => 'badge-danger',
            '1' => 'badge-warning',
            '2' => 'badge-success',
        );
        $data['status'] = $status[$id];
        $data['color'] = $color[$id];
        return $data;
    }

    function get_role_of_user($id){
        $CI =& get_instance();
        $role = $CI->Comman_model->get_data_by_id('*','roles', array('role_id' => $id));
        if($role){
    
            return $role->role_title;
        }else{
            return '';
        }
    }

    function get_history_table_by_role_id($id)
    {
        $tables = array
        (
            '2' => 'site_enginner_history',
            '3' => 'responsible_history',
            '4' => 'reviewer_history',
            '5' => 'approval_history'
        );

        $table = $tables[$id];
        return $table;
    }

    function get_table_combiniation($id)
    {
        $tables = array
        (
            '2' => array('site_enginner_history', 'reviewer_history'),
            '3' => array('responsible_history', 'site_enginner_history'),
            '4' => array('reviewer_history', 'approval_history')
        );
        $table = $tables[$id];
        return $table;

    }

    function get_table_combiniation_for_reject($id)
    {
        $tables = array
        (
            '2' => array('site_enginner_history', 'responsible_history'),
            '4' => array('reviewer_history', 'site_enginner_history'),
            '5' => array('approval_history', 'reviewer_history')
        );
        $table = $tables[$id];
        return $table;

    }

    function get_username_by_id($id){
        $CI =& get_instance();
        $user = $CI->Comman_model->get_data_by_id('*','users', array('user_id' => $id));
        if($user){
            $name = $user->first_name." ".$user->last_name;
            return $name;
        }else{
            return '';
        }
    }

    function get_inner_obj_status($id)
    {
        $CI =& get_instance();
        $user_type =  $CI->session->userdata('user_data')->user_type;
        $table = get_history_table_by_role_id($user_type);
        $obj = $CI->Comman_model->get_data_by_id('*', $table, array('observation_id'=>$id));
        $status = array
        (
            '0' => 'new',
            '1' => 'Forwarded',
            '2' => 'Rejected',
            '3' => 'Closed'
        );
        $color = array
        (
            '0' => 'badge-primary',
            '1' => 'badge-warning',
            '2' => 'badge-danger',
            '3' => 'badge-success'

        );
        $data['status'] = $status[$obj->inner_status];
        $data['color'] = $color[$obj->inner_status];
        return $data;
    }

    function get_presenty_status($status)
    {
        $status_array = array
        (
            '0' => 'Absent',
            '1' => 'Present',
        );
        return $status_array[$status];
    }

    function get_material_unit($id)
    {
        $CI =& get_instance();
        $unit = $CI->Comman_model->get_data_by_id('*', 'material_measures', array('measure_id'=>$id));
        if($unit)
        {
            return $unit->measure_name;
        }

    }
    function get_material_name($id)
    {
        $CI =& get_instance();
        $unit = $CI->Comman_model->get_data_by_id('*', 'total_material', array('material_id'=>$id));
        if($unit)
        {
            return $unit->material_name;
        }

    }

    function get_sidebar_menu($user_id)
    {
        $CI =& get_instance();
        $moduleRes = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $user_id),$join=false,$orderclm=false, $order=false,$limit=false,$groupby='module_id');
        
        $moduleArr = array();
        foreach($moduleRes as $module)
        {
            array_push($moduleArr, $module->module_id);

        }

        $sideBarMenuArray = array();

        foreach($moduleArr as $moduleId)
        {
            $subArr = array();
            $submoduleRes = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $user_id, 'module_id' => $moduleId, 'submodule_id >' => 0));
            $module = $CI->Comman_model->get_data_by_id('*', 'modules', array('module_id' => $moduleId));
            $subArr['module'] = $module;

            if(!empty($submoduleRes))
            {
                $arr = array();
                foreach($submoduleRes as $submode)
                {
                    $subModule = $CI->Comman_model->get_data_by_id('*', 'submodule', array('submodule_id' => $submode->submodule_id));
                    $arr[] = $subModule;
                }
                $subArr['submodules'] = $arr;
            }else{
                $subArr['submodules'] = array();

            }


            array_push($sideBarMenuArray, $subArr);
        }

        return $sideBarMenuArray;
    }


    function side_menu_for_admin()
    {
        $CI =& get_instance();
        $modules = $CI->Comman_model->get_data('*', 'modules');

        $sideBarMenuArray = array();
        foreach($modules as $module)
        {
            $arr = array();
            $arr['module'] = $module;
            $submodule = $CI->Comman_model->get_data('*', 'submodule', array('module_id' => $module->module_id));
            if($submodule)
            {
                $arr['submodules'] = $submodule;
            }else{
                $arr['submodules'] = array();

            }
            array_push($sideBarMenuArray, $arr);

        }
        return ($sideBarMenuArray);
    }

    function checkHasUerModuleAccees($userId, $moduleId)
    {
        $CI =& get_instance();
        $res = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $userId, 'module_id' => $moduleId));
        if($res)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

    function checkHasUerSubmoduleAccees($userId, $moduleId, $submoduleId)
    {
        $CI =& get_instance();
        $res = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $userId, 'module_id' => $moduleId, 'submodule_id' => $submoduleId));
        if($res)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

    function getChecklistGroupName($id)
    {
        $CI =& get_instance();
        $res = $CI->Comman_model->get_data_by_id('*', 'checklist_group', array('checklist_group_id' => $id));
        if($res)
        {
            return $res->checklist_group_name;
        }else{
            return '';

        }
        
    }


    function all_city_data () {
      return  $cities = array("Adilabad", "Agra", "Ahmedabad", "Ahmednagar", "Aizawl", "Ajitgarh (Mohali)", "Ajmer", "Akola", "Alappuzha", "Aligarh", "Alirajpur", "Allahabad", "Almora", "Alwar", "Ambala", "Ambedkar Nagar", "Amravati", "Amreli district", "Amritsar", "Anand", "Anantapur", "Anantnag", "Angul", "Anjaw", "Anuppur", "Araria", "Ariyalur", "Arwal", "Ashok Nagar", "Auraiya", "Aurangabad", "Aurangabad", "Azamgarh", "Badgam", "Bagalkot", "Bageshwar", "Bagpat", "Bahraich", "Baksa", "Balaghat", "Balangir", "Balasore", "Ballia", "Balrampur", "Banaskantha", "Banda", "Bandipora", "Bangalore Rural", "Bangalore Urban", "Banka", "Bankura", "Banswara", "Barabanki", "Baramulla", "Baran", "Bardhaman", "Bareilly", "Bargarh (Baragarh)", "Barmer", "Barnala", "Barpeta", "Barwani", "Bastar", "Basti", "Bathinda", "Beed", "Begusarai", "Belgaum", "Bellary", "Betul", "Bhadrak", "Bhagalpur", "Bhandara", "Bharatpur", "Bharuch", "Bhavnagar", "Bhilwara", "Bhind", "Bhiwani", "Bhojpur", "Bhopal", "Bidar", "Bijapur", "Bijapur", "Bijnor", "Bikaner", "Bilaspur", "Bilaspur", "Birbhum", "Bishnupur", "Bokaro", "Bongaigaon", "Boudh (Bauda)", "Budaun", "Bulandshahr", "Buldhana", "Bundi", "Burhanpur", "Buxar", "Cachar", "Central Delhi", "Chamarajnagar", "Chamba", "Chamoli", "Champawat", "Champhai", "Chandauli", "Chandel", "Chandigarh", "Chandrapur", "Changlang", "Chatra", "Chennai", "Chhatarpur", "Chhatrapati Shahuji Maharaj Nagar", "Chhindwara", "Chikkaballapur", "Chikkamagaluru", "Chirang", "Chitradurga", "Chitrakoot", "Chittoor", "Chittorgarh", "Churachandpur", "Churu", "Coimbatore", "Cooch Behar", "Cuddalore", "Cuttack", "Dadra and Nagar Haveli", "Dahod", "Dakshin Dinajpur", "Dakshina Kannada", "Daman", "Damoh", "Dantewada", "Darbhanga", "Darjeeling", "Darrang", "Datia", "Dausa", "Davanagere", "Debagarh (Deogarh)", "Dehradun", "Deoghar", "Deoria", "Dewas", "Dhalai", "Dhamtari", "Dhanbad", "Dhar", "Dharmapuri", "Dharwad", "Dhemaji", "Dhenkanal", "Dholpur", "Dhubri", "Dhule", "Dibang Valley", "Dibrugarh", "Dima Hasao", "Dimapur", "Dindigul", "Dindori", "Diu", "Doda", "Dumka", "Dungapur", "Durg", "East Champaran", "East Delhi", "East Garo Hills", "East Khasi Hills", "East Siang", "East Sikkim", "East Singhbhum", "Eluru", "Ernakulam", "Erode", "Etah", "Etawah", "Faizabad", "Faridabad", "Faridkot", "Farrukhabad", "Fatehabad", "Fatehgarh Sahib", "Fatehpur", "Fazilka", "Firozabad", "Firozpur", "Gadag", "Gadchiroli", "Gajapati", "Ganderbal", "Gandhinagar", "Ganganagar", "Ganjam", "Garhwa", "Gautam Buddh Nagar", "Gaya", "Ghaziabad", "Ghazipur", "Giridih", "Goalpara", "Godda", "Golaghat", "Gonda", "Gondia", "Gopalganj", "Gorakhpur", "Gulbarga", "Gumla", "Guna", "Guntur", "Gurdaspur", "Gurgaon", "Gwalior", "Hailakandi", "Hamirpur", "Hamirpur", "Hanumangarh", "Harda", "Hardoi", "Haridwar", "Hassan", "Haveri district", "Hazaribag", "Hingoli", "Hissar", "Hooghly", "Hoshangabad", "Hoshiarpur", "Howrah", "Hyderabad", "Hyderabad", "Idukki", "Imphal East", "Imphal West", "Indore", "Jabalpur", "Jagatsinghpur", "Jaintia Hills", "Jaipur", "Jaisalmer", "Jajpur", "Jalandhar", "Jalaun", "Jalgaon", "Jalna", "Jalore", "Jalpaiguri", "Jammu", "Jamnagar", "Jamtara", "Jamui", "Janjgir-Champa", "Jashpur", "Jaunpur district", "Jehanabad", "Jhabua", "Jhajjar", "Jhalawar", "Jhansi", "Jharsuguda", "Jhunjhunu", "Jind", "Jodhpur", "Jorhat", "Junagadh", "Jyotiba Phule Nagar", "Kabirdham (formerly Kawardha)", "Kadapa", "Kaimur", "Kaithal", "Kakinada", "Kalahandi", "Kamrup", "Kamrup Metropolitan", "Kanchipuram", "Kandhamal", "Kangra", "Kanker", "Kannauj", "Kannur", "Kanpur", "Kanshi Ram Nagar", "Kanyakumari", "Kapurthala", "Karaikal", "Karauli", "Karbi Anglong", "Kargil", "Karimganj", "Karimnagar", "Karnal", "Karur", "Kasaragod", "Kathua", "Katihar", "Katni", "Kaushambi", "Kendrapara", "Kendujhar (Keonjhar)", "Khagaria", "Khammam", "Khandwa (East Nimar)", "Khargone (West Nimar)", "Kheda", "Khordha", "Khowai", "Khunti", "Kinnaur", "Kishanganj", "Kishtwar", "Kodagu", "Koderma", "Kohima", "Kokrajhar", "Kolar", "Kolasib", "Kolhapur", "Kolkata", "Kollam", "Koppal", "Koraput", "Korba", "Koriya", "Kota", "Kottayam", "Kozhikode", "Krishna", "Kulgam", "Kullu", "Kupwara", "Kurnool", "Kurukshetra", "Kurung Kumey", "Kushinagar", "Kutch", "Lahaul and Spiti", "Lakhimpur", "Lakhimpur Kheri", "Lakhisarai", "Lalitpur", "Latehar", "Latur", "Lawngtlai", "Leh", "Lohardaga", "Lohit", "Lower Dibang Valley", "Lower Subansiri", "Lucknow", "Ludhiana", "Lunglei", "Madhepura", "Madhubani", "Madurai", "Mahamaya Nagar", "Maharajganj", "Mahasamund", "Mahbubnagar", "Mahe", "Mahendragarh", "Mahoba", "Mainpuri", "Malappuram", "Maldah", "Malkangiri", "Mamit", "Mandi", "Mandla", "Mandsaur", "Mandya", "Mansa", "Marigaon", "Mathura", "Mau", "Mayurbhanj", "Medak", "Meerut", "Mehsana", "Mewat", "Mirzapur", "Moga", "Mokokchung", "Mon", "Moradabad", "Morena", "Mumbai City", "Mumbai suburban", "Munger", "Murshidabad", "Muzaffarnagar", "Muzaffarpur", "Mysore", "Nabarangpur", "Nadia", "Nagaon", "Nagapattinam", "Nagaur", "Nagpur", "Nainital", "Nalanda", "Nalbari", "Nalgonda", "Namakkal", "Nanded", "Nandurbar", "Narayanpur", "Narmada", "Narsinghpur", "Nashik", "Navsari", "Nawada", "Nawanshahr", "Nayagarh", "Neemuch", "Nellore", "New Delhi", "Nilgiris", "Nizamabad", "North 24 Parganas", "North Delhi", "North East Delhi", "North Goa", "North Sikkim", "North Tripura", "North West Delhi", "Nuapada", "Ongole", "Osmanabad", "Pakur", "Palakkad", "Palamu", "Pali", "Palwal", "Panchkula", "Panchmahal", "Panchsheel Nagar district (Hapur)", "Panipat", "Panna", "Papum Pare", "Parbhani", "Paschim Medinipur", "Patan", "Pathanamthitta", "Pathankot", "Patiala", "Patna", "Pauri Garhwal", "Perambalur", "Phek", "Pilibhit", "Pithoragarh", "Pondicherry", "Poonch", "Porbandar", "Pratapgarh", "Pratapgarh", "Pudukkottai", "Pulwama", "Pune", "Purba Medinipur", "Puri", "Purnia", "Purulia", "Raebareli", "Raichur", "Raigad", "Raigarh", "Raipur", "Raisen", "Rajauri", "Rajgarh", "Rajkot", "Rajnandgaon", "Rajsamand", "Ramabai Nagar (Kanpur Dehat)", "Ramanagara", "Ramanathapuram", "Ramban", "Ramgarh", "Rampur", "Ranchi", "Ratlam", "Ratnagiri", "Rayagada", "Reasi", "Rewa", "Rewari", "Ri Bhoi", "Rohtak", "Rohtas", "Rudraprayag", "Rupnagar", "Sabarkantha", "Sagar", "Saharanpur", "Saharsa", "Sahibganj", "Saiha", "Salem", "Samastipur", "Samba", "Sambalpur", "Sangli", "Sangrur", "Sant Kabir Nagar", "Sant Ravidas Nagar", "Saran", "Satara", "Satna", "Sawai Madhopur", "Sehore", "Senapati", "Seoni", "Seraikela Kharsawan", "Serchhip", "Shahdol", "Shahjahanpur", "Shajapur", "Shamli", "Sheikhpura", "Sheohar", "Sheopur", "Shimla", "Shimoga", "Shivpuri", "Shopian", "Shravasti", "Sibsagar", "Siddharthnagar", "Sidhi", "Sikar", "Simdega", "Sindhudurg", "Singrauli", "Sirmaur", "Sirohi", "Sirsa", "Sitamarhi", "Sitapur", "Sivaganga", "Siwan", "Solan", "Solapur", "Sonbhadra", "Sonipat", "Sonitpur", "South 24 Parganas", "South Delhi", "South Garo Hills", "South Goa", "South Sikkim", "South Tripura", "South West Delhi", "Sri Muktsar Sahib", "Srikakulam", "Srinagar", "Subarnapur (Sonepur)", "Sultanpur", "Sundergarh", "Supaul", "Surat", "Surendranagar", "Surguja", "Tamenglong", "Tarn Taran", "Tawang", "Tehri Garhwal", "Thane", "Thanjavur", "The Dangs", "Theni", "Thiruvananthapuram", "Thoothukudi", "Thoubal", "Thrissur", "Tikamgarh", "Tinsukia", "Tirap", "Tiruchirappalli", "Tirunelveli", "Tirupur", "Tiruvallur", "Tiruvannamalai", "Tiruvarur", "Tonk", "Tuensang", "Tumkur", "Udaipur", "Udalguri", "Udham Singh Nagar", "Udhampur", "Udupi", "Ujjain", "Ukhrul", "Umaria", "Una", "Unnao", "Upper Siang", "Upper Subansiri", "Uttar Dinajpur", "Uttara Kannada", "Uttarkashi", "Vadodara", "Vaishali", "Valsad", "Varanasi", "Vellore", "Vidisha", "Viluppuram", "Virudhunagar", "Visakhapatnam", "Vizianagaram", "Vyara", "Warangal", "Wardha", "Washim", "Wayanad", "West Champaran", "West Delhi", "West Garo Hills", "West Kameng", "West Khasi Hills", "West Siang", "West Sikkim", "West Singhbhum", "West Tripura", "Wokha", "Yadgir", "Yamuna Nagar", "Yanam", "Yavatmal", "Zunheboto");
    }

    function get_all_projects()
    {
        $CI =& get_instance();
        $user = $CI->session->userdata('user_data');
        if($user)
        {
            if($user->user_type == '1')
            {
                $all_projects = $CI->Comman_model->get_data('*','project');

            }else{
                $join = array($CI->db->join('user_project_access b', 'a.project_id=b.project_id'));
                $all_projects = $CI->Comman_model->get_data('a.*, b.*', 'project a', array('b.user_id' => $user->user_id));
            }

            return $all_projects;
        }
        
    }

    function checkIsTradeGroupAllocatedToProject($project_id, $tradegroup_id)
    {
        $CI =& get_instance();
        $res = $CI->Comman_model->get_data_by_id('*','project_tradegroup_allocation', array('project_id'=>$project_id, 'tradegroup_id'=>$tradegroup_id));
        if(!empty($res))
        {
            return TRUE;
        }else{
            return FALSE;
        }

    }

































    //API FUNCTIONS
    function is_user_admin($user_id)
    {
        $CI =& get_instance();
        $data = $CI->Comman_model->get_data_by_id('*', 'users', array('user_id' => $user_id));
        if(!empty($data))
        {
            if($data->user_type == '1')
            {
                return $res = array(
                    'res' => TRUE,
                    'message' => 'Admin'
                );
            }else{
                return $res = array(
                    'res' => FALSE,
                    'message' => 'NOT Admin'
                );
            }
        }else{
            return $res = array(
                'res' => FALSE,
                'message' => 'Invalid User ID'
            );
        }
    }

    function get_menus_for_mobile($user_id)
    {
        $CI =& get_instance();
        $moduleRes = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $user_id),$join=false,$orderclm=false, $order=false,$limit=false,$groupby='module_id');
        
        $moduleArr = array();
        foreach($moduleRes as $module)
        {
            array_push($moduleArr, $module->module_id);

        }

        $sideBarMenuArray = array();

        foreach($moduleArr as $moduleId)
        {
            $subArr = array();
            $submoduleRes = $CI->Comman_model->get_data('*', 'permission', array('user_id' => $user_id, 'module_id' => $moduleId, 'submodule_id >' => 0));
            $module = $CI->Comman_model->get_data_by_id('module_id, module_name', 'modules', array('module_id' => $moduleId));
            $subArr['module'] = $module;

            if(!empty($submoduleRes))
            {
                $arr = array();
                foreach($submoduleRes as $submode)
                {
                    $subModule = $CI->Comman_model->get_data_by_id('submodule_id, submodule_name', 'submodule', array('submodule_id' => $submode->submodule_id));
                    $arr[] = $subModule;
                }
                $subArr['submodules'] = $arr;
            }else{
                $subArr['submodules'] = array();

            }


            array_push($sideBarMenuArray, $subArr);
        }

        return $sideBarMenuArray;
    }

    function getObservationData()
    {
        $CI =& get_instance();
        $data = array();
        $tradeGroups = $CI->Comman_model->get_data('*','trade_gruop');

        foreach($tradeGroups as $tradegroup){
            $trade = $CI->Comman_model->get_data('*', 'trade', array('tradegroup_id' => $tradegroup->tradegroup_id));
            $tradegroup->trades = $trade;
        }

        $data['trade_group'] = $tradeGroups;
        $data['observation_type'] = $CI->Comman_model->get_data('*', 'observation_type');
        $data['observation_severity'] = $CI->Comman_model->get_data('*', 'observation_severity');
        $data['observation_category'] = $CI->Comman_model->get_data('*', 'categories');
        $data['accountables'] = $CI->Comman_model->get_data('user_id, first_name, last_name', 'users');
        return $data;
        
    }

    function getAllUserProjects($user_id)
    {
        $CI =& get_instance();
        $join = array($CI->db->join('user_project_access b', 'a.project_id=b.project_id'));
        $all_projects = $CI->Comman_model->get_data('a.project_id, a.project_name', 'project a', array('b.user_id' => $user_id));
        return $all_projects;
    }
?>