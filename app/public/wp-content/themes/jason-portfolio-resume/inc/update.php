<?php
class Update
{
    protected $data;
    public function __construct($data) {
        $defaults = array(
            'user'  =>  'domainlee',
            'repo'  =>  '',
            'token' =>  '',
        );
        $args = wp_parse_args( $data, $defaults );
        $this->data = $args;
        add_filter( 'pre_set_site_transient_update_themes', array(  $this, 'jason_portfolio_resume_updates'  ) );
        add_filter( 'http_request_args', array(  $this, 'http_request_args'   ), 10, 2);
    }

    public function jason_portfolio_resume_updates($data) {
        $theme_dtls = array(
            'theme_parent'      => get_option('template'),
            'theme_parent_uri'  => get_template_directory_uri(),
            'theme_name'        => get_option('stylesheet'),
            'theme_template'    => get_stylesheet_directory(), // Folder name of the current theme
            'theme_uri'         => get_stylesheet_directory_uri(), // URL of the current theme folder
            'theme_slug'        => 'jason-portfolio-resume',
            'theme_dir'         => get_theme_root(), // Folder name of the theme root
        );
        $theme       = $theme_dtls['theme_name'];
        error_log('Theme dtls: ' . print_r( $theme_dtls , true ));
        if ($theme != $theme_dtls['theme_slug']) {
            $theme = $theme_dtls['theme_slug'];
        }
        error_log('Theme: ' . $theme);
        $current = wp_get_theme()->get('Version');

        $user       = $this->data['user'];
        $repo       = $this->data['repo'];
        $token      = $this->data['token'];

        $url = "https://api.github.com/repos/$user/$repo/releases/latest";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'User-Agent: ' . $user,
            'Authorization: token ' . $token,
            'Accept: application/json'
        ]);
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            error_log('cURL Error: ' . curl_error($curl));
        }
        curl_close($curl);
        $file = json_decode($response);
        if ($file) {
            $update = preg_replace('/[^0-9.]/', '', $file->tag_name);
            if ($update > $current) {
                $data->response[$theme] = array(
                    'theme'       => $theme,
                    'new_version' => $update,
                    'url'         => 'https://github.com/'.$user.'/'.$repo,
                    'package'     => $file->zipball_url,
                    'slug'        => $theme,
                );
                error_log('Theme data: ' . print_r($data->response[$theme], true));
            } else {
                error_log('No update available');
            }
        }
        if($data->checked) {
            error_log('Automatic GitHub updates Check: ' . print_r($data->checked, true));
        }
        error_log('Automatic GitHub updates Response: ' . print_r($data->response, true));
        if ($theme != $theme_dtls['theme_name']) {
            error_log('Theme dtls after: ' . print_r( $theme_dtls , true ));
            if ($theme_dtls['theme_name'] != $theme_dtls['theme_slug']) {
                $new_dir = $theme_dtls['theme_dir'] . '/' . $theme_dtls['theme_slug'];
                rename(get_stylesheet_directory(), $new_dir);
                error_log('Theme renamed: ' . $theme_dtls['theme_name'] . ' to ' . get_stylesheet_directory());
                error_log('After Theme dtls: ' . print_r( $theme_dtls , true ));
            } else {
                error_log('Theme not renamed: ' . $theme_dtls['theme_template'] . ' to ' . get_stylesheet_directory());
                error_log('After Theme dtls: ' . print_r( $theme_dtls , true ));
            }
            update_option('template', $theme);
            update_option('stylesheet', $theme);
            update_option('current_theme', $theme);
        }

        return $data;
    }

    public function http_request_args($parsed_args, $url) {
        if (isset($parsed_args['wpse_http_request_args_modified'])) {
            error_log('wpse_http_request_args_modified: ' . print_r($parsed_args, true) . ' ' . print_r($url, true));
            return $parsed_args;
        }
        $parsed_args['wpse_http_request_args_modified'] = true;
        $user       = $this->data['user'];
        $repo       = $this->data['repo'];
        $token      = $this->data['token'];
        if (strpos($url, "$user/$repo") !== false) {
            $headers = array(
                'User-Agent' => $user,
                'Authorization' => 'token ' . $token,
                'Accept' => 'application/json, application/octet-stream'
            );
            $parsed_args['headers'] = $headers;
            error_log('headers: ' . print_r($parsed_args['headers'], true));
            $parsed_args['reject_unsafe_urls'] = false;
        }
        error_log('wpse_http_request_args: ' . print_r($parsed_args, true) . ' ' . print_r($url, true) );
        return $parsed_args;
    }
}

$data        = array(
    'user'  => 'domainlee',
    'repo'  => 'jason-portfolio-resume',
    'token' => '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'
);
new Update($data);