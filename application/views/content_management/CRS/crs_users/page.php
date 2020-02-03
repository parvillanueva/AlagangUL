<div class="box main-page-install">
    <div class="box-body">
        <?php
            $data['table'] = ['pckg_crs_users' => 'pckg_'];
            $data['order'] = ['asc' => 'id'];
            $data['join'] = [];

            $data['checkbox'] = 0;
            $data['display_fields'] = [
                                'firstname' => ['First Name'],
                                'lastname'  => ['Last Name'],
                                'email' => ['Email Address'],
                                'civil_status' => [''],
                                'gender'     => [''], 
                                'dob' => ['Birthdate'],
                                'registration_date' => ['Date Registered'],
                            ];
                            
            $data['search_keyword'] = ['firstname', 'lastname', 'email'];
            $data['query'] = "status = 1";
            $data['sortable'] = ['column'];
            $data['custom_action'] = [];

            $data['export_name'] = ['ID', "First Name", "Last Name", "Email Address", "Civil Status", "Gender", "Birthday", "Mobile", "Status", "Orders", "Date Registered", "Date Created", "Date Updated"];



            $data['button'] = ['search', 'export', 'date_range'];
        ?>
        <?php $this->form_table->display_data($data); ?>
    </div>
</div>
