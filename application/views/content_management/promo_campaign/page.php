<div class="box main-page-install">
    <div class="box-body">
        <?php
            $data['table'] = ['site_promo_campaign' => 'pckg_'];
            $data['order'] = ['desc' => 'id'];
            $data['join'] = [];
            $data['checkbox'] = 1;
            $data['display_fields'] = [
                                'img_banner' => ['Image Banner'],
                                'redirect_url' => ['Redirect Url'],
                                'start_date' => ['Start Date'],
                                'end_date' => ['End Date'],
                                'status' => ['Status'],
                            ];
            $data['date_field_format'] = [
                'start_date' => 'LL',
                'end_date' => 'LL'
            ];   

            $data['search_keyword'] = ['redirect_url'];
            $data['query'] = "status >= 0";
            $data['sortable'] = ['column'];
            $data['custom_action'] = [];
            $data['button'] = ['add','date_range','search'];
        ?>
        <?php $this->form_table->display_data($data); ?>
    </div>
</div>
